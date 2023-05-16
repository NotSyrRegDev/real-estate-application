<?php  

  $pageTitle = "Estate Page";

  include 'init.php';
  include 'header.php';

  ?>

<?php 


    $estateId = 1;

    $singleAgency = selectOne("estate" , [
        "id" => $estateId
    ]);


  

      
    ?>

<?php  

    
if (isset($_POST['add_request'])) {

    $table = "requests";
    global $errors;

    $requestArray = [
        'requester_name' => $_SESSION['username'] ,
        'requester_phone' => $_SESSION['phone_number'] ,
        'refere_id' => $_SESSION['id'] ,
        'estate_name' => $singleAgency['name'],
        'estate_image' => $singleAgency['image'],
        'estate_desc' => $singleAgency['description'],
        'estate_location' => $singleAgency['location'],
        'estate_price' => $singleAgency['price'],
    ];


if (count($errors) == 0) {
    global $conn;
    unset($_POST['add_request']);

    
    $service_id = create($table, $requestArray);

header("location: " . BASE_URL . "/index.php"); 
exit();    

} 
}

?>





    <!--------------NAVBAR TAMIZ----------------->

    <?php  
          include 'navbar.php';
    ?>

    <!--------------END NAVBAR TAMIZ----------------->

  

    
    <!------------------CONTAINER TAMIZ STARTING------------------------>

    <div class="container_main">

<!-----------------DIV AGENCY---------------->

    <div class="section div_agency_flex">

    <div class="single_agency_card"  >
             

<div class="card_number_absoulte">
    <p> <?= $singleAgency['id'] ? $singleAgency['id'] : '' ?> </p>
</div>

<div class="stars_div_absolute d-flex-c">

                        <?php
                          for ($y = 0; $y < $singleAgency['stars']; $y++ ) { ?>
                            <img src="<?= $imgAssets  ?>/icons/star_solid.png" alt="" class="small_icon">
                                   <?php }
                                ?>


</div>

<div class="top_card_img">
    <img src="<?= $singleAgency['image'] ?  BASE_URL . "/assets/uploads/" . $singleAgency['image'] : $imgAssets . '/agencies/agency-1.jpg' ?>" alt="">
</div>

<div class="card_content_mid">
    <h1 class="headline_agency_card"> <?= $singleAgency['name'] ? $singleAgency['name'] : '' ?> </h1>
    <h4 class="para_agency_card"> <?= $singleAgency['description'] ? $singleAgency['description'] : '' ?> </h4>

    <div class="d-flex-c f-sp more_card_info mt-3">

        <div class="d-flex-c">
            <img class="small_icon mr-1" src="<?= $imgAssets ?>/icons/location.png" alt="">
            <p class="para_agency_card"> <?= $singleAgency['location'] ? $singleAgency['location'] : '' ?> </p>
        </div>

        <button class="btn btn_signup bg_sattle_blue"><?= $singleAgency['price'] ? $singleAgency['price'] : '' ?> SAR</button>

    </div>
</div>

</div>
                                
      
    </div>


    <?php  
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 0) { ?>
                            <div class="text-center">
                                <form action="" method="POST" >
                                <button type="submit" name="add_request" class="btn w-100 btn_monitor"> Request Now </button>
                                </form>
                               
                            </div>

                            <?php  } ?>
<!-----------------END DIV AGENCY---------------->




<!-----------------ABOUT MANAGER---------------->
<!-- <section class="about_agency section">
         
    <div class="d-flex-c f-sp about_manager">
        
        <h1 class="main_section_headline"> About Seller </h1>
        <img class="avatar_icon" src="<?= $imgAssets ?>/icons/agency_manager.png" alt="">
    </div>
<div class="section_box_parallel" ></div>

<div class="grid_agency_info mt-5">
    <div class="g-col-3">

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

        <div class="single_info_div_agency d-flex-c">
            <div class="box_info_circle"></div>
            <h1 class="headline_agency_info">Name : <span class="span_bold">Ammar ✅</span> </h1>
        </div>

    </div>
</div>


</section> -->

 <!-----------------END ABOUT AGENCY---------------->


 



</div>


<!------------------CONTAINER TAMIZ ENDING------------------------>

<?php  


include 'footer.php';

?>