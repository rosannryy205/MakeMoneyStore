<main class="main-contentad">
    <h2>Quản lý đơn hàng</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Ngày đặt</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($order as $o) { ?>

            <tr>
                <td><?= $o['id_cart'] ?></td>
                <td><?= $o['name'] ?></td>
                <td><?= $o['create_at'] ?></td>
                <td><?= $o['quantity'] ?></td>
                <td><?= $o['total_amount'] ?></td>
                <td><?= $o['trangthai'] ?></td>
                <td>
                    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/edit_order/<?= $o['id_cart'] ?>'" class="delete-btn" type="submit">Cập nhật</button>
                    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/delete_order/<?= $o['id_cart'] ?>'" class="delete-btn" type="button">Hủy</button>
                </td>
            </tr>
        <?php } ?>
    </table>
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