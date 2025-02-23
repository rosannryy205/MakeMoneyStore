<!-- BANNER START -->
<div class="banner">
    <img src=" <?= _WEB_ROOT_ ?>/public/image/banner_top_header.webp" alt="" width="100%" height="650px">
</div>
<div class="bottom_header">
    <div class="bottom_header_content">
        <i class="fa-solid fa-truck fa-2xl"></i>
        <p>GIAO HÀNG MIỄN PHÍ</p>
        <p>Cho đơn hàng trên 1.800.000 vnđ</p>
    </div>
    <div class="bottom_header_content">
        <i class="fa-solid fa-dice-d6 fa-2xl"></i>
        <p>HỖ TRỢ ĐỔI SIZE</p>
        <p>Trong vòng 3 ngày. Sau 15h mỗi ngày.</p>
    </div>
    <div class="bottom_header_content">
        <i class="fa-solid fa-tag fa-2xl"></i>
        <p>HÀNG CHÍNH HÃNG 100%</p>
        <p>Đại lý ủy quyền Converse Vietnam. Cam <br> kết bồi thường gấp đôi nếu phát hiện hàng <br> fake/giả.</p>
    </div>
    <div class="bottom_header_content">
        <i class="fa-solid fa-phone-volume fa-2xl"></i>
        <p>ĐẶT HÀNG TRỰC TUYẾN</p>
        <p>Hotline: 0944 139 255</p>
    </div>
</div>
<!-- BANNER END -->
<!-- END HEADER -->
<!-- START MAIN -->
<main>
    <div class="title_main">
        <h2><a href="">Sản phẩm mới</a></h2>
    </div>
    <div class="main_content">
        <div class=" item1">
            <img src="<?= _WEB_ROOT_ ?>/public/image/banner_content.webp" alt="" width="585px" height="390px">
        </div>
        <?php foreach ($pros as $pro) {
            extract($pro) ?>
            <div class="item ">
                <a href="<?= _WEB_ROOT_ ?>/chi-tiet-san-pham/<?= $id ?>">
                    <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $image_show ?>" alt="" width="285px" height="273px">
                    <span class="product_name">
                        <h5><?= $name ?></h5>
                    </span>
                    <span class="price"><?= $price ?>đ</span>
                    <span class="discount">hoặc 411,000₫ x3 kỳ với <span style="color: aqua;">Fundiin</span></span>
                    <div class="discount_percent">
                        <?= $sale_percent ?>%
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="mid_content">
        <div class="col col1">
            <img src="<?= _WEB_ROOT_ ?>/public/image/banner_mid_content.webp" alt="" width="350px" height="350px" style="box-shadow: 30px 25px 15px gray;">
        </div>
        <div class="col1">
            <div class="col1_content">
                <p style="color: gray;">KCONS.VN</p>
                <div class="tab_content">
                    <p><a href="">Chúng Tôi Cam Kết Mang Lại Sản Phẩm Chính Hãng Với Giá Tốt Nhất</a></p>
                </div>
                <div class="lienhe"><a href="">THÔNG TIN</a><a href="">ĐỊA CHỈ</a><a href="">CHÍNH SÁCH KHÁCH HÀNG</a></div>

                <p style="color: gray;">Với hơn 10 năm (since 2013) kinh nghiệm trong lĩnh vực thời trang giày dép chính hãng, chúng tôi tự tin mang lại cho khách hàng những sản phẩm tuyệt vời nhất, đảm bảo về chất lượng, hợp lý về giá cả. Với 02 chi nhánh tại HCM & Cần Thơ.</p>
                <div class="button">
                    <h3>XEM NGAY</h3>
                </div>
            </div>

        </div>
        <div class="col2">
            <img src="<?= _WEB_ROOT_ ?>/public/image/img_mid_content.jpg" alt="" width="780px" height="420px">
        </div>
        <div class="col2">
            <img src="<?= _WEB_ROOT_ ?>/public/image/img_mid_content2.jpg" alt="" width="750px" height="420px">
        </div>
    </div>
    <div class="bottom_banner">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom1.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom2.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom3.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom4.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom5.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom6.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom7.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom8.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom9.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom10.webp" width="100%" height="240px" alt="">
        <img src="<?= _WEB_ROOT_ ?>/public/image/banner_bottom11.webp" width="100%" height="240px" alt="">
    </div>
    <div class="email">
        <div><i style="padding-right: 10px;" class="fa-solid fa-envelope fa-xl"></i> Thông tin Big Sale</div>
        <div><input type="text" placeholder="Nhập địa chỉ email của bạn"><button>Đăng Ký</button></div>
        <div><i style="padding-right: 10px;" class="fa-solid fa-phone fa-xl"></i>Hỗ trợ mua hàng: <a style="color: red;" href="">0964006257</a></div>
    </div>
</main>
<!-- END MAIN -->