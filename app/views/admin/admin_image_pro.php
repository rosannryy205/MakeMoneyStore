<main class="main-contentad">
    <h2>Quản lý sản phẩm</h2>
    <table>
        <tr>
            <th>ID ảnh</th>
            <th>ID Sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Thao tác</th>
        </tr>


        <?php foreach ($imgae as $i) { ?>
            <tr>
                <td><?= $i['id_img'] ?></td>
                <td><?= $i['id'] ?></td>
                <td><img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $i['image_url'] ?>" alt="" height="50px" width="50px"></td>
                <td><?= $i['name'] ?></td>
                <td><button class="delete-btn">Sửa</button><button class="delete-btn">Xóa</button></td>
            </tr>
        <?php } ?>

    </table>
    <button>Thêm sản phẩm</button>
</main>