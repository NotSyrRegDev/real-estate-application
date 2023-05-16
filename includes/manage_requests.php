
    
    
    <?php  
    
    if (isset($_POST['delete_enduser'] )   ) {
       
        $tablename = "requests";

        $delete_id = $_POST['enduser_id'];
      
        $delete_table = deleteFromDb($tablename , $delete_id  , 'id');
       
    
        if ($delete_table) {
            header("Refresh: 0");

            exit(); 
        }
        
      }
    
    ?>

  



<div class="mt-10"></div>
<h1 class="headline_info my-3">Manage requests </h1>


<div class="table-content-table" style="overflow-x:auto;" >
  <table class="w-100">
    
  <tr class="table-thead-tr">
  
      <th>Requester Name </th> 
    <th> Requester Phone </th> 


    <th class="th-actions">Actions</th>
  </tr>
    
        <?php  
           $requests_all = selectAllWithPagination("requests");
           foreach($requests_all['results'][0] as $request ) { ?>
          <tr class="table-tbody-tr" style="margin-top : 1.5rem;" >
    
     <td>
     <?= $request['requester_name'] ? $request['requester_name'] : '' ?>
     </td>
     <td>
     <?= $request['requester_name'] ? $request['requester_name'] : '' ?>
     </td>
   
   
       <td>
       <div class="d-flex-c">
       <a href="edit_info.php?attempt_name=request&attempt_id=<?= $request['id'] ?>">
          <button type="button" class="btn  btn_signup mr-1">Edit</button>
          </a>

          <form method="POST" >
          <input type="hidden" name="enduser_id" value="<?= $request['id'] ?>" >
          <input type="submit" class="btn btn_signup bg_red " value="Delete" name="delete_enduser" >
        </form>
       </div>
       
      

       
       </td>
   
     </tr>
        <?php   }
        ?>

    

   
</table>
</div>

<div class="rating_btns">
                    <ul class="d-flex-c f-sv f-wrap">
                <?php  
                if ($_GET['page'] > 1 ) { ?>
   <li class="page-item <?php echo $_GET['page'] == 1 ? 'disabled' : '' ?>">
            
            <a class="click_pointer" href="admin.php?manage=endusers&page=<?php echo intval($_GET['page'])  -1  ?>" tabindex="-1">
                    <button style="width: 100%;" class="my-2 btn btn_signup bg_red" > Previous </button>
        </a>
        </li>
             <?php   }
                ?>
     
       
        
        
        
        <li class="page-item <?php echo $_GET['page'] >= $ratings['number_of_page'][0] ? 'disabled' : '' ?> ">
            <a class="click_pointer" href="admin.php?manage=consumers&page=<?php echo intval($_GET['page'])  + 1 ?>">
            <button style="width: 100%;" class="my-2 btn btn_signup" >Next</button>
        </a>
        </li>
        </ul>
               
            </div>
