<?php
    namespace Weliton\Login\Domain\Model;

class Senha
{
    private string $senha;
    private string $contraSenha;

    public function __construct(string $senha , string $contraSenha)
    {
        $this->senha = $senha; 
        $this->contraSenha = $contraSenha;   

       // $this->verificaSenha($senha,$contraSenha);
        
    }   

    public function verificaSenha(string $senha, string $contraSenha):bool
    {
         // verificar se tem letras maiuculas e numeros e caracteres especiais
        $verifica = preg_match('/[a-z]/',$senha) && preg_match('/[A-Z]/',$senha)
        && preg_match('/[0-9]/',$senha) ;   
 
       //verificar o tamanho da senha < 8 e > 16
       $size = strlen($senha);
       if($size >= 8 && $size <= 16 && $verifica == true && $senha == $contraSenha){
           
            
           return true;
       }else{
        
            echo "As senhas devem ser iguais e ter entre 8 e 16 caracters,
             conter pelo menos um número e uma letra maíscula <br>";
           return false;
        }
    }

    public function getSenha():string
    {
        return $this->senha;
    }

    public function getContraSenha():string
    {
        return $this->contraSenha;
    }

}
