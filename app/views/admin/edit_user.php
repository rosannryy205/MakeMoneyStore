<main class="main-contentad">
    <h2>Sửa sản phẩm</h2>
    <br>
    <form action="<?= _WEB_ROOT_ ?>/admin/update_user/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
        <label for="">Tên người dùng:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="<?= $user['name'] ?>" disabled>
        <br>
        <br>
        <label for="">Ảnh người dùng:</label><br>
        <img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $user['image'] ?>" alt="" height="200px" width="200px">
        <br>
        <br>
        <label for="">Email:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="price" value="<?= $user['email'] ?>" disabled>
        <br>
        <br>
        <label for="">Mật khẩu:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $user['password'] ?>" disabled> 
        <br>
        <br>

        <label for="">Số điện thoại:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $user['phone'] ?>" disabled> 
        <br>
        <br>

        <label for="">Địa chỉ:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $user['address'] ?>" disabled> 
        <br>
        <br>

        <label for="">Trạng thái:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="status" value="<?= $user['status'] ?>">
        <br>
        <br>
        
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
        <button>Cập nhật</button>
    </form>
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/category'">Hủy</button>
</main>