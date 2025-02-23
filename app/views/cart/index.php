<div class="info_product">
    <a href="">Trang chủ</a>
    <a href="">Giỏ hàng</a>
</div>
<!-- START CART -->
<div class="header_cart">
    <h1> Giỏ hàng của bạn</h1>
</div>
<div class="main_cart">

    <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $c): ?>
            <div class="item_cart">
                <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $c['image'] ?>" alt="" width="100px" height="100px">
                <div class="in4_item">
                    <h3><?= $c['name'] ?></h3>
                    <span><?= number_format($c['price'], 0, ',', '.') ?> đ</span>
                    <span>3.5 UK - 36 EUR - 22.5 cm</span>
                    <div style="display: flex; align-items: center; gap: 5px;">
                        <a style="display: flex; width: 30px; height: 30px; background-color: #ddd; color: black; justify-content: center; align-items: center; text-decoration: none; border: 1px solid #ccc;"
                            href="<?= _WEB_ROOT_ ?>/tang_giam_so_luong/<?= $c['id'] ?>/<?= $c['product_id'] ?>/lest">-</a>

                        <span style="min-width: 30px; text-align: center;"><?= $c['quantity'] ?></span>

                        <a style="display: flex; width: 30px; height: 30px; background-color: #ddd; color: black; justify-content: center; align-items: center; text-decoration: none; border: 1px solid #ccc;"
                            href="<?= _WEB_ROOT_ ?>/tang_giam_so_luong/<?= $c['id'] ?>/<?= $c['product_id'] ?>/more">+</a>
                    </div>
                </div>
                <div class="delete">
                    <a style="color: black" href="<?= _WEB_ROOT_ ?>/cart/delete/<?= $c['id'] ?>/<?= $c['product_id'] ?>"><i class="fa-solid fa-trash fa-xl"></i></a>
                    <h4><?= number_format($c['price'] * $c['quantity'], 0, ',', '.') ?> đ</h4>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h3 style="color: red; margin-left: 20px">Giỏ hàng của bạn đang trống hãy thêm sản phẩm mới vào giỏ hàng của bạn !!!</h3>
    <?php endif; ?>

</div>
<div class="footer_cart" style="margin-bottom: 100px;">
    <?php if (!empty($cart)): ?>
        <?php
        $tong_tien = 0;
        foreach ($cart as $c) {
            $tong_tien += $c['price'] * $c['quantity'];
        }
        ?>
        <div class="tong_tien" style="margin-right: 50px">
            <span style="margin: 0; padding: 0;">Tổng tiền:</span>
            <h1><?= number_format($tong_tien, 0, ',', '.') ?>đ</h1>
            <span>
                <input type="checkbox"> Tôi đồng ý với các điều khoản và các chính sách khác
            </span>
            <div class="button_cart">
                <button style="height: 50px; width: 250px;">TIẾP TỤC MUA HÀNG</button>
                <button style="height: 50px; width: 180px;">THANH TOÁN</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- END CART -->