<?php
require "./core/Model.php";

class Admin_Product_Model extends Model
{
    private $id;
    private $name;
    private $image_url;
    private $category_id;
    private $price;
    private $description;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getter and Setter for $id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter and Setter for $name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter and Setter for $image_url
    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    // Getter and Setter for $category_id
    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    // Getter and Setter for $price
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    // Getter and Setter for $description
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function insertProduct(Admin_Product_Model $pro){
        $name = $pro -> getName();
        $image = $pro -> getImageUrl();


    }

}
