<?php  

  $pageTitle = "Buyer Page";

  include 'init.php';
  usersOnly();
  include 'header.php';

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
        <h1 class="main_section_headline_sm"> Requests Archive </h1>
        <div class="mx-auto mt-1 section_box_parallel_sm"></div>
    </div>
        <div class="mt-5 main_profile_section">

          
                <h1 class="my-2 headline_agency_card span_darkblue"> Requests List</h1>

              
       
            

               <div class="ratings_div_main">

               <?php  
                 $table = "requests";
                 $requests = selectAll($table , [
                    'refere_id' =>   $_SESSION['id'] 
                 ] );

                 if (!empty($requests)) {
                    foreach($requests as $req) { ?>

                  
                   <div class="single_req_div">
       
                          <div class="d-flex-c">
       
                              <img src="<?= $imgAssets ?>/icons/video-conference.png" class="icon_big mr-3" alt="">
       
                              <div>
       
                              <div>
                                  <h1 class="label_form"> Name:  <?= $req['requester_name'] ?>   <img src="<?= $imgAssets ?>/icons/checkmark.png" alt="" class="icon_mid ">  </h1>

                                  <p class="label_form mt-1">Phone:  <?= $req['requester_phone'] ?> </p>
                              
                              </div>
                              
                              <div  >
       
           <h5 class="headline_info mt-1"> Agency : <span class="span_darkgreen"> <?= $req['estate_name'] ?> </span></h5>
           </div>
                          </div>
                          
                              </div>
                             
                              
                       
       
                          <div>
                           <input readonly type="text" style="min-height: 3rem;" readonly value="<?= $req['estate_name'] ?>" class="input_form mt-1">
                           
                           <input readonly type="text" style="min-height: 3rem;" readonly value="<?= $req['estate_location'] ?>" class="input_form mt-1">

                           <input readonly type="text" style="min-height: 3rem;" readonly value="<?= $req['estate_price'] ?>" class="input_form mt-1">
                          </div>
       
                          </div>
       
                      <?php  }
                 }
           
               ?>
              
               </div>

        </div>


    
</section>

</div>

      
        <!------------------CONTAINER TAMIZ ENDING------------------------>
<?php  


include 'footer.php';

?>