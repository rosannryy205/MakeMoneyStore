<main class="main-contentad">
    <?php if (!empty($order)) { ?>
        <table border="1" cellpadding="5" style="margin: auto;">
            <tr>
                <th>Ảnh sản phẩm</th>
                <th>Size</th>
                <th>Tên sản phẩm</th>
                <th>Ngày đặt</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
            <?php foreach ($order as $o) { ?>
                <tr>
                    <td>
                        <img src="<?= _WEB_ROOT_ ?>/public/image_product/<?= $o['image_show'] ?>" alt="Ảnh chính" height="50px" width="50px">
                    </td>
                    <td><?= $o['size_name'] ?></td>
                    <td style="width: 250px;">
                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 250px;">
                            <?= $o['name_product'] ?>
                        </div>
                    </td>
                    <td><?= date('d/m/Y', strtotime($o['create_at'])) ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?= $o['quantity'] ?></td>
                    <td><?= number_format($o['total_amount'], 0, ',', '.') ?> VNĐ</td>
                    <td><?= $o['trangthai'] ?> </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <img style="margin-left: 500px; margin-top:200px; margin-bottom:200px" src="<?= _WEB_ROOT_ ?>/public/image/unnamed.png" alt="">
    <?php } ?>

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
</main>

<style>
    table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background: #f10909;
        color: #fff;
        text-transform: uppercase;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
    tr:hover {
        background: #f1f1f1;
    }
    img {
        border-radius: 5px;
    }
</style>