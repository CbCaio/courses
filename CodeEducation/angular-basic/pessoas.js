angular
    .module('pessoas',['ngRoute'])
    .config(function($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'templates/listar.html'
            })
            .when('/pessoa/adicionar', {
                templateUrl: 'templates/adicionar.html',
                controller: 'CtrlAdicionar'
            })
            .when('/pessoa/:index', {
                templateUrl: 'templates/editar.html',
                controller: 'CtrlEditar'
            });
    })
    .filter('upper',function() {
        return function(input,type){
            if (type = 'l'){
                return input.toLowerCase();
            }
            else{
                return input.toUpperCase();
            }
        };
    })
    .directive('sonClick',function() {
        return {
            restrict: 'A',
            link: function(scope,element,attrs){
                element.bind('click', function() {
                    scope.$eval(attrs.sonClick);
                });
            }
        };
    })
    .directive('sonClick2',function() {
        return {
            restrict: 'E',
            transclude: true,
            template: '<button ng-transclude></button>',
            link: function(scope,element,attrs){
                element.bind('click', function() {
                    scope.$eval(attrs.click);
                });
            }
        };
    })
    .controller('CtrlApp',function($scope) {
        $scope.executa = function () {
          alert('bla');
        };
    })
    .controller('CtrlPessoas', function($scope){

        $scope.pessoas = [
            { nome: 'Cassio'  , cidade: 'Ouro Fino/Campinas'},
            { nome: 'Daniel'  , cidade: 'Ouro Fino'},
            { nome: 'Thaisa'  , cidade: 'Lavras'},
            { nome: 'Bruno'  , cidade: 'Ouro Fino'},
            { nome: 'Caio'  , cidade: 'Ottawa'}
        ];
    })
    .controller('CtrlAdicionar', function($scope) {

        $scope.add = function() {

            $scope.pessoas.push($scope.pessoa);
            $scope.pessoa = "";
            $scope.result = "Registro adicionado com sucesso!";

        };

    })
    .controller('CtrlEditar', function($scope,$routeParams) {
        $scope.pessoa = $scope.pessoas[$routeParams.index];
    });

