<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $address;
    private $password;
    private $telephone;
    private $imgpath;
    private $is_admin;

    public function __construct($id, $username, $email, $address, $password, $telephone, $is_admin=0, $imgpath="../images/profile-circle.png") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->is_admin = $is_admin;
        $this->imgpath = $imgpath;
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

    public function isAdmin() {
        return $this->is_admin;
    }

    public function getImagePath() {
        return $this->imgpath;
    }
}
?>