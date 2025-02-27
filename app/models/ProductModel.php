<?php
require "./core/Model.php";

class ProductModel extends Model
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


    public function getSales()
    {
        $sql = "SELECT 
                p.*, 
                pi.image_show
                FROM products AS p
                LEFT JOIN product_images AS pi 
                ON p.id = pi.product_id 
                AND (pi.image_show IS NOT NULL AND pi.image_show <> '')
                ORDER BY p.sales DESC
                LIMIT 5;";
        return $this->db->getAll($sql);
    }

    
    public function getProducts()
    {
        $sql = "SELECT 
                p.*, 
                pi.image_show
                FROM products AS p
                LEFT JOIN product_images AS pi 
                ON p.id = pi.product_id 
                AND (pi.image_show IS NOT NULL AND pi.image_show <> '');";
        return $this->db->getAll($sql);
    }



    public function getRelatedProduct(){
        $sql = "SELECT 
                p.*, 
                pi.image_show
                FROM products AS p
                LEFT JOIN product_images AS pi 
                ON p.id = pi.product_id 
                AND (pi.image_show IS NOT NULL AND pi.image_show <> '')
                LIMIT 8;";
        return $this -> db -> getAll($sql);
    }

    public function getOneProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        return $this->db->getOne($sql,[':id'=>$id]);
    }

    public function getProductImages($productId)
    {
        $sql = "SELECT image_url FROM product_images WHERE product_id = :product_id";
        return $this->db->getAll($sql, [':product_id' => $productId]);
    }

    public function getProductSizes($productId)
    {
        $sql = "SELECT 
            ps.id AS product_size_id, 
            s.id AS size_id, 
            s.size_name, 
            ps.stock 
        FROM product_sizes ps 
        INNER JOIN sizes s ON ps.size_id = s.id 
        WHERE ps.product_id = :product_id";
        return $this->db->getAll($sql, [':product_id' => $productId]);
    }

    public function searchProduct($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT 
                p.*, 
                pi.image_show as image_show
            FROM products p
            LEFT JOIN product_images pi ON p.id = pi.product_id
            WHERE p.name LIKE :keyword OR p.description LIKE :keyword
            GROUP BY p.id";

        return $this->db->getAll($sql, [':keyword' => $keyword]);
    }


}
