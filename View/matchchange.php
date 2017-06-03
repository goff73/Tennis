<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Match Result</title>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://localhost/Tennis/View/main.css"/>
    </head>
    <body>

        <div id="wrapper2">
            <header>
                <div id="result">
                    <h2>Change Match Result</h2>
                    <br>
                    <?php if(isset($errormatch)){echo $errormatch;} ?>
                    <form method="post" action="index.php">  
                        <input type="hidden" name="action" value="finishdispute"> 
                        <label class="dateplayed" >Match Date:</label>
                        <input class="dateplayed" type="date" name="matchdate" placeholder="mm/dd/yyyy" value="<?php if(isset($dateplayed)){echo $dateplayed;}?>">
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
                        <input id="winnerset1" type="text" name="winnerset1" value="<?php if(isset($winnerset1)){echo $winnerset1;} ?>"><br>
                        <label class="set1label" >Set 1 Loser Games:</label>
                        <input id="loserset1" type="text" name="loserset1" value="<?php if(isset($loserset1)){echo $loserset1;} ?>"><br>
                        <br>
                        
                        <label class="set2label" >Set 2 Winner Games:</label>
                        <input id="winnerset2" type="text" name="winnerset2" value="<?php if(isset($winnerset2)){echo $winnerset2;} ?>"><br>
                        <label class="set2label" >Set 2 Loser Games:</label>
                        <input id="loserset2" type="text" name="loserset2" value="<?php if(isset($loserset2)){echo $loserset2;} ?>"><br>
                        <br>
                        
                        <label class="set3label" >Set 3 Winner Games:</label>
                        <input id="winnerset3" type="text" name="winnerset3" value="<?php if(isset($winnerset3)){echo $winnerset3;} ?>"><br>
                        <label class="set3label" >Set 3 Loser Games:</label>
                        <input id="loserset3" type="text" name="loserset3" value="<?php if(isset($loserset3)){echo $loserset3;} ?>"><br>
                        <br>
                        <input type="hidden" value="<?php echo $matchid ?>" name="matchid">
                        <input type="submit" value="Make Changes" name="Make Changes">
                    </form>  
                    
                    
                </div>
                
                
            </header>
            <main>

            </main>
        </div>

<?php include 'view/footer.php'; ?>
    </body>
</html>

