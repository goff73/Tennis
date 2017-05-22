<?php

session_start();

require('Model/database.php');
require('Model/UserDb.php');
require('Model/User.php');
require('Model/database_error.php');

//require('Model/database.php');
//require('Model/UserDb.php');
//require('Model/User.php');
////require('Model/database_error.php');
//require('Model/database_error.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'initiallogin';
    }
}
switch ($action) {
    case 'initiallogin':
        include 'View/login.php';
        break;
    case 'logout':
        $_SESSION['Profile']['UserName']="";
            $_SESSION['Profile']['FirstName']="";
            $_SESSION['Profile']['LastName']="";
            $_SESSION['Profile']['EMail']="";
            $_SESSION['Profile']['Admin']="";
            $_SESSION['Profile']['Phone']="";
        include('View/login.php');
        break;

    case 'login':
        $user_name = filter_input(INPUT_POST, 'user_name');
        $password = filter_input(INPUT_POST, 'password');
        if ($user_name === null || $user_name === "") {
            $errors = array();
            $errors[] = 'User Name is Required';
            $bValidate = False;
            include('View/login.php');
            break;
        }
        if ($password === null || $password === "") {
            $errors = array();
            $errors[] = 'Password is Required';
            $bValidate = False;
            include('View/login.php');
            break;
        }
        //if input validated

        $userObj = new User();
        if ($userObj->hash_check($user_name, $password)) {
            foreach (getProfileInformation($user_name) as $profile) :
            $_SESSION['Profile']['UserName']=$profile['UserName'];
            $_SESSION['Profile']['FirstName']=$profile['FirstName'];
            $_SESSION['Profile']['LastName']=$profile['LastName'];
            $_SESSION['Profile']['EMail']=$profile['EMail'];
            $_SESSION['Profile']['Admin']=$profile['Admin'];
            $_SESSION['Profile']['Phone']=$profile['Phone'];
            endforeach;
            include('View/profile.php');
            break;
        } else {
            $loginError="Incorrect username or password";
            include('View/login.php');
            break;
        }
    case 'profile':
        include('View/profile.php');
        break;
    case 'registration':
        include('View/registration.php');
        break;
    case 'confirmation':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $user_name = filter_input(INPUT_POST, 'user_name');
        $phone = filter_input(INPUT_POST, 'phone');
        $bValidate = true;
        if ($first_name === null) {
            $errors = array();
            $errors[] = 'First Name is Required';
            $bValidate = False;
            include('View/registration.php');
            break;
        }
        if ($last_name === null) {
            $errors = array();
            $errors[] = 'Last Name is Required';
            $bValidate = False;
            include('View/registration.php');
            break;
        }
        if ($email_address === null || filter_input(INPUT_POST, 'email_address') === "") {
            $errors = array();
            $errors[] = 'Email is Required';
            $bValidate = False;
            include('View/registration.php');
            break;
        } else if (!$email_address) {
            $errors[] = 'Email is in incorrect format';
            $bValidate = False;
        }
        if ($password === null || $password === "") {
            $errors = array();
            $errors[] = 'Password is Required';
            $bValidate = False;
            include('View/registration.php');
            break;
        }
        else{
            $bPregCheck = true;
            //this needs to be reviewed.  Where it says it needs a number for the password.
            if(!preg_match('/^[A-Z][A-Z]*$/',$password) || !preg_match('/^[a-z][a-z]*$/',$password) || !preg_match('/^[0-9]/',$password) || !preg_match('/[^\w]/',$password) || !preg_match('/^.{10,25}$/',$password)){
                $errors = array();
            }
            if(!preg_match('/[A-Z]/',$password))
            {
                
                $errors[] = 'The Password requires an uppercase letter';
                $bPregCheck = false;
                
            }
            if(!preg_match('/[a-z]/',$password))
            {
                $errors[] = 'The Password requires a lowercase letter';
                $bPregCheck = false;                
            }
            if(!preg_match('/[0-9]/',$password))
            {
                $errors[] = 'The password requires a number';
                $bPregCheck = false;                
            }
            if(!preg_match('/[^\w]/',$password))
            {
                $errors[] = 'The password requires a symbol';
                $bPregCheck = false;                
            }
            if(!preg_match('/^.{10,25}$/',$password))
            {
                $errors[] = 'The password length must be between 10-25 characters';
                $bPregCheck = false;                
            }                                                            
            
        }
        if ($user_name === null || $user_name === "") {
            $errors = array();
            $errors[] = 'User Name is Required';
            $bValidate = False;
            include('View/registration.php');
            break;
        }
        else{
            //logic to validate username
            if(!preg_match('/^[A-Za-z]/',$user_name)){
                $errors[] = 'The username has to start with a letter';
                $bPregCheck = false;   
            }
            if(!preg_match('/^.{4,20}$/',$user_name)){
                $errors[] = 'The username must be between 4-20 characters long';
                $bPregCheck = false; 
            }
        }
        
        if(!preg_match('/^[A-Za-z]/',$first_name)){
        $errors[] = 'Your first name has to start with a letter';
                $bPregCheck = false; 
        }
        if(!preg_match('/^[A-Za-z]/',$last_name)){
        $errors[] = 'Your last name has to start with a letter';
                $bPregCheck = false; 
        }
        
        
        if(!$bPregCheck)
            {
                $bValidate = False;
                include('View/registration.php');
                break;
            }
        if($bValidate && $bPregCheck){
            //this gets hit if it passes all validation
            $theUser = new User();
            $theUser->_construct($user_name, "",$password, $email_address, $first_name, $last_name, $phone);
            if (!$theUser->CheckUserName()) {
                if ($theUser->createUser()) {
                    include('View/confirmation.php');                    
                } else {
                    $message = 'error has occured adding user.';
                }
            } else {
                $message = 'User already exists.  Please pick another user';
                include('View/database_error_view.php');

            }
        }
        

}
?>
