<main class="main-contentad">
    <h2>Quản lý danh mục</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($cate as $c) { ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['name'] ?></td>
                <td>
                    <button style="background-color: #F5CC47;" onclick="location.href='<?= _WEB_ROOT_ ?>/admin/edit_cate/<?= $c['id'] ?>'" class="delete-btn"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></button>
                    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/delete_cate/<?= $c['id'] ?>'" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');" class="delete-btn"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if (!empty($_SESSION['error'])): ?>
        <div style="color: red; font-weight: bold;">
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
    <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/insert_cate_page'">Thêm danh mục</button>
</main>
</div>