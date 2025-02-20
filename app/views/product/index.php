<!-- BANNER START -->
<div class="banner">
    <img src="https://theme.hstatic.net/1000387035/1001189662/14/collection_banner.jpg?v=75" alt="" width="100%" height="650px">
</div>
<!-- BANNER END -->
<div id="container2">
    <!-- SIDEBAR START -->
    <div class="side_bar">
        <div class="danhmuc">
            <a href="">Tất cả sản phẩm</a>
            <a href="">Sản phẩm nổi bật</a>
            <a href="">Sản phẩm khuyến mãi</a>
        </div>
        <div class="thuonghieu">
            <p>THƯƠNG HIỆU --</p> <br>
            <input type="checkbox"> <a href="">Converse</a>
        </div>
        <div class="price_product">
            <p>GIÁ SẢN PHẨM --</p> <br>
            <div><input type="checkbox"> <a href="">Dưới 500.000đ</a></div>
            <div><input type="checkbox"> <a href="">500.000đ - 1.000.000đ</a></div>
            <div><input type="checkbox"> <a href="">1.000.000đ - 1.500.000đ</a></div>
            <div><input type="checkbox"> <a href="">2.000.000đ - 5.000.000đ</a></div>
            <div><input type="checkbox"> <a href="">Trên 5.000.000đ</a></div>
        </div>
        <div class="size_product">
            <p>SIZE UK --</p> <br>
            <div class="all_size">
                <div class="size">3</div>
                <div class="size">3.5</div>
                <div class="size">4</div>
                <div class="size">4.5</div>
                <div class="size">5</div>
                <div class="size">5.5</div>
                <div class="size">6</div>
                <div class="size">6.5</div>
                <div class="size">7</div>
                <div class="size">7.5</div>
                <div class="size">8</div>
                <div class="size">8.5</div>
                <div class="size">9</div>
                <div class="size">9.5</div>
                <div class="size">10</div>
            </div>
        </div>

    </div>
    <!-- SIDEBAR END  -->
    <!-- MAIN PRODUCT START -->
    <div class="main_product">
        <?php foreach ($pros as $pro) {
            extract($pro) ?>
            <div class="item item2">
                <a href="<?= _WEB_ROOT_ ?>/chi-tiet-san-pham/<?= $id ?>">
                    <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $image ?>" alt="" width="285px" height="273px">
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
    <!-- MAIN PRODUCT END -->
</div>
<div class="email">
    <div><i style="padding-right: 10px;" class="fa-solid fa-envelope fa-xl"></i> Thông tin Big Sale</div>
    <div><input type="text" placeholder="Nhập địa chỉ email của bạn"><button>Đăng Ký</button></div>
    <div><i style="padding-right: 10px;" class="fa-solid fa-phone fa-xl"></i>Hỗ trợ mua hàng: <a style="color: red;" href="">0964006257</a></div>
</div>