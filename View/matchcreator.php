<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Matches</title>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <header>
                <div id="result">
                    <h2>Create New Matches</h2>
                    
                    <?php if(isset($errormatch)){echo $errormatch;} ?>
                    <?php if(isset($matchconfirmation)){echo $matchconfirmation;} ?>
                    
                    <form method="post" action="index.php">  
                        <input type="hidden" name="action" value="writematch"> 
                        <label class="datetoplay" >Match Date:</label>
                        <input class="datetoplay" type="date" name="datetoplay" placeholder="mm/dd/yyyy" value="<?php echo $todaysdate; ?>">
                        <label>Enter Player1:</label>
                        <!--https://teamtreehouse.com/community/using-multiple-php-strings-when-listing-foreach-list-items -->
                        <select class="player" name="player1">    
                            <?php foreach($playerList as $thePlayerList) { ?>
                            <option value="<?php echo $thePlayerList["PlayerId"] ?>"><?php echo $thePlayerList["FirstName"].' '.$thePlayerList["LastName"] ?></option>
                            <?php } ?>
                        </select>
                        <label>Enter Player2:</label>
                        <select class="player" name="player2"> 
                            <?php foreach($playerList as $thePlayerList) { ?>
                            <option value="<?php echo $thePlayerList["PlayerId"] ?>"><?php echo $thePlayerList["FirstName"].' '.$thePlayerList["LastName"] ?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Create" name="writematch">
                    
                    </form>  
                    
                    
                </div>
                
                
            </header>
            <main>

            </main>
        </div>

<?php include 'view/footer.php'; ?>
    </body>
</html>

