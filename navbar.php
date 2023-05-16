 
    
     <?php  


if (isset($_POST['logout_user'])) {
  $sessionDestory = array(
  'id' => 'id',
  'name' => 'username',
  'admin' => 'admin',
  'message' => 'message',
  'type' => 'type',
  );
  logoutUser($sessionDestory );
}
?>


 
 <!--------------NAVBAR TAMIZ----------------->

 <nav class="nav_tamiz_main">

 <a href="index.php">
 <div class="nav_logo_div d-flex-c">
    <img src="<?= $imgAssets ?>/icons/logo.png" alt="">
    <h4> Real Estate Portal </h4>

</div>
 </a>


<div class="nav_logo_action">
    <ul class="ul_nav_list">

        <li>
            <a class="active" href="index.php" >
            Real Estates
            </a>
        </li>


        <?php  
              if (is_user_logged_in_web()) { ?>
                      <li>
                        <a href="profile.php">
                        <img src="<?= $imgAssets  . '/icons/user.png' ?>" style="max-height : 2.5rem;" alt="">
                        </a>

                <?php  
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 2) { ?>
                      <li>
                        <a href="seller_page.php">
                        <img src="<?= $imgAssets  . '/icons/businessman.png' ?>" style="max-height : 2.5rem;" alt="">
                        </a>
                  <?php  }
                    else if (isset($_SESSION['admin']) && $_SESSION['admin'] === 0) {  ?>

        <li>
            <a href="become_buyer.php"> Become Buyer </a>
        </li>

             <?php       }
                ?>

        
        </li>
        <form method="post" >
            <button type="submit" name="logout_user" class="btn btn_signup bg_red">Logout</button>
        </a>
              </form>
              <?php  }
              
              else { ?>

        <a href="signup.php">
            <button class="btn btn_signup">Signup</button>
        </a>

        <a href="login.php">
            <button class="btn btn_signup bg_darkgreen">Login</button>
        </a>
          <?php    }
              ?>

<?php  
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1  ) { ?>
   <li>
            <a href="admin.php?manage=endusers&page=1"> Admin </a>
        </li>
                   <?php } ?>

      

    </ul>
</div>


<div class="menu_mobile">
    <img src="<?= $imgAssets ?>/icons/menu.png" alt="" class="icon_small menu_layout">
</div>


</nav>




<div class="slide_menu_mobile">

<img src="<?= $imgAssets ?>/icons/close.png" alt="" class="icon_small closing_icon">

<div class="flex-col">

<ul class="slide_ul">

                        
        <li>
            <a class="active" href="index.php" >
            Real Estates
            </a>
        </li>


        <?php  
              if (is_user_logged_in_web()) { ?>
                      <li>
                        <a href="profile.php">
                        <img src="<?= $imgAssets  . '/icons/user.png' ?>" style="max-height : 2.5rem;" alt="">
                        </a>

                <?php  
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 2) { ?>
                      <li>
                        <a href="seller_page.php">
                        <img src="<?= $imgAssets  . '/icons/businessman.png' ?>" style="max-height : 2.5rem;" alt="">
                        </a>
                  <?php  }
                    else if (isset($_SESSION['admin']) && $_SESSION['admin'] === 0) {  ?>

        <li>
            <a href="become_buyer.php"> Become Buyer </a>
        </li>

             <?php       }
                ?>

        
        </li>
        <form method="post" >
            <button type="submit" name="logout_user" class="btn btn_signup bg_red">Logout</button>
        </a>
              </form>
              <?php  }
              
              else { ?>

        <a href="signup.php">
            <button class="btn btn_signup">Signup</button>
        </a>

        <a href="login.php">
            <button class="btn btn_signup bg_darkgreen">Login</button>
        </a>
          <?php    }
              ?>

<?php  
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1  ) { ?>
   <li>
            <a href="admin.php?manage=endusers&page=1"> Admin </a>
        </li>
                   <?php } ?>


</ul>

</div>

</div>

<!--------------END NAVBAR TAMIZ----------------->



<script>

let mobileSlideDiv = document.querySelector('.slide_menu_mobile');

let closeIcon = document.querySelector('.closing_icon');

let menuIcon = document.querySelector('.menu_layout');

menuIcon.addEventListener('click' , () => {
  mobileSlideDiv.classList.toggle('active');
});

closeIcon.addEventListener('click' , () => {
  mobileSlideDiv.classList.toggle('active');
});

</script>
