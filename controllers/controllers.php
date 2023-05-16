<?php 

require_once 'connect.php';




function dd($value) {
    echo '<pre>'. print_r($value , true) . '</pre>' ;
    die();
      }
  //FUNCTION FOR EXECTUNG THE QUERY
function exectureQuery($sql , $data) {
    
global $conn;
 
$stat = $conn->prepare($sql);

// array of values user pass in query condition
$values = array_values($data);
$types = str_repeat('s' , count($values));

// I STANDS FOR INTEGER AND S FOR STRING
// PREVENT SQL HACKING



$stat->bind_param($types , ...$values );

$stat->execute();

return $stat;
}


// create and made CONNECTION TO DB
function CreateAndConnectDB($host , $user , $password , $dbname , $tablename, $condection = []) {

$conn = mysqli_connect($host , $user , $password);
// IF THERE IS NO CONENCTION
if (!$conn) {
    die("CONNECTION FAILED: " . mysqli_connect_error());
}  else {
    // IF CONNECTION SUCCESS CREATE THE DATABASE
    // SQL
   $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
   // CREATE NEW CONENCTION
   if (mysqli_query($conn, $sql)) {
       $conn = mysqli_connect($host , $user , $password , $dbname);
       if ($conn ) {
   // IF CONNECTION MADED THEN CREATE TABLE
   if (empty($condection)) {
       die("YOU SHOULD PROVIDE ARGUEMTN IN ORDER TO CREATE DATABASE TABLE");
   }
   $sql = "CREATE TABLE IF NOT EXISTS $tablename(";
   $i = 0;
   foreach($condection as $key => $value) {
  
      
  $valueCount = count($value);
  $d = 0;
  if ($valueCount === 0) {
      
    $myArray = "$value[0]";
    $sql = $sql . "$key $myArray";
  } else {
    
    if ($i !== 0) {
        $sql = $sql . ",$key";
    } else {
        $sql = $sql . "$key";
    }
     
      while($d < $valueCount) {
        $myArray = "$value[$d]";
        if (is_numeric($myArray)) {
         $myArray = "($myArray)";
        }
        $d++;
  
        $sql = $sql . " $myArray";
      }
    
  }
 
$i++;      
   }
   $sql = "$sql)";
   
  // $sql = "CREATE TABLE IF NOT EXISTS $tablename (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(25) NOT NULL, product_price FLOAT, product_image VARCHAR(100) )";
   if (!mysqli_query($conn , $sql)) {
    echo "ERROR CREATING TABLE: " .mysqli_error($conn);
   }
       
    } 
    // IF NO CONNECTION SUCCESS
    else {
        die("CONNECTION FAILED: " . mysqli_connect_error());
       }
   } else {
       return false;
   }

}
}

function create($table  ,$createData) {
  global $conn;
  // EXAMPLES
  // $SQL = INSERT INTO users (username , admin , email , password) VALUE (?,?,?)
  // we chhose this -> $SQL = INSERT INTO users SET username?,admin?,email?,password?
  $sql = "INSERT INTO $table SET ";

   // RETURN RESULT THAT MATCH SONDTIONS
   // LOPPING THROUGHT THE ARRAY OF CONDTION
   $i = 0;
   
   foreach($createData as $key => $value) {
     // ONLY IF INDEX 0 WE PREFORM THIS QUERY
     if ($i === 0) {
 // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
   $sql = $sql . " $key=?";
     } 
     else {
       $sql = $sql . ", $key=?";
     }
     $i++;
     
   }
 
  
  
   $stat = exectureQuery($sql , $createData);
 
   // GETTING ID OF THE INSERTED RECORD
   $id = $stat->insert_id;
   return $id;

  

}

