<?php
/**
 * Conexão com o banco de dados [ok]
 * Pega o ultimo ID e soma 1 [ok]
 * Estanciar Email e verificar se pe valido [ok]
 * Estanciar Password e verificar se a senha é valida []
 * Montar um array, com os paramatros passados em $data e adicionar
 * o novo id ao array data [ok]
 * Verificar se todos os dados estão ok []
 * Inserir dados no banco de dados []
 */

    namespace Weliton\Login\Infra\Repository;

use PDO;
use Weliton\Login\Domain\Model\Email;
use Weliton\Login\Domain\Model\Senha;

class CadastraCliente 
{
    private \PDO $pdo;
    private Email $objemail;
    private QueryBuilder $query;
    private Senha $objSenha;
    private string $email;
    private string $confirmaEmail;
    private string $senha;
    private string $contraSenha;
    private array $data;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    private function verifyId():array
    {   
        $sql = 'SELECT idUser FROM users ORDER BY idUser DESC  limit 1';
        $query = $this->pdo->query($sql);
        return $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verifyEmail(Email $objemail):self
    {
         $this->email = $objemail->getEmail();
        $this->confirmaEmail = $objemail->getConfimateEmail();

        $objemail->validaEmail($this->email,$this->confirmaEmail);

        return $this;
    }

    public function verifySenha(Senha $objSenha):self
    {
        $this->senha = $objSenha->getSenha();
        $this->contraSenha = $objSenha->getContraSenha();

        $objSenha->verificaSenha($this->senha,$this->contraSenha);
        
        return $this;
    }

    public function data(array $data):self
    {
       foreach($this->verifyId() as  $indice){
            $firstIndice = $indice['idUser'] + 1;
         }

        array_unshift($data,$firstIndice);

       return $this;
    }

    public function get():void
    {

    }

}

