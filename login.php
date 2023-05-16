<?php  

  $pageTitle = "Login Page";
  include 'init.php';
  guestsOnly();
  include 'header.php';

  ?>

<?php  


 
if (isset($_POST['login_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $checkConds = array(
      'email' => 'User Email',
      'password' => 'User Password'
    );
  signInUser($_POST , $checkConds , 'users' , 'email');
}

?>


    <!--------------NAVBAR TAMIZ----------------->

    <?php  
          include 'navbar.php';
    ?>

    <!--------------END NAVBAR TAMIZ----------------->

  

    
    
    <!------------------CONTAINER TAMIZ STARTING------------------------>

    
    <div class="container_main">

<section class="section signup_section">

    <div class="text-center">
        <h1 class="main_section_headline_sm text-left">Login Here</h1>
       
    </div>
        <div class="mt-2 main_signup_section">

            <h1 class="my-2 headline_agency_card">Don't Have An Account ? 
                
                <a href="signup.html" class="click_pointer span_darkblue" >
                    Signup Here
                </a>   

                </h1>

                <div class="grid_signup">
                    <div class="g-col-2">
                        <div class="div_info_form">
                            <form action="" method="POST" >

            
                                <div class="action_div_single">
                                    <label for="" class="label_form">Email</label>
                                    <input type="email" name="email" placeholder="Email..."  class="input_form">
                                </div>

                                
                                <div class="action_div_single">
                                    <label for="" class="label_form">Password</label>
                                    <input type="password" name="password" placeholder="Password..."  class="input_form">
                                </div>
            
                                <input type="submit" value="Submit" name="login_user" class="mt-3 btn btn_form_send"  >
            
                             </form>
                        </div>
                        <div class="div_image_form_login">
                            <img src="<?= $imgAssets ?>/icons/login.png" alt="">
                        </div>
                    </div>
                </div>
    

        </div>


    
</section>

</div>

      
        <!------------------CONTAINER TAMIZ ENDING------------------------>

    
</body>
</html>