function deleteFromDb($table , $id , $whereCol = 'id' ) {
  global $conn;
  // EXAMPLES
 
  // we chhose this -> $SQL = "DELETE FROM users WHERE id=?"
  $sql = "DELETE FROM $table WHERE $whereCol=?";


   $stat = exectureQuery($sql , [$whereCol => $id ]);
   // dd($stat);
   // RETURNING NUMBER OF THE AFFTECTED ROWS
   return $stat->affected_rows;

  

}

  
function selectAll($tablename , $condection = [] , $limitStatus = false , $limit = '1' , $orderStatus = false , $orderBy = 'id' , $orderWith = 'DESC' ) {
  global $conn;
 
  $sql = "SELECT * FROM $tablename";

  if (empty($condection)) {
   
    if ($orderStatus) {
  $sql = $sql . " ORDER BY $orderBy $orderWith";
    }
    if ($limitStatus) {
      $sql = $sql . " LIMIT $limit";
    }

   
    $stat = $conn->prepare($sql);
    $stat->execute();
    $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    // IF ARGUMENTS PROVIDED
    $i = 0;
    foreach($condection as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key=?";
    } else {
      $sql = $sql . " AND $key=?";
    }
      $i++;
    }
   ;
   if ($limitStatus) {
      $sql = $sql . " LIMIT $limit";
   }
   if ($orderStatus) {
    $sql = $sql . " ORDER BY $orderBy $orderWith";
      }
  
      // EXECTING QUERY
     $stat = exectureQuery($sql , $condection);
 $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
  }
}

// $selected = selectAll("posts" );
// dd($selected);

 function selectQueryTable($tablename , $condection = [] ) {
   global $conn;

   // MAIN SQL 
   $sql = "SELECT * FROM $tablename";
   if (empty($condection)) {
    $sql = "SELECT * FROM $tablename";
  } else {
    // LOOPING THROUGHT THE CONECTIONS
    
    $i = 0;
 
    
    foreach($condection as $key => $value) {
      
     if ($key === 'order' OR $key ==='orderBy' OR $key === 'limit' OR $key === 'WHERE'  OR $key === 'min'  OR $key === 'max' OR $key === 'selection' OR $key === 'null' OR $key === 'within'  OR $key === 'without' OR $key === 'whereaslike' OR $key === 'whereasnotlike' OR $key === 'between' ) {
       $typedArray = gettype($value);
      
        if ($key === 'null') {
         
          if ($value === 'false') {
            $value = "";
            $key = "IS NOT NULL";
          } else {
            $value = "";
            $key = "IS NULL";
          }
         
        }
         if ($key === 'between') {
           $key = "";
           $betweekd = 0;
           foreach($value as $betweenkey => $betweenval) {

            if ($betweekd === 0) {
            
             $sql = $sql . "WHERE $betweenkey BETWEEN ";
             $calcVal = implode(" AND " , $betweenval);
             $sql = $sql  . $calcVal;
              
      
            } else {
              $sql = $sql . " AND $betweenkey BETWEEN ";
              $calcVal = implode(" AND " , $betweenval);
              $sql = $sql  . $calcVal;
            }
            $betweekd++;
           }
           $value = "";
         }
        if ( $key === 'whereasnotlike') {
          $key = "";
          $withasliked = 0;
          
          foreach($value as $withaslikekey => $withaslikeval) {
            if ($withasliked === 0) {
              $sql = $sql . "WHERE ";
              $sql = $sql . $withaslikekey;
              $sql = $sql . " NOT LIKE ";
              $sql = $sql . $withaslikeval;
            } else {
              $sql = $sql . " AND ";
              $sql = $sql . "WHERE ";
              $sql = $sql . $withaslikekey;
              $sql = $sql . " NOT LIKE ";
              $sql = $sql . $withaslikeval;
            }
          
          
            $withasliked++;
          }
          $value = "";
        }

        if ($key === 'within' ) {
       $key = "";
      
       $withd = 0;
       $sql = $sql . "IN (";
       
       foreach($value as $withinkey => $withinval ) {
        $withinMatchVal = $withinval;
       
       
        if ($withinkey === array_key_last($value)) {
          
          $quote = "";
          $sql = $sql .  " $withinval$quote ";
      } else {
        $quote = ",";
        $sql = $sql .  " $withinval$quote ";
      }

      
        $withd++;
        $quote = "";
       }
       $sql = $sql . ")";
       $value = "";
        }

        if ($key === 'without' ) {
       $key = "";
      
       $withd = 0;
       $sql = $sql . "NOT IN (";
     
       
       foreach($value as $withinkey => $withinval ) {
        $withinMatchVal = $withinval;
       
       
        if ($withinkey === array_key_last($value)) {
          
          $quote = "";
          $sql = $sql .  " $withinval$quote ";
      } else {
        $quote = ",";
        $sql = $sql .  " $withinval$quote ";
      }

      
        $withd++;
        $quote = "";
       }
       $sql = $sql . ")";
       $value = "";
        }

        if ( $key === 'whereaslike') {
          $key = "";
          $withasliked = 0;
          
          foreach($value as $withaslikekey => $withaslikeval) {
            if ($withasliked === 0) {
              $sql = $sql . "WHERE ";
              $sql = $sql . $withaslikekey;
              $sql = $sql . " LIKE ";
              $sql = $sql . $withaslikeval;
            } else {
              $sql = $sql . " AND ";
              $sql = $sql . "WHERE ";
              $sql = $sql . $withaslikekey;
              $sql = $sql . " LIKE ";
              $sql = $sql . $withaslikeval;
            }
          
          
            $withasliked++;
          }
          $value = "";
          
        }
        
        
       if ($typedArray === 'string') {
       
      if ($key === 'orderBy')  {
        
        $value = "";
      }
       }
    
      if ($key === 'limit') {
        $key = strtoupper($key);
      }
   
    
     
      
      if ( $key === 'WHERE'  ) {
        $newVal = http_build_query($value );
      } else {
        $newVal = $value;
      }
     
     
      if ($key === 'order' ) {
        $key = "ORDER BY " . 'id' ;
      }
      if ($key === 'orderBy') {
      
        $key = "";

      }
      if ($key === 'min') {
        $key = "MIN";
        $d = 0;
        foreach($value as $x => $x_val) {
           
           
         $newVal = "($x) AS $x_val ";

         $sql = $sql . " $key$newVal";
        
          $d++;
        }
       
      }
      if ($key === 'max') {
        $key = "MAX";
        $d = 0;
        foreach($value as $x => $x_val) {
           
           
         $newVal = "($x) AS $x_val ";
         $sql = $sql . " $key$newVal";
          $d++;
        }
       
      }

     
     $sql = $sql . " $key $newVal";
     
      
        $i++;
     } else {
     
     die("SORRY WRONG ARGUEMNTS");
     }
      
       
  
    }
    dd($sql);
  }
   // HANDLEING CONECTIONS
 } 



