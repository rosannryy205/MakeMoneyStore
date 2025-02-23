<main class="main-contentad">
    <h2>Thống kê đơn hàng</h2>
    <h2>Thống kê hệ thống</h2>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Loại thống kê</th>
            <th>Số lượng</th>
        </tr>
        <tr>
            <td>Tổng số người dùng</td>
            <td><?= $stats['total_users'] ?></td>
        </tr>
        <tr>
            <td>Tổng số sản phẩm</td>
            <td><?= $stats['total_products'] ?></td>
        </tr>
        <tr>
            <td>Tổng số danh mục</td>
            <td><?= $stats['total_categories'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng trong giỏ hàng</td>
            <td><?= $stats['gio_hang'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng chờ xác nhận</td>
            <td><?= $stats['cho_xac_nhan'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng đang chuẩn bị</td>
            <td><?= $stats['dang_chuan_bi'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng đang giao</td>
            <td><?= $stats['dang_giao_hang'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng hoàn tất</td>
            <td><?= $stats['hoan_tat_don_hang'] ?></td>
        </tr>
        <tr>
            <td>Số đơn hàng bị hủy</td>
            <td><?= $stats['huy_don'] ?></td>
        </tr>
    </table>

</main>