
<?php  

$pageTitle = "Edit Info Page";
include 'init.php';

include 'header.php';

?>

<?php  
    
    $attemptId = isset($_GET['attempt_id']) && is_numeric($_GET['attempt_id']) ? intval($_GET['attempt_id']) : 0;

    $attemptName = isset($_GET['attempt_name'])  ? $_GET['attempt_name'] : '';

    if ($attemptId == 0 || $attemptName ==  ''  ) {
        header("location: " . BASE_URL . "/index.php"); 
        exit();    
    }

   
  
    ?>

    <?php  
    
    $tableAttempt = "";

    if ($attemptName === "enduser" ) { 
        $tableAttempt = 'users';
      }

    if ($attemptName === "estate" ) { 
        $tableAttempt = 'estate';
      }

    if ($attemptName === "request" ) { 
        $tableAttempt = 'requests';
      }


     
      $profile = selectOne($tableAttempt , array(
        'id' => $attemptId
          ));
       
        
     
    
        ?>

              
<?php  



if (isset($_POST['edit_profile']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    
  $checkArrays = [];

  $checkKey = '';

  if ($tableAttempt == "enduser") {
    $checkArrays = [
      'name' => 'User Name' , 
      'email' => 'User Email' ,
        'civil_registry' => 'User Civil Registry',
        'phone' => 'User Phone Number',

      ];

      $checkKey = 'email';
  }

  if ($tableAttempt == "estate") {
    $checkArrays = [
      'name' => 'Estate Name' , 
      'price' => 'Estate Price' ,
        'location' => 'Estate Location',

      ];

      $checkKey = 'name';
  }

  if ($tableAttempt == "requests") {
    $checkArrays = [
      'requester_name' => 'Requester Name' , 
      'requester_phone' => 'Requester Phone' ,

      ];

      $checkKey = 'requester_name';
  }

  
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
 $errors = validatePost($_POST , $checkArrays , $tableAttempt , $checkKey );




   if (!empty($_FILES['image']['name'])) {
    
    $uploadFile_type = $_FILES['image']['type'];
    $allowedTypes = array('image/gif','image/jpg','image/png' , 'image/jpeg');

    if (!in_array($uploadFile_type,$allowedTypes)) {
      array_push($errors , "File Type Is Not Allowed");
       }

    if( count($errors) == 0 ) {
      $image_name = time() . '_' . $_FILES['image']['name'];
   
      $destination = ROOT_PATH_MAIN . "/assets/uploads/" . $image_name;
       
      $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    }
     
    if ($result) {
   
       $_POST['image'] = $image_name;

       $sql = "UPDATE users SET image  = ? WHERE id = ?";

       $dataUpdated = [
        $_POST['image'] , $_SESSION['id']
       ];
   
       $stat = exectureQuery($sql , $dataUpdated);    
    } 
   
}  else {
    unset($_POST['image']);
}


 if (count($errors) == 0) {
  
    global $conn;

    $profileId = $_POST['stuff_id'];
    
   
    if ($profileId > 0) {
       
        unset($_POST['edit_profile']);

       
        if (empty($_POST['password'])) {
            unset($_POST['password']);
          }
          if (isset($_POST['stuff_id']) ) {
            unset($_POST['stuff_id']);
        }

      if (isset($_POST['password'])) {

        $_POST['password'] = sha1($_POST['password']);

      }
      $post_id = update($tableAttempt, $profileId , $_POST , 'id');

    
   
        // UPDATE ACTUAVL TABLE
       

     

        header("Refresh: 0");

        exit(); 
    } 
   
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

        <section class="section signup_section">

            <div class="text-center">
                <h1 class="main_section_headline_sm">Edit Info Page</h1>
                <div class="mx-auto mt-1 section_box_parallel_sm"></div>
            </div>
                <div class="mt-5 main_profile_section">

                    <div class="d-flex-c f-sp welcoming_profile">
                        <h1 class="my-2 headline_agency_card span_darkblue"> Edit <?= $attemptName ?> Info</h1>

                       
                    </div>
                    

                    <div class="grid_signup">
                            <div class="g-col-2">
                                <div class="div_info_form">
                                    
                                <?php  
                                       if ($tableAttempt == 'users') {
                                        include $includes . '/edit_enduser.php';
                                       }

                                       ?>

                                       <?php  
                                       if ($tableAttempt == 'estate') {
                                        include $includes . '/edit_estate.php';
                                       }
                                       ?>

                                       <?php  
                                       if ($tableAttempt == 'requests') {
                                        include $includes . '/edit_request.php';
                                       }
                                       ?>

                                </div>

                                <div class="div_image_form_request">
                                    <img src="<?= $imgAssets ?>/svgs/undraw_mobile_interface_re_1vv9.svg" alt="">
                                </div>
                            </div>
                        </div>
            

                </div>


            
        </section>

        </div>
    

      <!------------------CONTAINER TAMIZ ENDING------------------------>

        <!--------------FOOTER TAMIZ----------------->

        <?php  

include  'footer.php';

?>
      

        <!--------------END FOOTER TAMIZ----------------->