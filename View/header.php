<?php ?>
<html>
    <head>
        <link rel="stylesheet" href="http://localhost/Tennis/View/nav.css">    
    </head>
    <header><img src="Images/tennislogo.JPG" height="50" width="450"></header>
    
    <nav>
        <ul>
            <li><a href="index.php?action=initiallogin">Login</a></li>
            <li><a href="index.php?action=profile"><?php if(isset($_SESSION['Profile']['UserName'])&&!empty($_SESSION['Profile']['UserName'])){echo htmlspecialchars('Profile');} ?></a></li>
            <li><a href="index.php?action=registration">Registration</a></li>
            <li><?php if(isset($_SESSION['Profile']['UserName'])&&!empty($_SESSION['Profile']['UserName'])){echo htmlspecialchars('Welcome  '.$_SESSION['Profile']['UserName']);} ?></li>
            <li><a href="index.php?action=creatematch"><?php if(isset($_SESSION['Profile']['UserName'])&&($_SESSION['Profile']['Admin'])>0){echo htmlspecialchars('Create Match');} ?></a></li>
            <li><a href="index.php?action=viewdisputes"><?php if(isset($_SESSION['Profile']['UserName'])&&($_SESSION['Profile']['Admin'])>0){echo htmlspecialchars('View Disputes');} ?></a></li>
            <li><a href="index.php?action=logout">Logout</a> </li>
        </ul>
    </nav>
</html>
