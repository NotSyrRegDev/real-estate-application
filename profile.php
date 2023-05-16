<?php  

  $pageTitle = "Profile Page";
  include 'init.php';

  include 'header.php';

  ?>

<?php  


$userId = $_SESSION['id'];

$userId = isset($userId) && is_numeric($userId) ? intval($userId) : 0;

if ($userId == 0  ) {
    header("location: " . BASE_URL . "/index.php"); 
    exit();    
}

$selectedUser = selectOne("users" , array(
    'id' => $userId
) );




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
        <h1 class="main_section_headline_sm text-left">Profile Page</h1>
      
    </div>
        <div class="mt-2 main_profile_section">

            <div class="d-flex-c f-sp welcoming_profile">
                <h1 class="my-2 headline_agency_card span_darkblue"> Welcome <?= $selectedUser['name'] ? $selectedUser['name']  : '' ?></h1>

                <a href="edit-profile.php">
                <img src="<?= $imgAssets ?>/icons/edit.png" alt="" class="small_icon">
                </a>
               
            </div>
            

                <div class="grid_signup">
                    <div class="g-col-2">
                        <div class="div_info_form">
                            <form action="" method="POST" >

                                <div class="action_div_single">
                                    <label for="" class="label_form">Image</label>
                                   <img src="<?= $imgAssets ?>/icons/user.png" class="avatar_icon" alt="">
                                   
                                </div>
                                <div class="action_div_single">
                                    <label for="" class="label_form">Name</label>
                                    <input readonly type="text" name="name" placeholder="Name..."  class="input_form" value="<?= $selectedUser['name'] ? $selectedUser['name']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form">Email</label>
                                    <input readonly type="email" name="email" placeholder="Email..."  class="input_form" value="<?= $selectedUser['email'] ? $selectedUser['email']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Phone </label>
                                    <input readonly type="number" name="phone" placeholder="Phone..."  class="input_form" value="<?= $selectedUser['phone'] ? $selectedUser['phone']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Civil Registry </label>
                                    <input readonly type="number" name="phone" placeholder="Civil Registry..."  class="input_form" value="<?= $selectedUser['civil_registry'] ? $selectedUser['civil_registry']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Age </label>
                                    <input readonly type="number" name="phone" placeholder="Age..."  class="input_form" value="<?= $selectedUser['age'] ? $selectedUser['age']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Birth Date </label>
                                    <input readonly type="text" name="phone" placeholder="Birth Date..."  class="input_form" value="<?= $selectedUser['birth_date'] ? $selectedUser['birth_date']  : '' ?>" >
                                </div>
            
                                <input type="submit" value="Submit" name="submit_form" class="mt-3 btn btn_form_send"  >
            
                              </form>
                        </div>

                        <div class="div_image_form_request">
                            <img src="<?= $imgAssets ?>/icons/profile.png" alt="">
                        </div>
                    </div>
                </div>
    

        </div>


    
</section>

</div>
      
        <!------------------CONTAINER TAMIZ ENDING------------------------>

    
</body>
</html>