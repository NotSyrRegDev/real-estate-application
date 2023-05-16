<?php  

  $pageTitle = "Edit Profile Page";
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

<?php  

 



if (isset($_POST['edit_profile']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    global $errors;
    $table = "users";
    
  $checkArrays = [];

 
    $checkArrays = [
      'name' => 'User Name' , 
      'email' => 'User Email' ,
        'civil_registry' => 'User Civil Registry',
        'phone' => 'User Phone Number',

      ];
 

  
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
 $errors = validatePost($_POST , $checkArrays , $table , 'email' );




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

  
    if ($userId > 0) {
    
        unset($_POST['edit_profile']);

       
      

      if (isset($_POST['password'])) {

        $arrayArgs = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' =>  sha1($_POST['password']),
        ];

        // UPDATING USERS TABLE
        $user_id = update("users", $userId , $arrayArgs , 'id');
       
   
       
      }

      if (empty($_POST['password'])) {
        unset($_POST['password']);
      }
   
    
        // UPDATE ACTUAVL TABLE
        $post_id = update($table, $userId , $_POST , 'id');

     

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
        <h1 class="main_section_headline_sm text-left">Edit Profile Page </h1>
      
    </div>
        <div class="mt-2 main_profile_section">

            <div class="d-flex-c f-sp welcoming_profile">
            <h1 class="my-2 headline_agency_card span_darkblue"> Welcome <?= $selectedUser['name'] ? $selectedUser['name']  : '' ?></h1>

        <a href="profile.php">
        <img src="<?= $imgAssets ?>/icons/left-arrow.png" alt="" class="small_icon">
        </a>
            </div>
            

                <div class="grid_signup">
                    <div class="g-col-2">
                        <div class="div_info_form">
                            <form action="" method="POST" enctype='multipart/form-data' >

                                <div class="action_div_single">
                                    <label for="" class="label_form">Image</label>
                                   <img src="<?= $imgAssets ?>/icons/user.png" class="avatar_icon" alt="">

                                   <input type="file" name="image" id="" class="input_form">
                                   
                                </div>
                                <div class="action_div_single">
                                    <label for="" class="label_form">Name</label>
                                    <input  type="text" name="name" placeholder="Name..."  class="input_form" value="<?= $selectedUser['name'] ? $selectedUser['name']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form">Email</label>
                                    <input  type="email" name="email" placeholder="Email..."  class="input_form" value="<?= $selectedUser['email'] ? $selectedUser['email']  : '' ?>" >
                                </div>
            
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Phone </label>
                                    <input  type="number" name="phone" placeholder="Phone..."  class="input_form" value="<?= $selectedUser['phone'] ? $selectedUser['phone']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Civil Registry </label>
                                    <input  type="number" name="civil_registry" placeholder="Civil Registry..."  class="input_form" value="<?= $selectedUser['civil_registry'] ? $selectedUser['civil_registry']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Age </label>
                                    <input  type="number" name="age" placeholder="Age..."  class="input_form" value="<?= $selectedUser['age'] ? $selectedUser['age']  : '' ?>" >
                                </div>
            
                                <div class="action_div_single">
                                    <label for="" class="label_form"> Birth Date </label>
                                    <input  type="text" name="birth_date" placeholder="Birth Date..."  class="input_form" value="<?= $selectedUser['birth_date'] ? $selectedUser['birth_date']  : '' ?>" >
                                </div>
            
                                <input type="submit" value="Submit" name="edit_profile" class="mt-3 btn btn_form_send"  >
            
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
<?php  


include 'footer.php';

?>