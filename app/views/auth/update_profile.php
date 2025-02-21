 <div class="profile_content">
     <div class="avt_section">
         <img src="<?= _WEB_ROOT_ ?>/public/image_user/<?= $_SESSION['user']['image'] ?>" alt="" width="200px" height="200px">
         <form action="<?= _WEB_ROOT_ ?>/cap-nhat-trang-ca-nhan" method="post" enctype="multipart/form-data">
             <input type="file" name="image"><br>
             <button> Thay đổi hình ảnh</button>
         </form>
     </div>
     <div class="group_info">
         <form action="<?= _WEB_ROOT_ ?>/cap-nhat-trang-ca-nhan" method="post" autocomplete="off">
             <label for=""><i class="fa-regular fa-user"></i> <input name="name" type="text" value="<?= $_SESSION['user']['name'] ?>"></label>
             <label for=""><i class="fa-regular fa-envelope"></i> <input name="email" type="text" value="<?= $_SESSION['user']['email'] ?>"></label>
             <label for=""><i class="fa-solid fa-key"></i> <input name="password" type="password" autocomplete="current-password" placeholder="Nhập lại mật khẩu cũ"></label>
             <label for=""><i class="fa-solid fa-key"></i> <input name="password_new" type="password" autocomplete="new-password" placeholder="Nhập lại mật mới"></label>
             <label for=""><i class="fa-solid fa-phone"></i> <input name="phone" type="text" value="<?= $_SESSION['user']['phone'] ?>"></label>
             <label for=""><i class="fa-solid fa-location-dot"></i> <input name="address" type="text" value="<?= $_SESSION['user']['address'] ?>"></label>
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
             <div class="button_profile">
                 <button style="color: white">Thay đổi</button>
             </div>
         </form>
         <button style="color: white" onclick="location.href='<?= _WEB_ROOT_ ?>/trang-ca-nhan'">Quay trở về</button>
     </div>
 </div>