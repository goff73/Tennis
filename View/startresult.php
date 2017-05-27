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
                    
                    <?php if(isset($errormatch)){echo $errormatch;} ?>
                    
                    <form method="post" action="index.php">  
                        <input type="hidden" name="action" value="writeresult"> 
                        <label class="dateplayed" >Match Date:</label>
                        <input class="dateplayed" type="date" name="matchdate" placeholder="mm/dd/yyyy" value="<?php echo date("Y-m-d"); ?>">
                        <label>Enter Winner:</label>
                        <select id="winner" name="winningplayer">                      
                            <option value="<?php echo $player1id ?>"><?php echo $player1 ?></option>
                            <option value="<?php echo $player2id ?>"><?php echo $player2 ?></option>
                        </select>
                        <label>Enter Loser:</label>
                        <select id="loser" name="losingplayer">                      
                            <option value="<?php echo $player1id ?>"><?php echo $player1 ?></option>
                            <option value="<?php echo $player2id ?>"><?php echo $player2 ?></option>
                        </select>

                        <label class="set1label" >Set 1:</label>
                        <input id="winnerset1" type="text" name="winnerset1" >
                        <input id="loserset1" type="text" name="loserset1" >
                        
                        <label class="set2label" >Set 2:</label>
                        <input id="winnerset2" type="text" name="winnerset2" >
                        <input id="loserset2" type="text" name="loserset2" >
                        
                        <label class="set3label" >Set 3:</label>
                        <input id="winnerset3" type="text" name="winnerset3" >
                        <input id="loserset3" type="text" name="loserset3" >
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

