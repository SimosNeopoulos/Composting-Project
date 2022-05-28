<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $address;
    private $password;
    private $telephone;
    private $imgpath;

    public function __construct($id, $username, $email, $address, $password, $telephone) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->imgpath = '../images/profile-circle.png';
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getImgpath() {
        return $this-> imgpath;
    }
}
?>