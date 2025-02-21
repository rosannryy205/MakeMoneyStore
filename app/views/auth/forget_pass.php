    <div class="forgot-container my-4">
        <h2>Quên mật khẩu</h2>
        <p>Nhập email để đặt lại mật khẩu của bạn.</p>
        <form action="<?= _WEB_ROOT_ ?>/auth/forget_password" id="forgot-password-form" method='POST'>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Nhập email">
            <?php if (!empty($_SESSION['error'])): ?>
                <div style="color: red; font-weight: bold; margin-bottom: 20px;">
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
            <button type="submit">Gửi yêu cầu</button>
        </form>
        <div class="forgot-footer">
            <a href="<?= _WEB_ROOT_ ?>/dang-nhap">Quay lại đăng nhập</a>
        </div>
    </div>