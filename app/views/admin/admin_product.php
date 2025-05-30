<main class="main-contentad">
    <h2>Quản lý sản phẩm</h2>
    <button style="margin-left: 1230px" onclick="location.href='<?= _WEB_ROOT_ ?>/admin/insert_product_page'">Thêm sản phẩm</button>
    <table>
        <tr>
            <th style="font-size: 11.5px;">ID</th>
            <th style="font-size: 11.5px;">Ảnh sản phẩm</th>
            <th style="font-size: 11.5px;">Ảnh chi tiết</th>
            <th style="font-size: 11.5px;">Tên sản phẩm</th>
            <th style="font-size: 11.5px;">Giá</th>
            <th style="font-size: 11.5px;">Giảm</th>
            <th style="font-size: 11.5px;">Danh mục</th>
            <th style="font-size: 11.5px;">Thao tác</th>
        </tr>


        <?php foreach ($pros as $pro) { ?>
            <tr>
                <td><?= $pro['id_pro'] ?></td>
                <td style="display: flex; justify-content: center; gap: 10px">
                    <?php if (!empty($pro['main_image'])): ?>
                        <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $pro['main_image'] ?>" alt="Ảnh chính" height="50px" width="50px">
                    <?php else: ?>
                        <span>Không có ảnh chính</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    if (!empty($pro['detail_images'])) {
                        $detail_images = explode(',', $pro['detail_images']);
                        $detail_images = array_slice($detail_images, 0, 6);
                        foreach ($detail_images as $img_url) {
                            echo '<img src="' . _WEB_ROOT_ . '/public/image_product/' . $img_url . '" alt="Ảnh chi tiết" height="50px" width="50px"> ';
                        }
                    } else {
                        echo 'Không có ảnh chi tiết';
                    }
                    ?>
                </td>
                <td style="width: 250px;">
                    <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 250px;">
                        <?= $pro['product_name'] ?>
                    </div>
                </td>
                <td><?= number_format($pro['price'], 0, ',', '.') . ' VNĐ' ?></td>
                <td><?= $pro['sale_percent'] ?>%</td>
                <td><?= $pro['cate_name'] ?></td>
                <td>
                    <div style="margin-left: 30px;">
                        <button style="background-color: #F5CC47;" onclick="location.href='<?= _WEB_ROOT_ ?>/admin/cap-nhat-san-pham/<?= $pro['id_pro'] ?>'"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></button>
                        <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/xoa-san-pham/<?= $pro['id_pro'] ?>'"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </div>
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
</main>