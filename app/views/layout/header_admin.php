 <header>
     <div class="top_header" style=" background:rgb(255, 178, 178);">
         <div class="left_logo">
             <img src="<?= _WEB_ROOT_ ?>/public/image/logo.png" alt="" width="180px" height="200px">
         </div>
         <h1>Admin Dashboard</h1>

         <div class="icon_top_header">
             <?php if (isset($_SESSION['user'])): ?>
                 <?php if (!empty($_SESSION['user']['image'])): ?>
                     <!-- Hiển thị ảnh của người dùng nếu có -->
                     <a href="">
                         <img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $_SESSION['user']['image'] ?>" alt="Avatar" class="m-0 p-0" style="width: 30px; height: 30px; border-radius: 5px;">
                     </a>
                     <a href="<?= _WEB_ROOT_ ?>/dang-xuat
                     ">Logout</a>
                 <?php else: ?>
                     <!-- Hiển thị ảnh mặc định nếu người dùng không có ảnh -->
                     <a href="">
                         <img src="<?= _WEB_ROOT_ ?>/public/image_user/avatar-trang-4.jpg" alt="Avatar Mặc định" class="m-0 p-0" style="width: 30px; height: 30px; border-radius: 5px;">
                     </a>
                     <a href="<?= _WEB_ROOT_ ?>/dang-xuat">Logout</a>
                 <?php endif; ?>
             <?php else: ?>
                 <!-- Hiển thị icon khi chưa đăng nhập -->
                 <a style="color: black" href="<?= _WEB_ROOT_ ?>/dang-nhap">
                     <i class="fa-regular fa-user fa-xl" style="font-size: 30px;"></i>
                 </a>
             <?php endif; ?>
             <a style="color: black" href=""><i class="fa-regular fa-heart fa-xl"></i></a>
             <a style="color: black" href="<?= _WEB_ROOT_ ?>/gio-hang"><i class="fa-solid fa-bag-shopping fa-xl"></i></a>
         </div>
     </div>
 </header>
 <div class="containerad">
     <aside class="sidebarad">
         <div class="logo">
             <img src="<?= _WEB_ROOT_ ?>/public/image/logo.png" alt="Converse Logo" height="250px" width="210px">
         </div>
         <nav>
             <ul>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/dashboard">Dashboard</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/category">Quản lý danh mục</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/product">Quản lý sản phẩm</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/image_product">Quản lý ảnh sản phẩm</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/user">Quản lý user</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/order">Quản lý đơn hàng</a></li>
                 <hr>
             </ul>
         </nav>
     </aside>