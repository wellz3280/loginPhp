<?php
    namespace Weliton\Login\Domain\Model;

class Email
{
    private string $email;
    private string $confirmaEmail;


    public function validaEmail( $email,  $confirmaEmail):bool
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
           if($email == $confirmaEmail){
               $this->email = $email;
                return true;
            }else{
                $this->email= "Emails diferentes!";
                return false;
            }
        }else{
            $this->email= "Email Invalido";
            return false;
        }
   
    }

    public function getEmail():string
    {
        return $this->email;
    }
}