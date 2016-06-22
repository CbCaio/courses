<?php

/*********** autoload ************/
define('CLASS_DIR', '../src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

$clienteArray = [];
try {
    $pdo    = new PDO("mysql:host=localhost;dbname=db_poo","root","",
        array(PDO::ATTR_PERSISTENT => true));
    $db     = new \POO\Database($pdo);

    $sql    = 'SELECT id, nome, email, idade, endereco, enderecoSecundario, cpf  FROM pessoas_fisicas';
    $query  = $pdo->query($sql);
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        $pessoaFisica = new POO\Cliente\Types\PessoaFisica($row->id,$row->nome,$row->email,$row->idade,$row->cpf);
        $pessoaFisica->setEndereco($row->endereco);
        $pessoaFisica->setEnderecoSecundario($row->enderecoSecundario);
        $clienteArray[] = $pessoaFisica;
    }

    $sql    = 'SELECT id, nome, email, idade, endereco, enderecoSecundario, cnpj  FROM pessoas_juridicas';
    $query  = $pdo->query($sql);
    while($row = $query->fetch(PDO::FETCH_OBJ)){
        $pessoaJuridica = new POO\Cliente\Types\PessoaJuridica($row->id,$row->nome,$row->email,$row->idade,$row->cnpj);
        $pessoaJuridica->setEndereco($row->endereco);
        $pessoaJuridica->setEnderecoSecundario($row->enderecoSecundario);
        $clienteArray[] = $pessoaJuridica;
    }
    $pdo = null;
} catch (PDOException $e) {
    die("Unable to connect: " . $e->getMessage());
}

if ( isset($_GET['ordenar']) && $_GET['ordenar'] == 'dsc')
{
  usort($clienteArray, function($item1, $item2){
    if ($item1->getId() == $item2->getId()) return 0;
    return $item1->getId() > $item2->getId() ? -1 : 1;
  });
}
else
{
  usort($clienteArray, function($item1, $item2){
    if ($item1->getId() == $item2->getId()) return 0;
    return $item1->getId() < $item2->getId() ? -1 : 1;
  });
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Caio C.B.">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/custom.css" rel="stylesheet">
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
        <?php if ( isset($_GET['clienteID']) ){
          $cliente = $clienteArray[$_GET['clienteID']-1];?>
          <div class="col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1">
            <h1> Cliente selecionado: <?= $cliente->getId() ?> </h1>
            <div class="col-xs-4">
              <p>Nome: <?= $cliente->getNome() ?></p>
            </div>
            <div class="col-xs-4">
              <p>Email: <?= $cliente->getEmail() ?></p>
            </div>
            <div class="col-xs-4">
              <p>Idade: <?= $cliente->getIdade() ?></p>
            </div>
            <div class="col-xs-4">
              <p>Endereço Primário: <?= $cliente->getEndereco() ?></p>
            </div>
            <div class="col-xs-4">
              <p>Endereço Segundário: <?= $cliente->getEnderecoSecundario() ?></p>
            </div>
            <div class="col-xs-4">
              <p>Endereço para entrega: <?= $cliente->getEnderecoCobranca() ?></p>
            </div>
            <?php if ($cliente->getTipoCliente() == 'Pessoa Fisica') { ?>
              <div class="col-xs-3">
                <p>CPF: <?= $cliente->getCpf() ?></p>
              </div>
            <?php } ?>
            <?php if ($cliente->getTipoCliente() == 'Pessoa Juridica') { ?>
              <div class="col-xs-3">
                <p>CNPJ: <?= $cliente->getCnpj() ?></p>
              </div>
            <?php } ?>
          </div>
        <?php }?>
        <div class="col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 main">
          <h1 class="page-header">Code Education - POO</h1>
          <h2 class="sub-header">Clientes</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                    <th>#
                      <a href="?ordenar=asc">
                        <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                      </a>
                      <a href="?ordenar=dsc">
                        <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                      </a>

                    </th>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th>Importancia</th>
                    <th>Endereço</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($clienteArray as $cliente)
              { ?>
                  <tr >
                    <td ><?= $cliente->getId() ?></td >
                    <td ><?= $cliente->getTipoCliente() ?></td >
                    <td ><?= $cliente->getNome() ?></td >
                    <td > <?= $cliente->getImportancia() ?></td >
                    <td ><?= $cliente->getEndereco() ?></td >
                    <td>
                      <form action="index.php" method="get">
                        <input name="clienteID" type="hidden" value="<?= $cliente->getId() ?>" />
                        <button type="submit" class="btn btn-lg btn-info">Selecionar</button>
                      </form>
                    </td>
                </tr >
              <?php
              } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/bootstrap-dist/js/bootstrap.min.js"></script>
  </body>
</html>