function selectOne($table , $conditions) {
  global $conn;
  $sql = "SELECT * FROM $table";
 
  
    // RETURN RESULT THAT MATCH SONDTIONS
   // LOPPING THROUGHT THE ARRAY OF CONDTION
   $i = 0;
   foreach($conditions as $key => $value) {
     // ONLY IF INDEX 0 WE PREFORM THIS QUERY
     if ($i === 0) {
 // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
   $sql = $sql . " WHERE $key=?";
     } 
     else {
       $sql = $sql . " AND $key=?";
     }
     $i++;
     
   }
   // LINITING QUERY FOR ONLY 1 RESULT
   $sql = $sql . " LIMIT 1";
   
   // EXECTING QUERY
   $stat = exectureQuery($sql , $conditions);
   // FETCHING ONE
   $records = $stat->get_result()->fetch_assoc();
   return $records;
  
  
}

function usersOnly($redirect = '/index.php') {
    
  if (empty($_SESSION['id'])) {
      $_SESSION['message'] = "You Need To Login First";
      $_SESSION['type'] = 'error';
      header('location: ' . $BASE_URL . $redirect );

      exit(0);
  }
}


function update($table , $id , $updateData , $whereCol = 'user_id') {
  global $conn;
  // EXAMPLES
 
  // we chhose this -> $SQL = UPDATE users SET username?,admin?,email?,password? WHERE id=?
  $sql = "UPDATE $table SET ";

   // RETURN RESULT THAT MATCH SONDTIONS
   // LOPPING THROUGHT THE ARRAY OF CONDTION
   $i = 0;
   foreach($updateData as $key => $value) {
     // ONLY IF INDEX 0 WE PREFORM THIS QUERY
     if ($i === 0) {
 // HERE WE SAY SELLECT * FROM $tabel WHERE KEY IN CASE ADMIN = VALUE IN CASE 1
   $sql = $sql . " $key=?";
     } 
     else {
      $sql = $sql . ", $key=?";
     }
     $i++;
     
   }

   $sql = $sql . " WHERE $whereCol=?";

   $updateData['id'] = $id;

   $stat = exectureQuery($sql , $updateData);
   // dd($stat);
   
   return $stat->affected_rows;

  

}


 
function validatePost($post , $checkedConds = [] , $tablename , $checkFor ) {
  $errors = array();
  $i = 0;
  foreach($checkedConds as $key => $value) {
     if (empty($post[$key])) {
       array_push($errors , "Field $value Required");
     }
  }


  // // IF THERE IS NO ERRORS

  // CHECHK IF EMAIL ALREADY EXIST
  //selectOne($tablename , [$checkFor => $post[$checkFor] ])
  $existingPost = selectOne($tablename, [$checkFor => $post[$checkFor]]);
  if ($existingPost) {

    // CHECKING IS USER TRYING TO UPDATE OR CREATE NEW POST
    // CHECING ALSO IF THE POST IN THE DATABASE IS NOT THE POST TRYING TO UPDATE
    if ( isset($post['update-post']) &&  $existingPost['id'] != $post['id'] ) {
      array_push($errors , 'Post with that title is already exist');
    }

    if (isset($post['add-post'])) {
      array_push($errors , 'Post with that title is already exist');
    }
  
  }

  return $errors;
} 

