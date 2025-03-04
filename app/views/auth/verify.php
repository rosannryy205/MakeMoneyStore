<div class="forgot-container my-4">
    <h2>Mã xác nhận</h2>
    <p>Nhập mã xác nhận được gửi qua email của bạn</p>
    <form action="<?= _WEB_ROOT_ ?>/auth/check_verify" id="forgot-password-form" method='POST' id="forgot-password-form">
        <label for="email">Nhập tại đây:</label>
        <input type="text" id="email" name="text" placeholder="Mã xác nhận" required>
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
        <button type="submit">Gửi</button>
    </form>
    <div class="forgot-footer">
        <a href="<?= _WEB_ROOT_ ?>/tai-khoan">Quay lại đăng nhập</a>
    </div>
</div>