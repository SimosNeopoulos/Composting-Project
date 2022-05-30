<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $city;
    private $password;
    private $telephone;
    private $imgpath;
    private $is_admin;

    public function __construct($id, $username, $email, $city, $password, $telephone, $is_admin=0, $imgpath="../images/profile-circle.png") {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->city = $city;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->is_admin = $is_admin;
        $this->imgpath = $imgpath;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setAddress($city) {
        $this->city = $city;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function isAdmin() {
        return $this->is_admin;
    }

    public function setImagePath($imgpath) {
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
        return $this->city;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getImagePath() {
        return $this->imgpath;
    }
}
?>