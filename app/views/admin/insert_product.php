<main class="main-contentad">
    <h2>Thêm sản phẩm</h2>
    <br>
    <form action="<?= _WEB_ROOT_ ?>/admin/them-san-pham" method="post" enctype="multipart/form-data">
        <label for="">Tên sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="">
        <br>
        <br>
        <label for="">Ảnh chính sản phẩm:</label><br>
        <div style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px; border: 1px solid black">
            <input style="padding-top: 13px; width: 400px;" type="file" name="image_show">
        </div>
        <br>
        <br>
        <label for="">Ảnh chi tiết sản phẩm:</label><br>
        <div style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px; border: 1px solid black">
            <input style="padding-top: 13px; width: 400px;" type="file" name="image[]" multiple>
        </div>
        <br>
        <br>
        <label for="">Size sản phẩm:</label><br>
        <div style="width: 400px; border: 1px solid black; border-radius: 10px; padding: 10px;">
            <?php foreach ($sizes as $s): ?>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="size[]" value="<?= $s['id'] ?>" style="width: 12px; height: 12px;">
                    <?= $s['size_name'] ?>
                </label>
            <?php endforeach; ?>
        </div>
        <br>
        <br>
        <label for="">Giá sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="price" value="">
        <br>
        <br>
        <label for="">Phần trăm giảm của sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="">
        <br>
        <br>
        <label for="">Mô tả:</label><br>
        <input style="width: 400px; height: 250px; border-radius: 30px; padding-left: 20px" type="text" name="description" value="">
        <br>
        <br>
        <select style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" name="cate" id="cate">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($cate as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
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
        <button>Thêm sản phẩm </button>
    </form>
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/category'">Hủy</button>
</main>