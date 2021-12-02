<?php
    namespace Weliton\Login\Domain\Model;

class Email
{
    private string $email;
    private string $confirmaEmail;

    public function __construct(string $email, string $confirmaEmail)
    {
        $this->email = $email;
        $this->confirmaEmail = $confirmaEmail;
        //$this->validaEmail($email,$confirmaEmail);
    }

    public function validaEmail(string $email,string  $confirmaEmail):bool
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL) == true && $email == $confirmaEmail){
     
            return true;
        
        }else{
            
            echo "Emails diferentes";
            return false;
        }
   
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getConfimateEmail():string
    {
        return $this->confirmaEmail;
    }
}