function validateUser($user) {
  $errors = array();

  if (empty($user['username'])) {
      array_push($errors, 'Username is required');
  }

  if (empty($user['email'])) {
      array_push($errors, 'Email is required');
  }

  if (empty($user['password'])) {
      array_push($errors, 'Password is required');
  }

  if ($user['passwordConf'] !== $user['password']) {
      array_push($errors, 'Password do not match');
  }

  // $existingUser = selectOne('users', ['email' => $user['email']]);
  // if ($existingUser) {
  //     array_push($errors, 'Email already exists');
  // }

  $existingUser = selectOne('users', ['email' => $user['email']]);
  if ($existingUser) {
      if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
          array_push($errors, 'Email already exists');
      }

      if (isset($user['create-admin'])) {
          array_push($errors, 'Email already exists');
      }
  }

  return $errors;
}

 // FUNCTION FOR VALIDATING USER LOGIN
function validateLogin($user) {
  $errors = array();

  if (empty($user['username'])) {
      array_push($errors, 'Username is required');
  }

  if (empty($user['password'])) {
      array_push($errors, 'Password is required');
  }

  return $errors;
}

function checkPasswordForUser($confirmVal , $passCol , $tablename , $whereCol ) {
  $email = $_SESSION['userLoggedIn'];
  $pws = $_POST["$confirmVal"];
  $query = mysqli_query($connection , "SELECT $passCol FROM $tablename WHERE $whereCol = '$email'");
  $record = mysqli_fetch_array($query);
  $hashPwd = md5($pws);
  $pwdFromDb = $record["$passCol"];

  if ($pwdFromDb == $hashPwd) {
  return true;
} else {
  return false;
}

}


