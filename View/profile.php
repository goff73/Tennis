<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
<head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/17SPgroup4/stickman4/View/main.css"/>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <header>
                <div id="profile_pic">
                    <h1><?php if(isset($_SESSION['Profile']['UserName']))
                        {echo htmlspecialchars($_SESSION['Profile']['FirstName']." ".$_SESSION['Profile']['LastName'])."'s";}
                        ?> Page</h1>
   
                <table>
                    <tr> 
                        <th>User Name: </th>
                        <td><?php echo htmlspecialchars($_SESSION['Profile']['UserName'])?></td>
                    </tr>
                    <tr>
                        <th>First Name: </th>
                        <td><?php echo htmlspecialchars($_SESSION['Profile']['FirstName'])?></td>
                    </tr>
                    <tr>
                        <th>Last Name: </th>
                        <td><?php echo htmlspecialchars($_SESSION['Profile']['LastName'])?></td>
                    </tr>
                    <tr>
                        <th>Phone: </th>
                        <td><?php echo htmlspecialchars($_SESSION['Profile']['Phone'])?></td>
                    </tr>
                    <tr>
                        <th>Email Address: </th>
                        <td><?php echo htmlspecialchars($_SESSION['Profile']['EMail'])?></td>
                    </tr>
                </table>

                </div>
            </header>
            <main>

            </main>
        </div>

        <?php include 'view/footer.php'; ?>
    </body>
</html>

