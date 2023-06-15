<?php

class Member extends Model
{

    private $id;
    private $is_admin;
    private $username;
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $phone_number;
    private $adress;
    private $zip_code;
    private $town;
    private $registration_date;
    private $token;
    private $token_validation_date;
    private $cash;

    public function __construct($id,$is_admin,$username,$email,$password,$firstname,$lastname,$birthdate,$phone_number,$adress,$zip_code,$town,$registration_date,$token,$token_validation_date,$cash)
    {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->phone_number = $phone_number;
        $this->adress = $adress;
        $this->zip_code = $zip_code;
        $this->town = $town;
        $this->registration_date = $registration_date;
        $this->token = $token;
        $this->token_validation_date = $token_validation_date;
        $this->cash = $cash;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIs_admin()
    {
        return $this->is_admin;
    }

    public function setIs_admin($is_admin): void
    {
        $this->is_admin = $is_admin;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getPhone_number()
    {
        return $this->phone_number;
    }

    public function setPhone_number($phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function setAdress($adress): void
    {
        $this->adress = $adress;
    }

    public function getZip_code()
    {
        return $this->zip_code;
    }

    public function setZip_code($zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function setTown($town): void
    {
        $this->town = $town;
    }

    public function getRegistration_date()
    {
        return $this->registration_date;
    }

    public function setRegistration_date($registration_date): void
    {
        $this->registration_date = $registration_date;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function getToken_validation_date()
    {
        return $this->token_validation_date;
    }

    public function setToken_validation_date($token_validation_date): void
    {
        $this->token_validation_date = $token_validation_date;
    }

    public function getCash()
    {
        return $this->cash;
    }

    public function setCash($cash): void
    {
        $this->cash = $cash;
    }
}

?>