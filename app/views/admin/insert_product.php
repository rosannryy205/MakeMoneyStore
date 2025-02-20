<main class="main-contentad">
    <h2>Thêm sản phẩm</h2>
    <br>
    <form action="<?= _WEB_ROOT_ ?>/admin/insert_product" method="post" enctype="multipart/form-data">
        <label for="">Tên sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="">
        <br>
        <br>
        <label for="">Ảnh sản phẩm:</label><br>
        <input type="file" name="image" value="">
        <br>
        <br>
        <label for="">Giá sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="price" value="">
        <br>
        <br>
        <label for="">Giá giảm của sản phẩm:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="sale_percent" value="">
        <br>
        <br>
        <label for="">Mô tả:</label><br>
        <input style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" type="text-erea" name="description" value="">
        <br>
        <br>
        <select style="width: 400px; height: 50px; border-radius: 30px; padding-left: 20px" name="" id="">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($cate as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>

        </select>
        <br>
        <?php if (!empty($errors)): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button>Thêm danh mục</button>
    </form>
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/category'">Hủy</button>
</main>