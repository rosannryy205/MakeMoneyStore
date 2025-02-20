    <div class="forgot-container my-4">
        <h2>Quên mật khẩu</h2>
        <p>Nhập email để đặt lại mật khẩu của bạn.</p>
        <form action="<?= _WEB_ROOT_ ?>/auth/forget_password" id="forgot-password-form" method='POST'>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Nhập email">
            <?php if (!empty($this->errorMessage)): ?>
                <div class="alert alert-danger" style="color: red; font-weight: bold; margin-bottom: 15px;">
                    <?= htmlspecialchars($this->errorMessage) ?>
                </div>
            <?php elseif (empty($this->errorMessage) && isset($this->successMessage)): ?>
                <div class="alert alert-success" style="color: green; font-weight: bold; margin-bottom: 15px;">
                    <?= htmlspecialchars($this->successMessage) ?>
                </div>
            <?php endif; ?>
            <button type="submit">Gửi yêu cầu</button>
        </form>
        <div class="forgot-footer">
            <a href="<?= _WEB_ROOT_ ?>/dang-nhap">Quay lại đăng nhập</a>
        </div>
    </div>