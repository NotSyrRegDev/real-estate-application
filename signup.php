<?php  

  $pageTitle = "Signup Page";
  include 'init.php';

  include 'header.php';

  ?>

<?php  

    $table = "users";

if (isset($_POST['signup_user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $_POST['user_group_id'] = 0;
    
    singUpUser($_POST , $table);

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
                <h1 class="main_section_headline_sm text-left">Signup Here</h1>
               
            </div>
                <div class="mt-3 main_signup_section">

                    <h1 class="my-2 headline_agency_card">Have An Account ? 

                    <a href="login.php" class="click_pointer span_darkblue" >
                        Login Here
                    </a>   

                    </h1>

                    <div class="grid_signup">
                        <div class="g-col-2">

                        

          
                        <div class="div_info_form">

                        <?php  include  $includes . '/formErrors.php'  ?>

                                <form action="" method="POST" >

                                    <div class="action_div_single">
                                        <label for="" class="label_form">User Name</label>
                                        <input type="text" name="name" placeholder="Name..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form">User Email</label>
                                        <input type="email" name="email" placeholder="Email..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form">User Password</label>
                                        <input type="password" name="password" placeholder="Password..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form">User Number</label>
                                        <input type="number" name="phone" placeholder="Phone Number..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form"> User Age </label>
                                        <input type="number" name="age" placeholder="Age..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form"> Civil Registrey </label>
                                        <input type="number" name="civil_registry" placeholder="Civil Registry..."  class="input_form">
                                    </div>
                
                                    <div class="action_div_single">
                                        <label for="" class="label_form">  Birth Date </label>
                                        <input type="date" name="birth_date" placeholder="Birth Date..."  class="input_form">
                                    </div>
                


                                    <input type="hidden" name="refere" value="user" >
                
                                    <input type="submit" value="Submit" name="signup_user" class="mt-3 btn btn_form_send"  >
                
                                  </form>
                            </div>
                    

                            <div class="div_image_form_signup">
                                <img src="<?= $imgAssets ?>/icons/sign-up.png" alt="">
                            </div>
                        </div>
                    </div>
            

                </div>


            
        </section>

        </div>
    

      <!------------------CONTAINER TAMIZ ENDING------------------------>

    
</body>
</html>