<?php
namespace POO\Cliente\Types;
use POO\Cliente\Cliente;
use POO\Cliente\Interfaces\PJInterface;

class PessoaJuridica extends Cliente implements PJInterface
{
    private $cnpj;

    public function __construct($id,$nome, $email,$idade, $cnpj)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdade($idade);
        $this->setCnpj($cnpj);
    }

    public function getImportancia()
    {
        return 'Alta';
    }

    public function getTipoCliente()
    {
        return 'Pessoa Juridica';
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
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

}