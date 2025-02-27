            <div class="info_product">
                <a href="<?= _WEB_ROOT_ ?>/">Trang chủ</a>
                <a href="">Best Seller</a>
                <span> <?= $detail['name'] ?> </span>
                <span> <?= $detail['id'] ?> </span>
            </div>
            <!-- STAR MAIN PRODUCT DETAILS -->
            <form action="<?= _WEB_ROOT_ ?>/them-san-pham" method="post">
                <div class="main_product_details">
                    <div class="img_product_details">
                        <?php foreach ($productImages as $image): ?>
                            <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $image['image_url'] ?>" alt="Product Image" width="100%" height="507px">
                        <?php endforeach; ?>
                    </div>
                    <div class="product_details">
                        <h3><?= $detail['name'] ?></h3>
                        <div class="price_details">
                            <div class="discount_details" style="font-size: 15px; color: red;">
                                <?= $detail['sale_percent'] ?> %
                            </div>
                            <span style="font-weight: bold;">
                                <?= number_format($detail['price'], 0, ',', '.') ?> VND
                            </span>
                        </div>

                        <div class="trasau">
                            <span>Trả sau <span style="color: aqua;">499.500đ</span> x2 với</span><img src="https://assets.fundiin.vn/merchant/logo_transparent.png" alt="">
                        </div>
                        <div style="display: flex; align-items: center;">
                            <button type="button" onclick="decreaseValue()" style="width: 30px; height: 30px;">-</button>
                            <input id="productQuantity" style="height: 30px; padding-left: 10px; width: 50px; text-align: center;" type="number" name="quantity" value="1" min="1">
                            <button type="button" onclick="increaseValue()" style="width: 30px; height: 30px;">+</button>
                        </div>
                        <div class="size_products_details">
                            <input type="hidden" name="product_id" value="<?= $detail['id'] ?>">
                            <select style="height:50px; border-radius: 30px; padding-left:10px; width:250px" name="size_id" id="size_id">
                                <option value="">Chọn size cho sản phẩm</option>
                                <?php foreach ($productSizes as $ps): ?>
                                    <option value="<?= $ps['product_size_id'] ?>"><?= $ps['size_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (!empty($_SESSION['error'])): ?>
                            <div style="color: red; font-weight: bold;">
                                <?= $_SESSION['error']; ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        <div class="function_button">
                            <button class="addcart">
                                Thêm vào giỏ hàng
                            </button>
                            <button class="addfav">Thêm vào danh sách yêu thích</button>
                        </div>
            </form>
            <span class="guild_size"><i class="fa-solid fa-star fa-xl"></i> Hướng dẫn chọn size</span>
            <img src="https://theme.hstatic.net/1000387035/1001189662/14/banner_size_image.png?v=75" alt="" width="100%" height="336px">
            <div class="info_product_details">
                <h4>Thông tin sản phẩm</h4>
                <span>
                    <i class="fa-solid fa-tag fa-xl"></i> Mới, phân phối chính hãng bởi Make$
                </span>
                <span>
                    <i class="fa-solid fa-box fa-xl"></i> Hộp giày, giấy gói, tag treo, túi xách
                </span>
                <span>
                    <i class="fa-solid fa-medal fa-xl"></i> Bảo hành 30 ngày chính hãng
                </span>
                <span>
                    <i class="fa-solid fa-shield fa-xl"></i> Giá sản phẩm đã bao gồm 10% VAT
                </span>
            </div>
            <div class="details">
                <h2>Mô tả</h2>
                <p><?= $detail['description'] ?> </p>
            </div>
            </div>
            </div>
            <div class="related_products">
                <?php foreach ($prosRelated as $pro) {
                    extract($pro) ?>
                    <div class="item item2 ">
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
            <!-- END MAIN PRODUCT DETAILS -->
            <div class="email">
                <div><i style="padding-right: 10px;" class="fa-solid fa-envelope fa-xl"></i> Thông tin Big Sale</div>
                <div><input type="text" placeholder="Nhập địa chỉ email của bạn"><button>Đăng Ký</button></div>
                <div><i style="padding-right: 10px;" class="fa-solid fa-phone fa-xl"></i>Hỗ trợ mua hàng: <a style="color: red;" href="">0964006257</a></div>
            </div>
            <script>
                function increaseValue() {
                    let input = document.getElementById("productQuantity");
                    input.value = parseInt(input.value) + 1;
                }

                function decreaseValue() {
                    let input = document.getElementById("productQuantity");
                    if (input.value > parseInt(input.min)) {
                        input.value = parseInt(input.value) - 1;
                    }
                }
            </script>