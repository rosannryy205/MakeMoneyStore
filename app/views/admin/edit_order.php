<main class="main-contentad">
    <h2>Duyệt đơn hàng</h2>
    <br>
    <form action="<?= _WEB_ROOT_ ?>/admin/update_order" method="post">
        <input type="hidden" name="cart_id" value="<?= $order['id_cart'] ?>">
        <label for="">Tên sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="<?= $order['name'] ?>" disabled>
        <br>
        <br>
        <label for="">Ngày đặt:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="price" value="<?= $order['create_at'] ?>" disabled>
        <br>
        <br>
        <label for="">Số lượng:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $order['quantity'] ?>" disabled>
        <br>
        <label for="">Tổng tiền:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= number_format($order['total_amount'], 0, ',', '.') ?>" disabled>
        <br>
        <label for="">Trạng thái:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $order['trangthai'] ?>">
        <br>
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="color: red; font-weight: bold; margin-bottom: 20px; margin-top: 20px;">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Hiển thị thông báo thành công nếu có -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div style="color: green; font-weight: bold;">
                <?= $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <button>Duyệt trạng thái</button>
    </form>
</main>