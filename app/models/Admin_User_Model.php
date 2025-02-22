<?php
require "./core/Model.php";

class Admin_User_Model extends Model
{
    private $id;
    private $image = null;
    private $name;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $role = 0;
    private $status;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM users ";
        return $this->db->getAll($sql);
    }

    
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ? ";
        $params = [
            $id,
        ];
        return $this->db->getOne($sql,$params);
    }


    public function updateUser(Admin_User_Model $user)
    {
        $id = $user -> getId();
        $status = $user -> getStatus();
        $sql = "UPDATE users SET status = ? WHERE id = ? ";
        $params = [
            $status,
            $id,

        ];
        return $this->db->update($sql,$params);
    }

    
}
