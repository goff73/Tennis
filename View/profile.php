<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/Tennis/View/main.css"/>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>
        
        <h1><?php
                        if (isset($_SESSION['Profile']['UserName'])) {
                            echo htmlspecialchars("Welcome " . $_SESSION['Profile']['FirstName'] . " " . $_SESSION['Profile']['LastName']);
                        }
                        ?></h1>
        
        
        <div id="leaderboard">
                    <h2>Leaderboard</h2>
                    <table>
                        <tr>
                            <th>Player</th>
                            <th>Number Of Wins</th>
                            <th>Number Of Losses</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($leaderboardInfo as $inList):
                                $player = htmlspecialchars($inList['PlayerName']);
                                $wins = htmlspecialchars($inList['NumberOfWins']);
                                $losses = htmlspecialchars($inList['NumberOfLosses']);
                                ?>
                                <td><?php echo $player; ?></td>
                                <td><?php echo $wins; ?></td>
                                <td><?php echo $losses; ?></td>
                            </tr>
                    <?php endforeach; ?>
                    </table>

                </div>

        <div id="wrapper">
            <header>
                <h2>Profile Information</h2>
                    <table>
                        <tr> 
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['UserName']) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['FirstName']) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['LastName']) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['Phone']) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['EMail']) ?></td>
                        </tr>
                    </table>

                    <p>
                        <a href="index.php?action=initialedit"><?php if (isset($_SESSION['Profile']['UserName']) && !empty($_SESSION['Profile']['UserName'])) {
                            echo htmlspecialchars('Edit Information');
                        } ?></a>
                    </p>



                

                

            </header>
            <main>

            </main>
        </div>

        <div id="schedule">
                    <h2>Schedule</h2>
                    <table>
                        <tr>
                            <th>Match Date</th>
                            <th>Opponent</th>
                            <th>Result</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($scheduleInfo as $inList):
                                $matchid = htmlspecialchars($inList['MatchId']);
                                //date formatting issues https://www.youtube.com/watch?v=ZomK0WiIArs
                                $matchdate = htmlspecialchars(strtotime($inList['MatchDate']));
                                $matchdate= htmlspecialchars(date('M-d-Y',$matchdate));
                                $opponent = htmlspecialchars($inList['Opponent']);
                                $opponentphone = htmlspecialchars($inList['OpponentPhone']);
                                $opponentemail = htmlspecialchars($inList['OpponentEMail']);
                                $result = htmlspecialchars($inList['Result']);
                                ?>
                                <td><?php echo $matchdate; ?></td>
                                <td><?php echo $opponent; ?></td>
                                <td><?php
                                    if (strpos($result, 'enter') === false) {
                                        echo $result;
                                    } else {
                                        echo '<form action="index.php" method="post">
                                            <input type="hidden" name="action" value="startresult"> 
                                            <input type="hidden" name="matchid" value="' . $matchid . '">
                                            <input type="submit" value="Enter Score" name="Enter Score">
                                        </form>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $opponentemail ?></td>
                                <td><?php echo $opponentphone ?></td>
                            </tr>
<?php endforeach; ?>
                    </table>

                </div>
        
<?php include 'view/footer.php'; ?>
    </body>
</html>