function loginUser($user)
{
 

  $_SESSION['id'] = $user['id'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['username'] = $user['name'];
  $_SESSION['phone_number'] = $user['phone'];
  $_SESSION['user_pic'] = $user['image'];

 
 
  $_SESSION['admin'] = $user['user_group_id'];
  $_SESSION['message'] = 'You are now logged in';
  $_SESSION['type'] = 'success';

  if ($_SESSION['admin'] === 1) {
      header('location: ' . BASE_URL . '/admin.php'); 
  } else {
      header('location: ' . BASE_URL . '/index.php');
  }
  exit();
}

function signInUser($user , $checkedConds , $tablename , $checkFor) {
unset($_POST['login_user']);
global $errors;
$errors = validatePost($user , $checkedConds , $tablename , $checkFor );


if (count($errors) == 0) {
  $selectdUser = selectOne($tablename , [$checkFor => $user[$checkFor] ] );
 
  if ($selectdUser === null) {
  
    array_push($errors , "No Such Email");
  
  }


  if ($selectdUser && sha1($user['password']) == $selectdUser['password']  ) {

    loginUser($selectdUser);
  } else {
   
    array_push($errors , "Wrong Credentials");
   
  }
}
}

function logoutUser($destroySessions , $redirect = 'index.php') {

foreach($destroySessions as $key => $value) {
  unset($_SESSION[$value]);
}

session_destroy();
header('location: ' . BASE_URL . "/$redirect");
 
}

function singUpUser($signupUser , $table) {
unset($_POST['signup_user']);
global $errors;

$checkArrays = [
    'name' => 'User Name' , 
    'email' => 'User Email' ,
      'password' => 'User Password'
    ];
     // OBJECT , WHAT TO CHECK IF EMPTY , TABLE NAME , CHEKC IF ALREADY EXIST
$errors = validatePost($signupUser , $checkArrays , $table , 'email');

if (count($errors) == 0) {
$_POST['user_group_id'] = 0;
$_POST['password'] = sha1($_POST['password']);

$user_id = create($table , $_POST);
$user = selectOne($table, ['id' => $user_id]);
loginUser($user);
}
}




  function adminOnly($redirect = 'home.php') {



    $checkUserId = $_SESSION['id'];
 
     $condections = array(
       'user_group_id' => 1,
       'user_email' => $_SESSION['email']
     );
    $checkAdmin = checkThingInDb('joinedusers' , 'id' , $condections);
  
    if (!$checkAdmin) {
        $_SESSION['message'] = "You Are Not Authorized To Preform This Action";
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect );

        exit(0);
    }
  }

  function guestsOnly($redirect = 'home.php') {

    if (isset($_SESSION['id']) ) {

        header('location: ' . BASE_URL . $redirect );

        exit(0);
    }
  }

  function selectAllWithPagination($tablename , $condection = [] , $results_per_page = '15'  ) {
    global $conn;
     $returnedArray = array(
       'number_of_page' => array(),
       'results' => array(),
     );
      $sql = "SELECT * FROM $tablename";
    
    
        
        $result = mysqli_query($conn , $sql);
        $number_of_results = mysqli_num_rows($result);
        // TOTAL NUMBER OF PAGES AVALIABLE
        $number_of_page = ceil($number_of_results / $results_per_page );
        array_push($returnedArray['number_of_page'] , $number_of_page  );
        if (!isset($_GET['page'])) {
          $page = 1;
        } else {
          $page = $_GET['page'];  
        }
        
        // THE LIMIT
        $page_first_result = ($page - 1) * $results_per_page;
        if (empty($condection)) {
  
      $sql2 =  "SELECT * FROM $tablename LIMIT " . $page_first_result . ',' . $results_per_page;
     
      $stat = $conn->prepare($sql2);
      $stat->execute();
      $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
      array_push($returnedArray['results'] , $records  );
     // return $records;
     return $returnedArray;
       
      } else {
        // IF ARGUMENTS PROVIDED
        $sql2 =  "SELECT * FROM $tablename ";
        $i = 0;
        foreach($condection as $key => $value) {
        if ($i === 0) {
          $sql2 = $sql2 . " WHERE $key=?";
        } else {
          $sql2 = $sql2 . " AND $key=?";
        }
          $i++;
        };
        $sql2 = $sql2 . " LIMIT " . $page_first_result . ',' . $results_per_page;
       
       // $stat = $conn->prepare($sql2);
        $stat = exectureQuery($sql2 , $condection);
       
        $records = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
        
         array_push($returnedArray['results'] , $records  );
       return $returnedArray;
       
  
       
      }
     
  
        
  
  }
  
  

?>