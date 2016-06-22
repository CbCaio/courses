<?php
/*********** autoload ************/
define('CLASS_DIR', '../src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

try {
    $pdo    = new PDO("mysql:host=localhost;dbname=db_poo","root","",
        array(PDO::ATTR_PERSISTENT => true));
    echo "Connected...\n";
    $db     = new \POO\Database($pdo);
} catch (PDOException $e) {
    echo "Disconnected\n";
    die("Unable to connect: " . $e->getMessage());
}

criaTabelaPessoaFisica($pdo);
criaTabelaPessoaJuridica($pdo);
populaBanco($db);

if ($db->flush() == true)
    echo "Database populated.\n";
else
    echo "Error";

function populaBanco(\POO\Database $db, $pf = null, $pj = null)
{
    if ($pf == false)
        $pf = 10;
    if ($pj == false)
        $pj = 10;

    $total = $pf + $pj;

    for ($i = 1; $i<=$total; $i++)
    {
        if ($i < $pf)
        {
            $cliente = criaPessoaFisica($i);
            $db->persist($cliente);
        }
        else
        {
            $cliente = criaPessoaJuridica($i);
            $db->persist($cliente);
        }
    }
    if ($db->flush())
        echo "Banco populado com $pf Pessoas Fisicas e $pj Pessoas Juridicas";
    else
        echo 'Error ao popular banco';
}

function criaPessoaJuridica($id = null)
{
    $pessoaJuridica = new POO\Cliente\Types\PessoaJuridica(
        $id, 'Empresa '.$id, 'empresa'.$id.'@email.com', $id*10, '12.123.620/1234-'.$id);
    $pessoaJuridica->setEndereco('Rua '. $id);
    $pessoaJuridica->setEnderecoSecundario('Rua Secundaria'. $id);
    return $pessoaJuridica;
}

function criaTabelaPessoaFisica(PDO $pdo)
{
    try {
        $sql    = 'CREATE TABLE IF NOT EXISTS pessoas_fisicas
        ( id INT UNSIGNED PRIMARY KEY,
        nome VARCHAR(255) NOT NULL ,
        email VARCHAR(255) NOT NULL ,
        idade SMALLINT NOT NULL,
        endereco VARCHAR(255) NOT NULL,
        enderecoSecundario VARCHAR(255) ,
        cpf VARCHAR (255) NOT NULL );
        ';
        $pdo->exec($sql);
        //print("Created pessoas_fisicas Table.\n");
    } catch(PDOException $e) {
        echo $e->getMessage();//Remove or change message in production code
    }
}

function criaTabelaPessoaJuridica(PDO $pdo)
{
    try {
        $sql    = 'CREATE TABLE IF NOT EXISTS pessoas_juridicas
        ( id INT UNSIGNED PRIMARY KEY,
        nome VARCHAR(255) NOT NULL ,
        email VARCHAR(255) NOT NULL ,
        idade SMALLINT NOT NULL,
        endereco VARCHAR(255) NOT NULL,
        enderecoSecundario VARCHAR(255) ,
        cnpj VARCHAR (255) NOT NULL );
        ';
        $pdo->exec($sql);
        //print("Created pessoas_juridicas Table.\n");
    } catch(PDOException $e) {
        echo $e->getMessage();//Remove or change message in production code
    }
}

/*
 * Para criar dados falsos automaticamente, incluir e utilizar Faker
 */
function criaPessoaFisica($id = null)
{
    $pessoaFisica = new POO\Cliente\Types\PessoaFisica(
        $id, 'Cliente '.$id, 'client'.$id.'@email.com', $id*10, '123.456.789-'.$id);
    $pessoaFisica->setEndereco('Rua '. $id);
    $pessoaFisica->setEnderecoSecundario('Rua Secundaria'. $id);
    return $pessoaFisica;
}
/*
 * Para criar dados falsos automaticamente, incluir e utilizar Faker
 */