 <header>
     <div class="top_header" style=" background:#E1E1E1;">
         <div class="left_logo">
             <img src="<?= _WEB_ROOT_ ?>/public/image/logo.png" alt="" width="180px" height="200px">
         </div>
         <h1 style="color:rgb(195, 21, 21)">Admin Dashboard</h1>
         <div class="search">
             <form action="<?= _WEB_ROOT_ ?>/tim-kiem-admin" method="POST">
                 <input
                     style="width:250px; height:40px; border-radius:20px 0px 0px 20px; padding-left: 15px;"
                     type="text" name="keyword" placeholder="Tìm kiếm">
                 <button
                     style="width: 60px; height: 40px; border-radius: 0px 20px 20px 0px; margin: 0px;padding: 0px;">
                     <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                 </button>
             </form>
         </div>
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
         </div>
     </div>
     <div class="menu_admin" style="display: flex; background-color: #E1E1E1; height: 50px; width: 100%; justify-content: center; gap: 20px; align-items: center;">
         <h3 style="margin: 0;"><a href="<?= _WEB_ROOT_ ?>/dashboard" style="text-decoration: none; color: rgb(195, 21, 21);">Dashboard</a></h3>
         <h3 style="margin: 0;"><a href="<?= _WEB_ROOT_ ?>/admin/category" style="text-decoration: none; color: rgb(195, 21, 21);">Quản lý danh mục</a></h3>
         <h3 style="margin: 0;"><a href="<?= _WEB_ROOT_ ?>/admin/product" style="text-decoration: none; color: rgb(195, 21, 21);">Quản lý sản phẩm</a></h3>
         <h3 style="margin: 0;"><a href="<?= _WEB_ROOT_ ?>/admin/user" style="text-decoration: none; color: rgb(195, 21, 21);">Quản lý user</a></h3>
         <h3 style="margin: 0;"><a href="<?= _WEB_ROOT_ ?>/admin/order" style="text-decoration: none; color: rgb(195, 21, 21);">Quản lý đơn hàng</a></h3>
     </div>
 </header>


 <div class="containerad">
     <!-- <aside class="menu">
         <nav>
             <ul>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/dashboard">Dashboard</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/category">Quản lý danh mục</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/product">Quản lý sản phẩm</a></li>
                 <hr>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/user">Quản lý user</a></li>
                 <hr>
                 <li><a href="<?= _WEB_ROOT_ ?>/admin/order">Quản lý đơn hàng</a></li>
                 <hr>
             </ul>
         </nav>
     </aside> -->