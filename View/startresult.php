<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Results</title>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <header>
                <div id="result">
                    <h2>Enter Results</h2>
                    
                    <?php if(isset($errormatch)){echo $errormatch;} ?><br>
                    <br>
                    <form method="post" action="index.php">  
                        <input type="hidden" name="action" value="writeresult"> 
                        <label class="dateplayed" >Match Date:</label>
                        <input class="dateplayed" type="date" name="matchdate" placeholder="mm/dd/yyyy" value="<?php echo $todaysdate; ?>">
                        <br>
                        <br>
                        <label>Enter Winner:</label>
                        <select id="winner" name="winningplayer">                      
                            <option value="<?php echo $player1id ?>"><?php echo $player1 ?></option>
                            <option value="<?php echo $player2id ?>"><?php echo $player2 ?></option>
                        </select><br>
                        <br>
                        <label>Enter Loser:</label>
                        <select id="loser" name="losingplayer">                      
                            <option value="<?php echo $player1id ?>"><?php echo $player1 ?></option>
                            <option value="<?php echo $player2id ?>"><?php echo $player2 ?></option>
                        </select><br>
                        <br>
                        <label class="set1label" >Set 1 Winner Games:</label>
                        <input id="winnerset1" type="text" name="winnerset1" >
                        <label class="set1label" >Set 1 Loser Games:</label>
                        <input id="loserset1" type="text" name="loserset1" ><br>
                        <br>
                        
                        <label class="set2label" >Set 2 Winner Games:</label>
                        <input id="winnerset2" type="text" name="winnerset2" >
                        <label class="set2label" >Set 2 Loser Games:</label>
                        <input id="loserset2" type="text" name="loserset2" ><br>
                        <br>
                        
                        <label class="set3label" >Set 3 Winner Games:</label>
                        <input id="winnerset3" type="text" name="winnerset3" >
                        <label class="set3label" >Set 3 Loser Games:</label>
                        <input id="loserset3" type="text" name="loserset3" ><br>
                        <br>
                        <input type="hidden" value="<?php echo $matchid ?>" name="matchid">
                        <input type="submit" value="writeresult" name="writeresult">
                    </form>  
                    
                    
                </div>
                
                
            </header>
            <main>

            </main>
        </div>

<?php include 'view/footer.php'; ?>
    </body>
</html>

