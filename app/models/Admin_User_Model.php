<?php
require "./core/Model.php";

class Admin_User_Model extends Model
{
    private $id;
    private $name;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getAllUser()
    {
        $sql = "SELECT * FROM users ";
        return $this->db->getAll($sql);
    }

    
}
