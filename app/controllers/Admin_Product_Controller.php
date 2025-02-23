<?php
require "./core/Controller.php";

class Admin_Product_Controller extends Controller
{

    public $admin_product_model;
    public $data = [];

    public function __construct()
    {
        $this->admin_product_model = $this->model('Admin_Product_Model');
    }

    public function index()
    {

        $pros = $this->admin_product_model->getAllPro();
        $image = $this->admin_product_model->getProductImages();

        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/index';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'pros' => $pros,
            'image' => $image,
        ];

        $this->render('layout/admin', $this->data);
    }
    public function product()
    {
        $pros = $this->admin_product_model->getAllPro();
        $this->data['content'] = 'admin/admin_product';
        $this->data['sub_content'] = ['pros' => $pros];
        $this->render('layout/admin', $this->data);
    }
    public function insert()
    {
        $cate = $this -> admin_product_model -> getAllCate();
        $this->data['content'] = 'admin/insert_product';
        $this->data['sub_content'] = [
            'cate' => $cate,
        ];
        $this->render('layout/admin', $this->data);
    }
    public function edit_product($id)
    {
        $cate = $this->admin_product_model->getAllCate();
        $pro = $this -> admin_product_model -> getProductById($id);
        $img = $this -> admin_product_model -> getProductImageById($id);
        $this->data['content'] = 'admin/edit_product';
        $this->data['sub_content'] = [
            'pro' => $pro,
            'cate' => $cate,
            'img' => $img,
        ];
        $this->render('layout/admin', $this->data);
    }

    public function insert_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu cơ bản từ form
            $name         = trim($_POST['name']);
            $price        = trim($_POST['price']);
            $sale_percent = trim($_POST['sale_percent']);
            $description  = trim($_POST['description']);
            $cate         = trim($_POST['cate']);

            if (empty($name) || empty($price) || empty($sale_percent) || empty($description) || empty($cate)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin";
                header("Location:" . _WEB_ROOT_ . "/admin/insert_product_page");
                exit;
            }

            $image_show = '';
            if (isset($_FILES['image_show']) && $_FILES['image_show']['error'] === UPLOAD_ERR_OK) {
                $uploadDir  = "public/image_product/";
                $fileName   = time() . '-' . basename($_FILES['image_show']['name']);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image_show']['tmp_name'], $targetFile)) {
                    $image_show = $fileName;
                } else {
                    $_SESSION['error'] = "Upload ảnh chính thất bại";
                    header("Location:" . _WEB_ROOT_ . "/admin/insert_product_page");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Ảnh chính không được để trống";
                header("Location:" . _WEB_ROOT_ . "/admin/insert_product_page");
                exit;
            }


            $detailImages = [];
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                $uploadDir = "public/image_product/";
                foreach ($_FILES['image']['name'] as $key => $imgName) {
                    if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                        $fileName   = time() . '-' . basename($imgName);
                        $targetFile = $uploadDir . $fileName;
                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFile)) {
                            $detailImages[] = $fileName;
                        }
                    }
                }
            }

            $this->admin_product_model->setName($name);
            $this->admin_product_model->setImageShow($image_show);  
            $this->admin_product_model->setImageUrl($detailImages);   
            $this->admin_product_model->setPrice($price);
            $this->admin_product_model->setSalepercent($sale_percent);
            $this->admin_product_model->setDescription($description);
            $this->admin_product_model->setCategoryId($cate);

            $lastInsertId = $this->admin_product_model->insertProduct($this->admin_product_model);
            if ($lastInsertId) {
                $_SESSION['success'] = "Thêm sản phẩm thành công";
                header("Location:" . _WEB_ROOT_ . "/admin/product");
                exit;
            } else {
                $_SESSION['error'] = "Thêm sản phẩm thất bại";
                header("Location:" . _WEB_ROOT_ . "/admin/insert_product_page");
                exit;
            }
        } else {
            $_SESSION['error'] = "Phương thức không hợp lệ";
        }
        $this->data['content'] = 'admin/insert_product';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }


    public function delete($id)
    {
        // Lấy thông tin sản phẩm trước khi xóa
        $product = $this->admin_product_model->getProductById($id);
        $productName = $product['name']; 

        if ($this->admin_product_model->deleteProduct($id)) {
            $_SESSION['success'] = "Xóa sản phẩm '" . $productName . "' thành công";
            header("Location: " . _WEB_ROOT_ . "/admin/product");
            exit;
        } else {
            $_SESSION['error'] = "Xóa sản phẩm '" . $productName . "' thất bại";
            header("Location: " . _WEB_ROOT_ . "/admin/product");
            exit;
        }

        $this->data['content'] = 'admin/product';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }

    public function update_product($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            $name         = trim($_POST['name']);
            $price        = trim($_POST['price']);
            $sale_percent = trim($_POST['sale_percent']);
            $cate         = trim($_POST['cate']);

            if (empty($name) || empty($price) || empty($sale_percent)  || empty($cate)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin";
                header("Location:" . _WEB_ROOT_ . "/admin/edit_product_page/=" . $id);
                exit;
            }

          
            $oldProduct = $this->admin_product_model->getProductById($id);
            $oldImage = $this -> admin_product_model -> getProductImagesById($id);
            if (!$oldProduct) {
                $_SESSION['error'] = "Sản phẩm không tồn tại";
                header("Location:" . _WEB_ROOT_ . "/admin/product");
                exit;
            }

            $image_show = $oldImage['image_show']; // Giữ ảnh chính cũ nếu không thay đổi
            if (isset($_FILES['image_show']) && $_FILES['image_show']['error'] === UPLOAD_ERR_OK) {
                $uploadDir  = "public/image_product/";
                $fileName   = time() . '-' . basename($_FILES['image_show']['name']);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image_show']['tmp_name'], $targetFile)) {
                    $image_show = $fileName;
                } else {
                    $_SESSION['error'] = "Cập nhật ảnh chính thất bại";
                    header("Location:" . _WEB_ROOT_ . "/admin/edit_product_page?id=" . $id);
                    exit;
                }
            }

           
            $detailImages = $oldImage['image_url'] ? explode(',', $oldProduct['image_url']) : [];
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                $uploadDir = "public/image_product/";
                foreach ($_FILES['image']['name'] as $key => $imgName) {
                    if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                        $fileName   = time() . '-' . basename($imgName);
                        $targetFile = $uploadDir . $fileName;
                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFile)) {
                            $detailImages[] = $fileName;
                        }
                    }
                }
            }

            
            $this->admin_product_model->setId($id);
            $this->admin_product_model->setName($name);
            $this->admin_product_model->setImageShow($image_show);
            $this->admin_product_model->setImageUrl($detailImages);
            $this->admin_product_model->setPrice($price);
            $this->admin_product_model->setSalepercent($sale_percent);
            $this->admin_product_model->setCategoryId($cate);

            if ($this->admin_product_model->updateProduct($this->admin_product_model)) {
                $_SESSION['success'] = "Cập nhật sản phẩm thành công";
                header("Location:" . _WEB_ROOT_ . "/admin/product");
                exit;
            } else {
                $_SESSION['error'] = "Cập nhật sản phẩm thất bại";
                header("Location:" . _WEB_ROOT_ . "/admin/edit_product_page/" . $id);
                exit;
            }
        } else {
            $_SESSION['error'] = "Phương thức không hợp lệ";
        }

        $this->data['content'] = 'admin/edit_product';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }


    
}
