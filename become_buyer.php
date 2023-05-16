<?php  

  $pageTitle = "Buyer Page";

  include 'init.php';
  usersOnly();
  include 'header.php';

  ?>


    <?php 
    
    if (isset($_POST['become_buyer'])) {
      
        $table = "users";

       
  
      
        $userId = $_SESSION['id'] ;
        
        $sql = "UPDATE $table SET user_group_id = ? WHERE id = ?";
  
        $dataUpdated = [
           2 , $userId
        ];
  
        $stat = exectureQuery($sql , $dataUpdated);    

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

    <?php  
          include 'navbar.php';
    ?>

    <!--------------END NAVBAR TAMIZ----------------->

  

    
    
    <!------------------CONTAINER TAMIZ STARTING------------------------>

    <div class="container_main">

<section class="section signup_section">

    <div class="text-center">
        <h1 class="main_section_headline_sm">  Buyer Page </h1>
        <div class="mx-auto mt-1 section_box_parallel_sm"></div>
    </div>
        <div class="mt-5 main_signup_section">

            <h1 class="my-2 headline_agency_card span_darkblue"> Start By Selecting Action
                </h1>

                <div class="grid_signup">
                    <div class="g-col-2">
                        <div class="div_info_form">
                           

                          
                            <div class="action_div_single w-100">
                                <form method="POST" >

                                <button type="submit" name="become_buyer" class="btn btn_monitor w-100 bg_darkgreen "> Become Buyer </button>

                                </form>
                               
                                </div>
                          

                            

                    


                            
                        </div>
                        <div class="div_image_form_request">
                            <img src="<?= $imgAssets ?>/svgs/undraw_working_remotely_re_6b3a.svg" alt="">
                        </div>
                    </div>
                </div>
    

        </div>


    
</section>

</div>
      
        <!------------------CONTAINER TAMIZ ENDING------------------------>
<?php  


include 'footer.php';

?>