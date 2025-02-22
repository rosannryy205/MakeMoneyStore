<main class="main-contentad">
    <h2>Quản lý user</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Ảnh đại diện</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($users as $u) { ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $u['image'] ?>" alt="" height="50px" width="50px"></td>
                <td><?= $u['name'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['password'] ?></td>
                <td><?= $u['phone'] ?></td>
                <td><?= $u['address'] ?></td>
                <td><?= $u['status'] ?></td>
                <td><button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/edit_user/<?= $u['id'] ?>'" class="delete-btn">Sửa</button><button class="delete-btn">Xóa</button></td>
            </tr>
        <?php } ?>
    </table>
</main>