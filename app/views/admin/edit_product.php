<main class="main-contentad">
    <h2>Sửa sản phẩm</h2>
    <br>
    <form action="<?= _WEB_ROOT_ ?>/admin/update_product/<?= $pro['id'] ?>" method="post" enctype="multipart/form-data">
        <label for="">Tên sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="<?= $pro['name'] ?>">
        <br>
        <br>

        <?php if (!empty($img)): ?>
            <label for="">Ảnh sản phẩm:</label><br>
            <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $img[0]['image_show'] ?>" alt="" height="200px" width="200px">
        <?php endif; ?>
        <div style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px; border: 1px solid black">
            <input style="padding-top: 13px; width: 400px;" type="file" name="image_show">
        </div>
        <br>
        <br>
        <label for="">Ảnh chi tiết sản phẩm:</label> <br>
        <?php
        if (!empty($img)):

            foreach ($img as $img):
        ?>

                <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $img['image_url'] ?>" alt="" height="50px" width="50px">
        <?php
            endforeach;
        endif;
        ?>
        <div style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px; border: 1px solid black">
            <input style="padding-top: 13px; width: 400px;" type="file" name="image[]" multiple>
        </div>

        <br>
        <br>
        <label for="">Giá sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="price" value="<?= $pro['price'] ?>">
        <br>
        <br>
        <label for="">Phần trăm giảm của sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="<?= $pro['sale_percent'] ?>">
        <br>
        <br>
        <br>
        <select style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" name="cate" id="cate">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($cate as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($pro["category_id"] == $c['id']) ? 'selected' : '' ?>><?= $c['name'] ?></option>
            <?php endforeach; ?>

        </select>
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
        <button>Thêm danh mục</button>
    </form>
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/product'">Hủy</button>
</main>