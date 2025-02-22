<?php
require "./core/Model.php";

class Admin_Product_Model extends Model
{
    private $id;
    private $name;
    private $image_url;
    private $category_id;
    private $price;
    private $sale_percent;
    private $description;
    private $sales;

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
    public function getSalepercent()
    {
        return $this->sale_percent;
    }

    public function setSalepercent($sale_percent)
    {
        $this->sale_percent = $sale_percent;
    }
    public function getSales()
    {
        return $this->sales;
    }

    public function setSales($sales)
    {
        $this->sales = $sales;
    }

    public function getAllPro()
    {
        $sql = "SELECT cate.name as cate_name, p.name as product_name, p.id as id_pro,  p.*, cate.* FROM products p INNER JOIN categories cate ON p.category_id = cate.id  ";
        return $this->db->getAll($sql);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?  ";
        $params = [
            $id,
        ];
        return $this->db->getOne($sql,$params);
    }

    public function getAllCate()
    {
        $sql = "SELECT * FROM categories  ";
        return $this->db->getAll($sql);
    }


    public function getAllImagePro(){
        $sql = "SELECT pi.id AS id_img, pi.*, p.* FROM product_images pi INNER JOIN products p ON pi.product_id = p.id";
        return $this->db->getAll($sql);
    }

    public function insertProduct(Admin_Product_Model $pro){
        $name = $pro -> getName();
        $image = $pro -> getImageUrl();
        $cate = $pro -> getCategoryId();
        $price = $pro -> getPrice();
        $sale_percent = $pro -> getSalepercent();
        $description = $pro -> getDescription();
        $sql = "INSERT INTO products (name, image, category_id, price, sale_percent, description, sales) VALUES (?,?,?,?,?,?,0)";
        $params = [
            $name,
            $image,
            $cate,
            $price,
            $sale_percent,
            $description,
        ];
        return $this -> db -> insert($sql,$params);
    }

    public function deleteProduct($id)
    {
        // Xóa các bản ghi liên quan trong bảng product_images
        $sqlImages = "DELETE FROM product_images WHERE product_id = ?";
        $paramsImages = [$id];
        $this->db->delete($sqlImages, $paramsImages);

        // Xóa các bản ghi liên quan trong bảng product_sizes
        $sqlSizes = "DELETE FROM product_sizes WHERE product_id = ?";
        $paramsSizes = [$id];
        $this->db->delete($sqlSizes, $paramsSizes);

        // Xóa sản phẩm trong bảng products
        $sqlProduct = "DELETE FROM products WHERE id = ?";
        $paramsProduct = [$id];
        return $this->db->delete($sqlProduct, $paramsProduct);
    }



}
