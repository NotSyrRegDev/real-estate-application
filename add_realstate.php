<?php  

  $pageTitle = "Buyer Page";

  include 'init.php';
  usersOnly();
  include 'header.php';

  ?>


<?php  

    
if (isset($_POST['add_real_estate'])) {

    $table = "estate";
    global $errors;

    $checkArrays = [
        'name' => 'Estate Name' , 
        'price' => 'Estate Price' ,
        'location' => 'Estate Location' ,

        ];
// OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
$errors = validatePost($_POST , $checkArrays , $table , 'name'  );


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
    unset($_POST['add_real_estate']);

    
    $service_id = create($table, $_POST);

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

    
          <!-----------ADD INVOICE SECTION------------>

          <section class="section login_section">
                <div class="container-big">

                    <div class="main_form_action flex-col">

                        <div class="form_info_about">
                            <h1 class="main_headline">Get Started</h1>
                           
                            <h4 class="main_subheadline mt-1"> Add A Real Estate     </h4>
                                
                           
                           
                           

                              <?php  
        include $includes . '/formErrors.php';
           ?>

                <div class="mt-3"></div>

                <form action="" method="POST" enctype='multipart/form-data' >
                  
                <div class="action_form_div">
                        <label for="" class="label_form">Real Estate Image</label>
                         <input type="file" name="image" class="input_form"  >
                               
                  </div>
                  
                <div class="action_form_div mt-2">
                        <label for="" class="label_form">Real Estate Name</label>
                         <input type="text" name="name" class="input_form" placeholder="Real Estate Name..." >
                               
                  </div>

                <div class="action_form_div mt-2">
                        <label for="" class="label_form"> Real Estate Price </label>
                         <input type="number" name="price" class="input_form" placeholder="Real Estate Price..." >
                                
                  </div>

                <div class="action_form_div mt-2">
                        <label for="" class="label_form"> Real Estate Description </label>
                         <input type="text" name="description" class="input_form" placeholder="Real Estate Description..." style="height: 12rem;"  >
                               
                  </div>
                  
                <div class="action_form_div mt-2">
                        <label for="" class="label_form"> Real Estate Stars </label>
                        <select class="input_form" name="stars" >
                        <option value="5"> 5 </option>
                        <option value="4"> 4 </option>
                        <option value="3"> 3 </option>
                        <option value="2"> 2 </option>
                    <option value="1"> 1 </option>
                  
                    </select>
                                
                  </div>
                  
                <div class="action_form_div mt-2">
                        <label for="" class="label_form"> Real Estate Location </label>
                         <input type="text" name="location" class="input_form" placeholder="Real Estate Location..." >
                                
                  </div>



                  <div class="mt-3"></div>
                            <input type="submit" class="p-1 btn w-100 btn_form_send" name="add_real_estate" value="Submit"  >

                </form>
                        </div>

                      
                      

          
           

                      </div>
                </div>

            </section>

          <!-----------END ADD INVOICE SECTION------------>

</div>
      
        <!------------------CONTAINER TAMIZ ENDING------------------------>
<?php  


include 'footer.php';

?>