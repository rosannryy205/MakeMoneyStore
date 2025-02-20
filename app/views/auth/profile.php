 <div class="profile_content">
     <div class="avt_section">
         <img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $_SESSION['user']['image'] ?>" alt="" width="200px" height="200px">
     </div>
     <div class="group_info">
         <form action="">
             <label for=""><i class="fa-regular fa-user"></i> <input type="text" value="<?= $_SESSION['user']['name'] ?>"></label>
             <label for=""><i class="fa-regular fa-envelope"></i> <input type="text" value="<?= $_SESSION['user']['email'] ?>"></label>
             <label for=""><i class="fa-solid fa-key"></i> <input type="password" value="<?= $_SESSION['user']['password'] ?>"></label>
             <label for=""><i class="fa-solid fa-phone"></i> <input type="text" value="<?= $_SESSION['user']['phone'] ?>"></label>
             <label for=""><i class="fa-solid fa-location-dot"></i> <input type="text" value="<?= $_SESSION['user']['address'] ?>"></label>
         </form>
         <button style="color: white" onclick="location.href='<?= _WEB_ROOT_ ?>/chinh-sua-trang-ca-nhan'">Cập nhật</button>
         <button style="color: white" onclick="location.href='<?= _WEB_ROOT_ ?>/dang-xuat'">Đăng xuất</button>
     </div>
 </div>