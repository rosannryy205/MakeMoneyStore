<div class="contailer">
    <div class="forms-contailer">
        <div class="signin-signup">
            <form action="<?= _WEB_ROOT_ ?>/dang-nhap-tai-khoan" method="post" class="sign-in-form">
                <h2 class="title">Đăng Nhập</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="email" type="text" placeholder="Email đăng nhập">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" placeholder="Mật khẩu">
                </div>
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

                <input type="submit" value="Đăng nhập" class="btnlg solid" style="background-color:#e63636; color:#FFF">
                <a style="text-decoration: none; color:#e63636 ;" href="<?= _WEB_ROOT_ ?>/quen-mat-khau">Quên mật khẩu</a>
                <p class="social-text">Hoặc đăng nhập tại đây</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </form>

            <form action="<?= _WEB_ROOT_ ?>/dang-ky-tai-khoan" class="sign-up-form" method="post" enctype="multipart/form-data">
                <h2 class="title">Đăng Ký</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Họ và tên" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" name="phone" placeholder="Số điện thoại" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Mật khẩu">
                </div>
                <input type="submit" value="Đăng ký" class="btnlg solid" style="background-color:#e63636; color:#FFF">
                <p class="social-text">Hoặc đăng ký tại đây</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="panels-contailer">
        <div class="panel left-panel">
            <div class="content">
                <h3>Tạo tài khoản mới !!</h3>
                <p style="color:#FFF">Đăng ký tài khoản ngay để khám phá ưu đãi độc quyền và trải nghiệm dịch vụ tuyệt vời từ chúng tôi! Tham gia ngay – chỉ vài bước đơn giản!</p>
                <button class="btnlg transparent" id="sign-up-btnlg" style=" margin: 0;background: none;border: 2px solid white;width: 130px;height: 41px;font-weight: 400; color:#FFF">Đăng ký</button>
            </div>
            <img src="<?= _WEB_ROOT_ ?>/public/image/sticker.png" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>Đăng nhập thoi !!</h3>
                <p style="color:#FFF">Tài khoản của bạn đã sẵn sàng chưa! Đăng nhập ngay để bắt đầu trải nghiệm tất cả các tính năng tuyệt vời mà chúng tôi mang đến!</p>
                <button class="btnlg transparent" id="sign-in-btnlg" style=" margin: 0;background: none;border: 2px solid white;width: 130px;height: 41px;font-weight: 400; color:#FFF">Đăng nhập</button>
            </div>
            <img src="<?= _WEB_ROOT_ ?>/public/image/sticker2.png" class="image" alt="">
        </div>
    </div>
</div>
<script>
    const sign_in_btnlg = document.querySelector("#sign-in-btnlg");
    const sign_up_btnlg = document.querySelector("#sign-up-btnlg");
    const container = document.querySelector(".contailer");

    sign_up_btnlg.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    sign_in_btnlg.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });
</script>