<?php
namespace POO;

use POO\Cliente\Cliente;
use POO\Cliente\Types\PessoaFisica;
use POO\Cliente\Types\PessoaJuridica;

class Database{

    private $connection;
    private $clientsToPersist;

    public function __construct(\PDO $con)
    {
        $this->connection = $con;
    }

    public function persist(Cliente $c)
    {
        $this->clientsToPersist[] = $c;
        return $this;
    }

    public function getClientToPersist()
    {
        return $this->clientsToPersist;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function flush()
    {
        foreach($this->getClientToPersist() as $client)
        {
            if($client instanceof PessoaJuridica) {
                $stmt = $this->getConnection()->prepare(
                    "INSERT INTO pessoas_juridicas(id,nome,email, idade, endereco, enderecoSecundario, cnpj)"
                    ." VALUES(:id, :nome,:email,:idade,:endereco,:enderecoSecundario,:cnpj)");
                $stmt->bindParam(':id',$client->getId());
                $stmt->bindParam(':nome',$client->getNome());
                $stmt->bindParam(':email',$client->getEmail());
                $stmt->bindParam(':idade',$client->getIdade());
                $stmt->bindParam(':endereco',$client->getEndereco());
                $stmt->bindParam(':enderecoSecundario',$client->getEnderecoSecundario());
                $stmt->bindParam(':cnpj',$client->getCnpj());
                $stmt->execute();
            }elseif ($client instanceof PessoaFisica) {
                $stmt = $this->getConnection()->prepare(
                    "INSERT INTO pessoas_fisicas(id, nome,email, idade, endereco, enderecoSecundario, cpf)"
                    ." VALUES(:id, :nome,:email,:idade,:endereco,:enderecoSecundario,:cpf)");
                $stmt->bindParam(':id',$client->getId());
                $stmt->bindParam(':nome',$client->getNome());
                $stmt->bindParam(':email',$client->getEmail());
                $stmt->bindParam(':idade',$client->getIdade());
                $stmt->bindParam(':cpf',$client->getCpf());
                $stmt->bindParam(':endereco',$client->getEndereco());
                $stmt->bindParam(':enderecoSecundario',$client->getEnderecoSecundario());
                $stmt->execute();
            }
            else
                return false;
        }
        return true;
    }

}