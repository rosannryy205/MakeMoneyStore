<main class="main-contentad">
    <h2>Quản lý sản phẩm</h2>
    <table>
        <tr>
            <th style="font-size: 11.5px;">ID</th>
            <th style="font-size: 11.5px;">Sản phẩm</th>
            <th style="font-size: 11.5px;">Tên sản phẩm</th>
            <th style="font-size: 11.5px;">Giá</th>
            <th style="font-size: 11.5px;">Giảm</th>
            <th style="font-size: 11.5px;">Danh mục</th>
            <th style="font-size: 11.5px;">Thao tác</th>
        </tr>


        <?php foreach ($pros as $p) { ?>
            <tr>
                <td><?= $p['id_pro'] ?></td>
                <td><img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $p['image'] ?>" alt="" height="50px" width="50px"></td>
                <td><?= $p['product_name'] ?></td>
                <td><?= $p['price'] ?></td>
                <td><?= $p['sale_percent'] ?>%</td>
                <td><?= $p['cate_name'] ?></td>
                <td><button class="delete-btn">Sửa</button>
                    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/xoa-san-pham/<?= $p['id_pro'] ?>'" class="delete-btn">Xóa</button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if (!empty($_SESSION['error'])): ?>
        <div style="color: red; font-weight: bold; margin-top:20px; margin-bottom: 20px">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Hiển thị thông báo thành công nếu có -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div style="color: green; font-weight: bold; margin-top:20px; margin-bottom: 20px">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/insert_product_page'">Thêm sản phẩm</button>
</main>