<?php
require "./core/Model.php";

class Admin_Product_Model extends Model
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

    public function getAllPro()
    {
        $sql = "SELECT * FROM products ";
        return $this->db->getAll($sql);
    }

    public function getAllCate()
    {
        $sql = "SELECT * FROM categories ";
        return $this->db->getAll($sql);
    }


    public function getAllImagePro(){
        $sql = "SELECT pi.id AS id_img, pi.*, p.* FROM product_images pi INNER JOIN products p ON pi.product_id = p.id";
        return $this->db->getAll($sql);
    }

}
