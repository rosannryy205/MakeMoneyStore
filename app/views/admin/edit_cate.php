

    <main class="main-contentad">
        <h2>Sửa danh mục</h2>
        <br>
        <form action="<?= _WEB_ROOT_ ?>/admin/update_cate/<?= $cate['id'] ?>" method="post">
            <input style="width: 250px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="id" value="<?= $cate['id'] ?>" disabled>
            <br>
            <br>
            <input style="width: 250px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="<?= $cate['name'] ?>">
            <br>
            <?php if (!empty($errors)): ?>
                <ul style="color: red;">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <button>Thay đổi</button>
        </form>
        <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/category'">Hủy</button>
    </main>
