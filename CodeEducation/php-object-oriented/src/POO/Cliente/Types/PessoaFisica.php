<?php
namespace POO\Cliente\Types;
use POO\Cliente\Cliente;
use POO\Cliente\Interfaces\PFInterface;

class PessoaFisica extends Cliente implements PFInterface
{
    private $cpf;

    public function __construct($id,$nome, $email,$idade, $cpf)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdade($idade);
        $this->setCpf($cpf);
    }

    public function getImportancia()
    {
        return 'Media';
    }

    public function getTipoCliente()
    {
        return 'Pessoa Fisica';
    }

    public function getEnderecoCobranca()
    {
        if ( $this->getEnderecoSecundario() )
            return $this->getEnderecoSecundario();
        else
            return $this->getEndereco();
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
}