<?php


function is_user_logged_in_web() {
    if (isset($_SESSION['id'])) {
        return true;
    }
    return false;
}


function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo "Default";
    }
}





function tabs_logic()
{
    include 'includes/templates' . '/tabs_logic.php';
}


function user_grap_values()
{
 
    $usersArray = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => sha1($_POST['password']),
        'refere' => $_POST['refere'],
        'refere_id' => 0,
        'user_group_id' => 0,
    ];

    
    if ($_POST['refere'] == 'user') {
       $usersArray['user_group_id'] = 2;
    }

    if ($_POST['refere'] == 'tycoon') {
        $usersArray['user_group_id'] = 3;
    }

    
    unset($_POST['submit_form']);

    return $usersArray;
}

function redirect($redirect = '/index.php') {
    header('location: ' . BASE_URL . $redirect );

    exit(0);
}




function facility_grap_values()
{
    $arrayArgs = [
        'agency_name' => $_POST['agency_name'],
        'commercial_register' => $_POST['commercial_register'],
        'number' => $_POST['number'],
        'city' => $_POST['city'],
        'street' => $_POST['street'],
        'owner_id' => 0,
      ];
      unset($_POST['agency_name']);
      unset($_POST['about']);
      unset($_POST['commercial_register']);
      unset($_POST['location_link']);
      unset($_POST['number']);
      unset($_POST['city']);
      unset($_POST['street']);
      
      unset($_POST['owner_refere']);
      unset($_POST['submit_form']);
      
      return $arrayArgs;
}
