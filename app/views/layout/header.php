<div class="container">
    <!-- START HEADER -->
    <header>
        <div class="top_header">
            <div class="left_logo">
                <img src="<?= _WEB_ROOT_ ?>/public/image/logo.png" alt="" width="180px" height="200px">
            </div>
            <div class="search">
                <form action="<?= _WEB_ROOT_ ?>/tim-kiem" method="POST">
                    <input
                        style="width:500px; height:40px; border-radius:20px 0px 0px 20px; padding-left: 15px;"
                        type="text" name="keyword" placeholder="Tìm kiếm">
                    <button
                        style="width: 60px; height: 40px; border-radius: 0px 20px 20px 0px; margin: 0px;padding: 0px;">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </button>
                </form>
            </div>
            <div class="icon_top_header" style=" width: 130px;">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if (!empty($_SESSION['user']['image'])): ?>
                        <!-- Hiển thị ảnh của người dùng nếu có -->
                        <a href="<?= _WEB_ROOT_ ?>/trang-ca-nhan">
                            <img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $_SESSION['user']['image'] ?>" alt="Avatar" class="m-0 p-0" style="width: 30px; height: 30px; border-radius: 5px;">
                        </a>
                    <?php else: ?>
                        <!-- Hiển thị ảnh mặc định nếu người dùng không có ảnh -->
                        <a href="<?= _WEB_ROOT_ ?>/trang-ca-nhan">
                            <img src="<?= _WEB_ROOT_ ?>/public/image_user/avatar-trang-4.jpg" alt="Avatar Mặc định" class="m-0 p-0" style="width: 30px; height: 30px; border-radius: 5px;">
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Hiển thị icon khi chưa đăng nhập -->
                    <a style="color: black" href="<?= _WEB_ROOT_ ?>/dang-nhap">
                        <i class="fa-regular fa-user fa-xl" style="font-size: 30px;"></i>
                    </a>
                <?php endif; ?>
                <a style="color: black" href="<?= _WEB_ROOT_ ?>/trang-yeu-thich"><i class="fa-regular fa-heart fa-xl"></i></a>
                <a style="color: black" href="<?= _WEB_ROOT_ ?>/theo-doi-don-hang"><i class="fa-solid fa-truck-fast fa-xl"></i></a>
                <a style="color: black" href="<?= _WEB_ROOT_ ?>/gio-hang"><i class="fa-solid fa-bag-shopping fa-xl"></i></a>
            </div>
        </div>
        <nav>
            <div class="menu">
                <a href="<?= _WEB_ROOT_ ?>/">Trang Chủ</a>
                <a href="<?= _WEB_ROOT_ ?>/san-pham">Giày Sneaker</a>
                <a href="">Nón/Mini bag</a>
                <a href="">Phụ Kiện Chính Hãng</a>
                <a href=""><strong>BIG SALE</strong></a>
                <a href="">Tra Cứu Đơn Hàng</a>
                <a href="">Chính Sách Khánh Hàng</a>
                <a href="">Địa Chỉ</a>
                <a href="">Về Chúng Tôi</a>
            </div>
        </nav>
    </header>