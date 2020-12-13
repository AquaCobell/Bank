<?php
class User
{
    private $email = 'nico.rieser@gmail.com';
    private $password =  '1234';
    private static $user = [];
    private $error = [];



    /*public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    */
    public function __construct()
    {

    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;

    }


    public function setPassword($password)
    {
        $this->password = $password;
    }

    public static function get($email,$password) //static??
    {
        if(email ==$email && password == $password)
        {
            return  $User = new User;
        }
    }

    public static function login()
    {

    }
    public static function logout()
    {

    }
    public static function isLoggedIn()
    {

    }
    private function validateEmail()
    {

        if(filter_var($this->email, FILTER_VALIDATE_EMAIL && $this->email != ""))
        {
            $this->error['email'] = "E-mail ungültig";
            return true;
        }
        return false;
    }


    private function validatePassword()
    {

        if(strlen($this->password)<= 0)
        {
            return false;
        }
        else if(strlen($this->password)>20)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function validate()
    {
        if($this->validateEmail()&& $this->validatePassword())
        {
            return true;
        }
        return false;
    }

}
?>