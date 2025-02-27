<?php
require "./core/Model.php";

class Admin_Product_Model extends Model
{
    private $id;
    private $name;
    private $image_url;
    private $image_show;
    private $category_id;
    private $price;
    private $sale_percent;
    private $description;
    private $sales;
    private $size_id;

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

    public function getImageShow()
    {
        return $this->image_show;
    }

    public function setImageShow($image_show)
    {
        $this->image_show = $image_show;
    }
    public function getSizeIds()
    {
        return $this->size_id;
    }

    public function setSizeIds($size_id)
    {
        $this->size_id = $size_id;
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
                $sql = "SELECT 
                            cate.name AS cate_name,
                            p.name AS product_name,
                            p.id AS id_pro,
                            p.price,
                            p.sale_percent,
                            MAX(pi.image_show) AS main_image,
                            GROUP_CONCAT(pi.image_url SEPARATOR ',') AS detail_images
                        FROM products p
                        INNER JOIN categories cate ON p.category_id = cate.id
                        LEFT JOIN product_images pi ON p.id = pi.product_id
                        GROUP BY p.id
                        ORDER BY p.id ASC;
                    ";
        return $this->db->getAll($sql);
    }
    public function getProductImageById($id)
    {
        $sql = "SELECT * FROM product_images WHERE product_id = :id";
        return $this->db->getAll($sql, [':id' => $id]);
    }


    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?  ";
        $params = [
            $id,
        ];
        return $this->db->getOne($sql,$params);
    }

    public function getProductImagesById($id)
    {
        $sql = "SELECT * FROM product_images WHERE product_id = ?";
        $params = [$id];
        return $this->db->getAll($sql, $params);
    }


    public function getAllCate()
    {
        $sql = "SELECT * FROM categories  ";
        return $this->db->getAll($sql);
    }



    public function insertProduct(Admin_Product_Model $pro)
    {
        $this->db->beginTransaction();

        
        $sql_product = "INSERT INTO products (name, category_id, price, sale_percent, description, sales) 
                    VALUES (?, ?, ?, ?, ?, 0)";
        $params_product = [
            $pro->getName(),
            $pro->getCategoryId(),
            $pro->getPrice(),
            $pro->getSalepercent(),
            $pro->getDescription()
        ];
        $lastInsertId = $this->db->insert($sql_product, $params_product);
        if (!$lastInsertId) {
            $this->db->rollBack();
            return false;
        }

  
        if ($pro->getImageShow()) {
            $sql_main = "INSERT INTO product_images (product_id, image_url, image_show) 
                     VALUES (?, ?, ?)";
            $params_main = [$lastInsertId, $pro->getImageShow(), $pro->getImageShow()];
            $res_main = $this->db->insert($sql_main, $params_main);
            if (!$res_main) {
                $this->db->rollBack();
                return false;
            }
        }

    
        if ($pro->getImageUrl()) {
            if (is_array($pro->getImageUrl())) {
                foreach ($pro->getImageUrl() as $img) {
                    $sql_detail = "INSERT INTO product_images (product_id, image_url) VALUES (?, ?)";
                    $params_detail = [$lastInsertId, $img];
                    $res_detail = $this->db->insert($sql_detail, $params_detail);
                    if (!$res_detail) {
                        $this->db->rollBack();
                        return false;
                    }
                }
            } else {
                $sql_detail = "INSERT INTO product_images (product_id, image_url) VALUES (?, ?)";
                $params_detail = [$lastInsertId, $pro->getImageUrl()];
                $res_detail = $this->db->insert($sql_detail, $params_detail);
                if (!$res_detail) {
                    $this->db->rollBack();
                    return false;
                }
            }
        }

       
        if ($pro->getSizeIds()) {
            foreach ($pro->getSizeIds() as $sizeId) {
                $sql_size = "INSERT INTO product_sizes (product_id, size_id, stock) VALUES (?, ?, ?)";
                $params_size = [$lastInsertId, $sizeId, rand(20, 30)]; // Stock ngẫu nhiên từ 20 - 30
                $res_size = $this->db->insert($sql_size, $params_size);
                if (!$res_size) {
                    $this->db->rollBack();
                    return false;
                }
            }
        }

        $this->db->commit();
        return $lastInsertId;
    }




    public function deleteProduct($id)
    {
     
        $sqlImages = "DELETE FROM product_images WHERE product_id = ?";
        $paramsImages = [$id];
        $this->db->delete($sqlImages, $paramsImages);

       
        $sqlSizes = "DELETE FROM product_sizes WHERE product_id = ?";
        $paramsSizes = [$id];
        $this->db->delete($sqlSizes, $paramsSizes);

        $sqlProduct = "DELETE FROM products WHERE id = ?";
        $paramsProduct = [$id];
        return $this->db->delete($sqlProduct, $paramsProduct);
    }

    public function updateProduct(Admin_Product_Model $pro)
    {
        $this->db->beginTransaction();

        $id = $pro->getId();
        $name = $pro->getName();
        $cate = $pro->getCategoryId();
        $price = $pro->getPrice();
        $sale_percent = $pro->getSalepercent();

        // Cập nhật thông tin sản phẩm
        $sql = "UPDATE products SET name = ?, category_id = ?, price = ?, sale_percent = ? WHERE id = ?";
        $params = [$name, $cate, $price, $sale_percent, $id];
        $rowCount = $this->db->update($sql, $params);

        if ($rowCount === false) {
            $this->db->rollBack();
            return false;
        }

        // Kiểm tra nếu có ảnh mới thì mới xóa ảnh cũ
        if ($pro->getImageShow() || $pro->getImageUrl()) {
            $sql_delete = "DELETE FROM product_images WHERE product_id = ?";
            $this->db->delete($sql_delete, [$id]);

            // Cập nhật ảnh chính
            if ($pro->getImageShow()) {
                $sql_main = "INSERT INTO product_images (product_id, image_url, image_show) VALUES (?,?,?)";
                $params_main = [$id, $pro->getImageShow(), $pro->getImageShow()];
                $res_main = $this->db->insert($sql_main, $params_main);
                if (!$res_main) {
                    $this->db->rollBack();
                    return false;
                }
            }

            // Cập nhật ảnh phụ
            if ($pro->getImageUrl()) {
                $imageUrls = is_array($pro->getImageUrl()) ? $pro->getImageUrl() : [$pro->getImageUrl()];
                foreach ($imageUrls as $img) {
                    $sql_detail = "INSERT INTO product_images (product_id, image_url) VALUES (?,?)";
                    $params_detail = [$id, $img];
                    $res_detail = $this->db->insert($sql_detail, $params_detail);
                    if (!$res_detail) {
                        $this->db->rollBack();
                        return false;
                    }
                }
            }
        }

        $this->db->commit();
        return true;
    }


    public function searchProduct($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $sql = "SELECT 
                cate.name AS cate_name,
                p.name AS product_name,
                p.id AS id_pro,
                p.price,
                p.sale_percent,
                MAX(pi.image_show) AS main_image,
                GROUP_CONCAT(pi.image_url SEPARATOR ',') AS detail_images
            FROM products p
            INNER JOIN categories cate ON p.category_id = cate.id
            LEFT JOIN product_images pi ON p.id = pi.product_id
            WHERE p.name LIKE :keyword OR p.description LIKE :keyword
            GROUP BY p.id
            ORDER BY p.id ASC";

        return $this->db->getAll($sql, [':keyword' => $keyword]);
    }



    public function getSizes()
    {
        $sql = "SELECT * FROM sizes";
        return $this->db->getAll($sql);
    }

   



}
