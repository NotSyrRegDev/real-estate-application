<?php  

  $pageTitle = "Home Page";
  include 'init.php';


  include 'header.php';

  ?>

  

<?php  
    
    // if ( $_SESSION['admin'] != 1  ) {
    //     header("location: " . BASE_URL . "/index.php"); 
    //     exit();    
    // }

    ?>

<?php  

$adminManage = $_GET['manage'] ? $_GET['manage'] : '';

if(isset($_GET['page'])) {

    if (!(intval($_GET['page']))) {
        header("location: " . BASE_URL . "/index.php"); 
        exit();  
    }
  }
  
  if (!isset($_GET['page']) || !isset($_GET['manage']) || $adminManage == '' || $_GET['page'] == 0  ) {
    header("location: " . BASE_URL . "/index.php"); 
    exit();  
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
        <h1 class="main_section_headline_sm"> Admin Page </h1>
        <div class="mx-auto mt-1 section_box_parallel_sm"></div>
    </div>
        <div class="mt-5 main_profile_section">

          
                <h1 class="my-2 headline_agency_card span_darkblue"> Manage Real Estate Portal  </h1>



               <div class="ratings_div_main my-3">

             <div class="grid_admin">

                <a href="admin.php?manage=endusers&page=<?= $_GET['page'] ?>" class="click_pointer" >
                <div class="single_manage_admin">
                    <img src="<?= $imgAssets ?>/icons/endusers-admin.png" class="avatar_icon" alt="">
                    <h1 class="headline_info"> Users </h1>
                </div>
                </a>
              
                <a href="admin.php?manage=estates&page=<?= $_GET['page'] ?>" class="click_pointer" >
                <div class="single_manage_admin">
                    <img src="<?= $imgAssets ?>/icons/agencies-admin.png" class="avatar_icon" alt="">
                    <h1 class="headline_info"> Estates </h1>
                </div>
                </a>

             

              

                <a href="admin.php?manage=requests&page=<?= $_GET['page'] ?>" class="click_pointer" >
                <div class="single_manage_admin">
                    <img src="<?= $imgAssets ?>/icons/requests-admin.png" class="avatar_icon" alt="">
                    <h1 class="headline_info"> Requests </h1>
                </div>
                </a>


             </div>

             <?php 

             $manage = $_GET['manage'];

             switch ( $manage ) {

                case 'endusers':
                    include $includes . '/manage_endusers.php';
                    break;

                case 'estates':
                    include $includes . '/manage_estates.php';
                    break;

                case 'requests':
                    include $includes . '/manage_requests.php';
                    break;





                default:
                    include $includes . '/manage_endusers.php';
                    break;
             }

             ?>
              
               </div>

        </div>


    
</section>

</div>


<!------------------CONTAINER TAMIZ ENDING------------------------>




    <!--------------FOOTER AREA----------------->

    <?php 
          include 'footer.php';
    ?>

     <!--------------END FOOTER AREA ---------------->


