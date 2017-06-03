<?php


session_start();

require('Model/database.php');
require('Model/User.php');
require('Model/UserDb.php');
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
    //first page when you login
    case 'initiallogin':
        include 'View/login.php';
        break;
    //clear the session variables when logging out
    case 'logout':
        $_SESSION['Profile']['UserName']="";
            $_SESSION['Profile']['FirstName']="";
            $_SESSION['Profile']['LastName']="";
            $_SESSION['Profile']['EMail']="";
            $_SESSION['Profile']['Admin']="";
            $_SESSION['Profile']['Phone']="";
            $_SESSION['Profile']['PlayerId']="";
        include('View/login.php');
        break;
    //edit profile view
    case 'initialedit':
        include 'View/changeinfo.php';
        break;
    //view match disputes lists from players
    case 'viewdisputes':
        $theUser = new User();
        $disputeInfo=array();
        $disputeInfo=$theUser->getAllMatchDisputes();
        include 'View/viewdisputes.php';
        break;
    //fill match change from match dispute
    case 'changematch':
        $matchid = filter_input(INPUT_POST, 'matchid');
        $theUser = new User();
        $matchInfo=array();
        $matchInfo=$theUser->getTheMatch($matchid);
        $dateplayed=$matchInfo['MatchDate'];
        $player1=$matchInfo['player1'];
        $player2=$matchInfo['player2'];
        $winnerset1=$matchInfo['WinnerSet1'];
        $winnerset2=$matchInfo['WinnerSet2'];
        $winnerset3=$matchInfo['WinnerSet3'];
        $loserset1=$matchInfo['LoserSet1'];
        $loserset2=$matchInfo['LoserSet2'];
        $loserset3=$matchInfo['LoserSet3'];
        $player1id=$matchInfo['player1id'];
        $player2id=$matchInfo['player2id'];
        include 'View/matchchange.php';
        break;
    //allow player to dispute a match, stay in profile dashboard
    case 'dispute':
        $matchid = filter_input(INPUT_POST, 'matchid');
        $opponent= filter_input(INPUT_POST, 'opponent');
        $player= filter_input(INPUT_POST, 'player');
        $date=filter_input(INPUT_POST, 'date');
        $message='Review match on '.$date.' between '.$player.' and '.$opponent;
        if(isset($matchid)&&isset($date)&&isset($opponent)&&isset($player)){
            $disputeMessage=$player.". Your match between ".$opponent." on ".$date." has been sent to the league director Justin.  Expect a response within one week.  We will contact ".$opponent.".";
            $theUser = new User();
            $theUser->writeDispute($matchid, $date, $message);
                        $theUser = new User();
            $leaderboardInfo=array();
            $leaderboardInfo=$theUser->getLeaderboardInfo();
            $scheduleInfo=array();
            $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
            include('View/profile.php');
            break;
        }
        else{
            $disputeMessage="We had an issue sending your request.  Please e-mail Justin at justin@gmail.com";
                        $theUser = new User();
            $leaderboardInfo=array();
            $leaderboardInfo=$theUser->getLeaderboardInfo();
            $scheduleInfo=array();
            $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
            include('View/profile.php');
            break;
        }
    //fix match.  admin only.
    case 'finishdispute':
        $matchid = filter_input(INPUT_POST, 'matchid');
        $matchdate = filter_input(INPUT_POST, 'matchdate');
        $winningplayer=filter_input(INPUT_POST, 'winningplayer');
        $losingplayer=filter_input(INPUT_POST, 'losingplayer');
        $winnerset1=filter_input(INPUT_POST, 'winnerset1');
        $winnerset2=filter_input(INPUT_POST, 'winnerset2');
        $winnerset3=filter_input(INPUT_POST, 'winnerset3');
        $loserset1=filter_input(INPUT_POST, 'loserset1');
        $loserset2=filter_input(INPUT_POST, 'loserset2');
        $loserset3=filter_input(INPUT_POST, 'loserset3');
        if($winningplayer!==$losingplayer)
        {
            if(strlen($matchid)!==0&&strlen($matchdate)!==0&&strlen($winningplayer)!==0&&strlen($losingplayer)!==0&&(strlen($winnerset1)!==0
                    &&strlen($winnerset2)!==0&&strlen($winnerset3)!==0&&strlen($loserset1)!==0&&strlen($loserset2)!==0&&strlen($loserset3)!==0||strlen($winnerset1)!==0
                    &&strlen($winnerset2)!==0)&&($matchdate!=='mm/dd/yyyy')){
                if(($winnerset1>5 and $winnerset2 >5) or ($winnerset2>5 and $winnerset3 >5) or ($winnerset1>5 and $winnerset3 >5)){
                $theUser=new User();
                $theUser->writeMatch($matchid, $matchdate, $winningplayer, $losingplayer, $winnerset1, $winnerset2, $winnerset3, $loserset1, $loserset2, $loserset3);
                $theUser->deleteTheDispute($matchid);
                $disputeInfo=array();
                $disputeInfo=$theUser->getAllMatchDisputes();
                include 'View/viewdisputes.php';
                break;
            }
                else{
                    $player1=getMatchPlayers($matchid)['Player1'];
                    $player1id=getMatchPlayers($matchid)['Player1Id'];
                    $player2=getMatchPlayers($matchid)['Player2'];
                    $player2id=getMatchPlayers($matchid)['Player2Id'];
                    $dateplayed=$matchdate;
                    $errormatch='No one won the match.  Best 2 out of 3 sets.  Winner of each set must get to 6 games, else if it is 5-5, you must win by 2.';
                include ('View/matchchange.php');
                break;
                }
            }
            else{
                $player1=getMatchPlayers($matchid)['Player1'];
                $player1id=getMatchPlayers($matchid)['Player1Id'];
                $player2=getMatchPlayers($matchid)['Player2'];
                $player2id=getMatchPlayers($matchid)['Player2Id'];
                $dateplayed=$matchdate;
                $errormatch="Please make sure you entered all necessary data.  Make sure to add a date.";
                include ('View/matchchange.php');
                break;
            }
        }
        else{
                $player1=getMatchPlayers($matchid)['Player1'];
                $player1id=getMatchPlayers($matchid)['Player1Id'];
                $player2=getMatchPlayers($matchid)['Player2'];
                $player2id=getMatchPlayers($matchid)['Player2Id'];
                $dateplayed=$matchdate;
                $errormatch="One player can't be a winner and a loser.";
                include ('View/matchchange.php');
                break;
            }
    //edit the profile info.  Used Quentin's Regular expression/topologies code!  Do not include this in grade.
    case 'edit':
            //grabbing values from page
            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');
            $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone');
            $password = filter_input(INPUT_POST, 'password');
            $bValidate = true;
            if(!preg_match('/^[A-Za-z]/',$first_name) || !preg_match('/^[A-Za-z]/',$last_name) || $first_name === null || $last_name === null || ($email_address === null || filter_input(INPUT_POST, 'email_address') === "") || strlen($password) === 0 || (!preg_match('/^[A-Z][A-Z]*$/',$password) || !preg_match('/^[a-z][a-z]*$/',$password) || !preg_match('/^[0-9]/',$password) || !preg_match('/[^\w]/',$password) || !preg_match('/^.{10,25}$/',$password))){
                $errors = array();
            }
            //validate values
            $bPregCheck = true;
            if (strlen($first_name) === 0) {
            $errors[] = 'First Name is Required';
            $bValidate = False;
            $bPregCheck = False;
        }
        if (strlen($last_name) === 0) {
            $errors[] = 'Last Name is Required';
            $bValidate = False;
            $bPregCheck = False;
        }
        if (strlen($password) === 0) {
            $errors[] = 'Password is required';
            $bValidate = False;
            $bPregCheck = False;
        }
        else{
            $bPregCheck = true;
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
            //TOPOLOGIES SECTION
            if(preg_match('/^[A-Z][a-z]{5}[0-9]{4}[\W]{1}$/',$password))
            {
                $errors[] = 'Your password is not complex enough. It matched format (Sssss1111!) which is a common password';
                $bPregCheck = false;                
            }
            if(preg_match('/^[A-Z][a-z]{7}[0-9]{2}[\W]{1}$/',$password))
            {
                $errors[] = 'Your password is not complex enough. It matched format (Ssssssss11!) which is a common password';
                $bPregCheck = false;                
            }
            if(preg_match('/^[A-Z][a-z]{6}[0-9]{4}[\W]{1}$/',$password))
            {
                $errors[] = 'Your password is not complex enough. It matched format (Sssssss1111!) which is a common password';
                $bPregCheck = false;                
            }
            if(preg_match('/^[\W][A-Z]{1}[a-z]{5}[0-9]{4}[\W]{1}$/',$password))
            {
                $errors[] = 'Your password is not complex enough. It matched format (!Ssssss1111) which is a common password';
                $bPregCheck = false;                
            }
            if(preg_match('/^[0-9][A-Z]{1}[a-z]{5}[0-9]{4}[\W]{1}$/',$password))
            {
                 $errors[] = 'Your password is not complex enough. It matched format (1Ssssss1111!) which is a common password';
                $bPregCheck = false;                
            }
            //END TOPOLOGIES SECTION
        }
        
            if(!preg_match('/^[A-Za-z]/',$first_name)){
            $errors[] = 'Your first name has to start with a letter';
                $bPregCheck = false; 
            }
            if(!preg_match('/^[A-Za-z]/',$last_name)){
            $errors[] = 'Your last name has to start with a letter';
                $bPregCheck = false; 
            }
            
            if ($email_address === null || filter_input(INPUT_POST, 'email_address') === "") {
            $errors[] = 'Email is Required';
            $bValidate = False;
            $bPregCheck = False;
        } else if (!$email_address) {
            $errors[] = 'Email is in incorrect format';
            $bValidate = False;
            $bPregCheck = False;
        }
        
        
            if(!$bPregCheck)
            {
                $bValidate = False;
                include('View/changeinfo.php');
                break;
            }
            else{
                //validated so db call for update
                $theUser = new User();
                if($theUser->updateTheUser( $_SESSION['Profile']['UserName'], $first_name, $last_name, $email_address, $phone, $password))
                {
                    $_SESSION['Profile']['FirstName']=$first_name;
                    $_SESSION['Profile']['LastName']=$last_name;
                    $_SESSION['Profile']['Email']=$email_address;
                    $_SESSION['Profile']['Phone']=$phone;
                    $theUser = new User();
                    $leaderboardInfo=array();
                    $leaderboardInfo=$theUser->getLeaderboardInfo();
                    $scheduleInfo=array();
                    $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
                    include('View/profile.php');
                    break;
                }
                else{
                    $errors = array();
                    $errors[] = 'Update was unsuccessful';
                    include('View/profile.php');
                    break;
                }
                
            }
    //login to fill profile session variables
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
            $_SESSION['Profile']['PlayerId']=$profile['PlayerId'];
            endforeach;
            $theUser = new User();
            $leaderboardInfo=array();
            $leaderboardInfo=$theUser->getLeaderboardInfo();
            $scheduleInfo=array();
            $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
            include('View/profile.php');
            break;
        } else {
            $loginError="Incorrect username or password";
            include('View/login.php');
            break;
        }
        // view profile after logging in
    case 'profile':
        $theUser = new User();
            $leaderboardInfo=array();
            $leaderboardInfo=$theUser->getLeaderboardInfo();
            $scheduleInfo=array();
            $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
        include('View/profile.php');
        break;
    //show view to write score of match played
    case 'startresult':
        $matchid = filter_input(INPUT_POST, 'matchid');
        $theUser = new User();
        $player1=$theUser->getMatchDetails($matchid)['Player1'];
        $player1id=$theUser->getMatchDetails($matchid)['Player1Id'];
        $player2=$theUser->getMatchDetails($matchid)['Player2'];
        $player2id=$theUser->getMatchDetails($matchid)['Player2Id'];
        $todaysdate=date("Y-m-d");
        include('View/startresult.php');
        break;
    //write match results to database
    case 'writeresult':
        $matchid = filter_input(INPUT_POST, 'matchid');
        $matchdate = filter_input(INPUT_POST, 'matchdate');
        $winningplayer=filter_input(INPUT_POST, 'winningplayer');
        $losingplayer=filter_input(INPUT_POST, 'losingplayer');
        $winnerset1=filter_input(INPUT_POST, 'winnerset1');
        $winnerset2=filter_input(INPUT_POST, 'winnerset2');
        $winnerset3=filter_input(INPUT_POST, 'winnerset3');
        $loserset1=filter_input(INPUT_POST, 'loserset1');
        $loserset2=filter_input(INPUT_POST, 'loserset2');
        $loserset3=filter_input(INPUT_POST, 'loserset3');
        if($winningplayer!==$losingplayer)
        {
            if(strlen($matchid)!==0&&strlen($matchdate)!==0&&strlen($winningplayer)!==0&&strlen($losingplayer)!==0&&(strlen($winnerset1)!==0
                    &&strlen($winnerset2)!==0&&strlen($winnerset3)!==0&&strlen($loserset1)!==0&&strlen($loserset2)!==0&&strlen($loserset3)!==0||strlen($winnerset1)!==0
                    &&strlen($winnerset2)!==0)&&($matchdate!=='mm/dd/yyyy')){
                if(($winnerset1>5 and $winnerset2 >5) or ($winnerset2>5 and $winnerset3 >5) or ($winnerset1>5 and $winnerset3 >5)){
                $theUser=new User();
                $theUser->writeMatch($matchid, $matchdate, $winningplayer, $losingplayer, $winnerset1, $winnerset2, $winnerset3, $loserset1, $loserset2, $loserset3);
                                    $theUser = new User();
                    $leaderboardInfo=array();
                    $leaderboardInfo=$theUser->getLeaderboardInfo();
                    $scheduleInfo=array();
                    $scheduleInfo=$theUser->getScheduleInfo($_SESSION['Profile']['PlayerId']);
                include ('View/profile.php');
                break;
            }
                else{
                    $player1=getMatchPlayers($matchid)['Player1'];
                    $player1id=getMatchPlayers($matchid)['Player1Id'];
                    $player2=getMatchPlayers($matchid)['Player2'];
                    $player2id=getMatchPlayers($matchid)['Player2Id'];
                    $todaysdate=date("Y-m-d");
                    $errormatch='No one won the match.  Best 2 out of 3 sets.  Winner of each set must get to 6 games, else if it is 5-5, you must win by 2.  Please put in the correct score or finish the match at a later date';
                include ('View/startresult.php');
                break;
                }
            }
            else{
                $player1=getMatchPlayers($matchid)['Player1'];
                $player1id=getMatchPlayers($matchid)['Player1Id'];
                $player2=getMatchPlayers($matchid)['Player2'];
                $player2id=getMatchPlayers($matchid)['Player2Id'];
                $todaysdate=date("Y-m-d");
                $errormatch="Please make sure you entered all necessary data.  Make sure to add a date.";
                include ('View/startresult.php');
                break;
            }
        }
        else{
                $player1=getMatchPlayers($matchid)['Player1'];
                $player1id=getMatchPlayers($matchid)['Player1Id'];
                $player2=getMatchPlayers($matchid)['Player2'];
                $player2id=getMatchPlayers($matchid)['Player2Id'];
                $todaysdate=date("Y-m-d");
                $errormatch="One player can't be a winner and a loser.";
                include ('View/startresult.php');
                break;
            }
    //view to create a new match
    case 'creatematch':
        $theUser = new User();
        $playerList=array();
        $playerList=$theUser->getAllPlayers();
        $todaysdate=date("Y-m-d");
        include("View/matchcreator.php");
        break;
    //write the new match to be played  
    case 'writematch':
        $player1 = filter_input(INPUT_POST, 'player1');
        $player2 = filter_input(INPUT_POST, 'player2');
        $datetoplay=filter_input(INPUT_POST, 'datetoplay');
        if($player1===$player2){
            $errormatch='Please select two different players';
            $theUser = new User();
            $playerList=array();
            $playerList=$theUser->getAllPlayers();
            $todaysdate=date("Y-m-d");
            include("View/matchcreator.php");
            break;
        }
        if(strlen($player1)===0||strlen($player2)===0||strlen($datetoplay)===0&&date($datetoplay)){
            $errormatch='Please make sure all values are filled in and with correct data.';
            $theUser = new User();
            $playerList=array();
            $playerList=$theUser->getAllPlayers();
            $todaysdate=date("Y-m-d");
            include("View/matchcreator.php");
            break;
        }
        if(getWriteNewMatch($player1, $player2, $datetoplay)){
            $matchconfirmation='The match has been booked.';
            $theUser = new User();
            $playerList=array();
            $playerList=$theUser->getAllPlayers();
            $todaysdate=date("Y-m-d");
            include("View/matchcreator.php");
            break;
        }
        else{
            $errormatch='An error has occured.  Please call your IT admin';
            $theUser = new User();
            $playerList=array();
            $playerList=$theUser->getAllPlayers();
            $todaysdate=date("Y-m-d");
            include("View/matchcreator.php");
            break;
        }
        
        
        include("View/matchcreator.php");
        break;
    
    
    //register the new profile    
    case 'registration':
        include('View/registration.php');
        break;
    //write the player to the player table in the database
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
