### AngularJS

- https://angularjs.org/
- https://docs.angularjs.org/api

1. Instalação
  -  Opção 1: Fazer download do zip
  -  Opção 2: npm install angular@1.4.7  ( nodeJs )
  -  Opção 3: Usar o cdn ( não é bem uma instalação )
  
  ```
  <!doctype html>
	<html ng-app>
	  <head>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
	  </head>
	  <body>
		<div>
		  <label>Name:</label>
		  <input type="text" ng-model="yourName" placeholder="Enter a name here">
		  <hr>
		  <h1>Hello {{yourName}}!</h1>
		</div>
	  </body>
	</html>
  ```
  
2. Diretivas básicas
  - ng-app : define o nome da angular application que será criada
  - ng-model : faz o data binding do campo com o model
  - ng-controller : define o controller que será utilizado e seu escopo
  - ng-show/hide : exibe ou esconde uma área de acordo com o valor passado para função
  - ng-repeat : serve para iterar em uma coleção e repetir o código associado com o escopo da função
  - ng-click : executa uma função indicada como resposta a um evento de click
  - ng-change : executa uma função toda vez que o elemento for alterado
  - ng-options : define uma coleção de opções para o select de maneira semelhante ao ng-repeat, já realizando o data-binding
  - ng-view : é onde será inserido o template carregado juntamente com a rota definida
  
3. Controllers
  - Como definir?
    1. Primeiramente é preciso criar explicitamente nossa aplicação com a diretiva ng-app
    
      ```
        <html ng-app="nomeDaApp">
      ```
    2. Em seguida, criar o controller e registra-lo na aplicação
	
      ```
        <script>
          var myApp = angular.module('nomeDaApp', []);
          var CtrlApp = function(){
          }
          myApp.controller('CtrlApp', CtrlApp);
        </script>
      ```
    3. Definir o escopo do controller na view com a diretiva ng-controller
	
  - Interagir com o escopo do controller
 
    A variável $scope é responsável por fazer a interação com os models. Para monitorar models o $scope disponibiliza a função $watch, que serve para monitorar mudanças em um model e realizar determinada função quando uma alteração é percebida
      
      ```
      var CtrlApp = function($scope){
          $scope.var = 'teste';
          $scope.$watch('var', function(){
             console.log($scope.var);
          });
      }
      ```

4. Filtros ( https://docs.angularjs.org/api/ng/filter/filter )
  - É possível atribuir um filtro a uma diretiva ng-repeat  
    
  ```
    Busca qualquer coisa: <input type="search" ng-model="busca.$"><br>
    Busca por nome: <input type="search" ng-model="busca.nome"><br>
    Busca cidade: <input type="search" ng-model="busca.cidade"><br>
    <ul>
        <li ng-repeat="pessoa in pessoas | filter:busca">{{ pessoa.nome }}, {{ pessoa.cidade }}</li>
    </ul>
  ```
 
5. Módulos
  - Definir um modulo:
  
    ```
      angular.module('MeuModulo',[]);
    ```  
    Aqui podemos ver a variágel global do angular 'angular' e um conjunto de parâmetros para a função 
    'module', onde o primeiro é o nome do nosso modulo e o segundo um array com nossas dependências.
  - Definir um controller dentro de um modulo:
    Basta acrescentar o seguinte trecho a frente da definição do módulo
    
      ```
        .controller('CtrlModulo',function($scope){
           função
        });
      ```
  - Dependency Injection
    - Maneiras
      1. Manual
      
        ```
          CtrlModulo.$inject = ['$scope'];
        ```
      2. Explícita
      
        ```
          .controller('CtrlModulo', ['$scope',$state' ,function(d1,d2){
              a var 'd1' é associada a $scope
              a var 'd2' é associada a $state
              etc
              }]
          );
        ```

6. Rotas
  - As rotas usadas pelo angular funcionam um pouco diferente do normal, a url é concatenada com o símbolo #.
  Este é um conceito básico da SPA (Single Page Application) e serve para que a página não seja carregada novamente.
  - Para configurar as rotas da aplicação utilizamos o $routeProvider, e para podermos utiliza-lo é necessário
  o arquivo de rotas do angular-route (que foi desmembrado em uma das ultimas versões)
  
    ```
      index.html
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-route.min.js"></script>
    ```
  - Incluir o modulo ngRoute nas dependências do módulo e fazer as configurações desejadas
          
    ```
      .module('pessoas',['ngRoute'])
        .config(function($routeProvider) {
            $routeProvider
                .when('/', {
                    templateUrl: 'listar.html'
                });
        })
    ```
  - Para utilizarmos os parâmetros das rotas temos o $routeParams
  
    ```
    Para criar a rota com parâmetro
     .when('/pessoa/:index', {
       templateUrl: 'editar.html',
       controller: 'CtrlEditar'
     });
       ...
     Para resgatar o parâmetro no controller
      .controller('CtrlEditar', function($scope,$routeParams) {
         $scope.pessoa = $scope.pessoas[$routeParams.index];
      });
    ```
    
7. Filtros
  - Criando filtro dentro de um módulo
  
  ```
  .filter('nomeDoFiltro', function() {
    return function(input, param) {
      função
      return input;
    }
  })
  ```
  
  A primeira função do filtro é responsável por injetar suas dependências e a segunda função é onde colocamos
  a lógica do nosso filtro e retornamos a saída, é aqui que podemos receber parâmetros na chamada do filtro.

8. Diretivas customizadas ( https://docs.angularjs.org/guide/directive )
 
    ```
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
    ```
  Atuam diretamente no DOM. A declaração é feita através do .directive e em seguida vem o nome dado a diretiva, este pode ser interpretado de diversar formas (para mais informações ler doc). A diretiva sempre deve retornar um objeto com suas configurações corretamente indicadas.Segue algumas das propriedades que este pode apresentar
  
  ```
  Restrict:
    'A' - only matches attribute name
    'E' - only matches element name
    'C' - only matches class name
  Link:
    Liga o comportamento da diretiva a um elemento associado
  Template:
    Pode ser um link para outro template ou o próprio código que será inserido
  Transclude:
    Substitui o conteúdo dentro do elemento e substitui dentro do template
  ```
  
  No exemplo anterior, temos uma diretiva do tipo A, que se refere a uma diretiva da forma de atributo, ou seja,
  aquela que é chamada dentro de uma tag ex: ```<button son-click="executa()">```. No exemplo a seguir, temos uma diretiva
  do tipo elemento, portanto ela mesma define a tag <son-click2 click="executa()"> e possui seus próprios atributos.
  
    ```
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
    ```
  A chama $eval faz com que seja executado o conteúdo do atributo "click", que no caso é o execute().
  