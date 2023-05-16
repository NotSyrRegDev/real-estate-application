<?php  

  $pageTitle = "Home Page";
  include 'init.php';

  include 'header.php';

  ?>


    <!--------------NAVBAR TAMIZ----------------->

        <?php  

        include 'navbar.php';


        ?>
  

    <!--------------END NAVBAR TAMIZ----------------->


    <!-------------- HEROAREA SECTION----------------->

    <div class="main_heroarea_section" style="  background:   linear-gradient( #010101aa , rgba(0, 0, 0, 0.685) ) , url('<?= $imgAssets ?>/heroarea/heroarea-2.jpg') center / cover;" >

<div class="flex_heroarea">
    <div class="flex_hero_con container-mid">

     
        <div class="info_heroarea">
            <h1 class="heroarea_headline"> Real Estate Portal System </h1>
            <div class="mt-2"></div>
            <p class="main_para">  The place where you can find your ideal property through trusted merchants through us  </p>
            <div class="mt-2"></div>
            <button class="btn btn_heroaction bg_darkgreen"> See Estates </button>
        </div>
        <div class="image_heroarea">
            <img src="<?= $imgAssets ?>/icons/logo.png" alt="">
        </div>

    </div>
</div>

</div>

    <!--------------END HEROAREA SECTION----------------->

        <!------------------CONTAINER TAMIZ STARTING------------------------>

        <div class="container_main">

<section class="agencies_search section">
         
<h1 class="main_section_headline"> Real Estates </h1>
<div class="section_box_parallel" ></div>



<!----------------AGENCY GRID------------------>

<div class="agencies_grid mt-5">
    <div class="g-col-3">

    
    <?php  
                 $table = "estate";
                 $real_estates = selectAll($table );

                 if (!empty($real_estates)) {

                   
                    foreach($real_estates as $estate) { ?>

                <!------------SINGLE AGENCY----------->
                
             
                <div class="single_agency_card"  >
                <a href="single_estate.php?estateId=<?= $estate['id'] ?>">

<div class="card_number_absoulte">
    <p> <?= $estate['id'] ? $estate['id'] : '' ?> </p>
</div>

<div class="stars_div_absolute d-flex-c">

                        <?php
                          for ($y = 0; $y < $estate['stars']; $y++ ) { ?>
                            <img src="<?= $imgAssets  ?>/icons/star_solid.png" alt="" class="small_icon">
                                   <?php }
                                ?>


</div>

<div class="top_card_img">
    <img src="<?= $estate['image'] ?  BASE_URL . "/assets/uploads/" . $estate['image'] : $imgAssets . '/agencies/agency-1.jpg' ?>" alt="">
</div>

<div class="card_content_mid">
    <h1 class="headline_agency_card"> <?= $estate['name'] ? $estate['name'] : '' ?> </h1>
    <h4 class="para_agency_card"> <?= $estate['description'] ? $estate['description'] : '' ?> </h4>

    <div class="d-flex-c f-sp more_card_info mt-3">

        <div class="d-flex-c">
            <img class="small_icon mr-1" src="<?= $imgAssets ?>/icons/location.png" alt="">
            <p class="para_agency_card"> <?= $estate['location'] ? $estate['location'] : '' ?> </p>
        </div>

        <button class="btn btn_signup bg_sattle_blue"><?= $estate['price'] ? $estate['price'] : '' ?> SAR</button>

    </div>
</div>
</a>
</div>
           
    

<!------------END SINGLE AGENCY----------->
       
                      <?php  }
                 }
           
               ?>

       
        
       

       

    </div>
</div>

<!----------------END AGENCY GRID------------------>

</section>

</div>


<!------------------CONTAINER TAMIZ ENDING------------------------>




    <!--------------FOOTER AREA----------------->

    <?php 
          include 'footer.php';
    ?>

     <!--------------END FOOTER AREA ---------------->


