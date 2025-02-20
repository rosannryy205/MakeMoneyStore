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
                <td><?= $p['id'] ?></td>
                <td><img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $p['image'] ?>" alt="" height="50px" width="50px"></td>
                <td><?= $p['name'] ?></td>
                <td><?= $p['price'] ?></td>
                <td><?= $p['sale_percent'] ?>%</td>
                <td><?= $p['category_id'] ?></td>
                <td><button class="delete-btn">Sửa</button><button class="delete-btn">Xóa</button></td>
            </tr>
        <?php } ?>

    </table>
    <button onclick="location.href='<?=_WEB_ROOT_?>/admin/insert'">Thêm sản phẩm</button>
</main>