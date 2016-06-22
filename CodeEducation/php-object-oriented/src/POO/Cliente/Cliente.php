<?php
namespace POO\Cliente;
use POO\Cliente\Interfaces\TipoClienteInterface;
use POO\Cliente\Interfaces\EnderecoCobrancaInterface;
use POO\Cliente\Interfaces\GrauImportanciaInterface;

abstract class Cliente implements TipoClienteInterface, EnderecoCobrancaInterface, GrauImportanciaInterface
{
    private $id;
    private $nome;
    private $email;
    private $idade;
    private $endereco;
    private $enderecoSecundario;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }



    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param null $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return null
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param null $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    /**
     * @return mixed
     */
    public function getEnderecoSecundario()
    {
        return $this->enderecoSecundario;
    }

    /**
     * @param mixed $enderecoSecundario
     */
    public function setEnderecoSecundario($enderecoSecundario)
    {
        $this->enderecoSecundario = $enderecoSecundario;
    }





}