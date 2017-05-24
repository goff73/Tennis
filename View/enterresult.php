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
                    
                    <form>  
                        <label class="dateplayed" >Match Date:</label>
                        <input class="dateplayed" type="text" name="dateplayed" placeholder="mm/dd/yyyy">

                        <select id="winner" name="winner">                      
                            <option value="0">--Select Winner--</option>
                            <option value="1">Bryan</option>
                            <option value="2">Justin</option>
                        </select>

                        <select id="loser" name="loser">                      
                            <option value="0">--Select Loser--</option>
                            <option value="1">Bryan</option>
                            <option value="2">Justin</option>
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

