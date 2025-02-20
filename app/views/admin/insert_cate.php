
    <main class="main-contentad">
        <h2>Thêm danh mục</h2>
        <br>
        <form action="<?= _WEB_ROOT_ ?>/admin/insert_cate" method="post">
            <input style="width: 250px; height: 50px; border-radius: 30px; padding-left: 20px" type="text" name="name" value="">
            <br>
            <?php if (!empty($errors)): ?>
                <ul style="color: red;">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <button>Thêm danh mục</button>
        </form>
        <button onclick="location.href='<?= _WEB_ROOT_ ?>/admin/category'">Hủy</button>
    </main>
<