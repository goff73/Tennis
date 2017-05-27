<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
        <!--        <link rel="stylesheet" type="text/css" href="http://localhost/17SPgroup4/stickman4/View/main.css"/>-->
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <header>
                <div id="profile_pic">
                    <h1><?php
                        if (isset($_SESSION['Profile']['UserName'])) {
                            echo htmlspecialchars("Welcome ".$_SESSION['Profile']['FirstName'] . " " . $_SESSION['Profile']['LastName']);
                        }
                        ?></h1>

                    <table>
                        <tr> 
                            <th>User Name: </th>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['UserName']) ?></td>
                        </tr>
                        <tr>
                            <th>First Name: </th>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['FirstName']) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name: </th>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['LastName']) ?></td>
                        </tr>
                        <tr>
                            <th>Phone: </th>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['Phone']) ?></td>
                        </tr>
                        <tr>
                            <th>Email Address: </th>
                            <td><?php echo htmlspecialchars($_SESSION['Profile']['EMail']) ?></td>
                        </tr>
                    </table>
                    
                    <p>
                        <a href="index.php?action=initialedit"><?php if(isset($_SESSION['Profile']['UserName'])&&!empty($_SESSION['Profile']['UserName'])){echo htmlspecialchars('Edit Information');} ?></a>
                    </p>

                </div>


                <div id='leaderboard'>
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

                <div id='schedule'>
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
                                $matchdate = htmlspecialchars($inList['MatchDate']);
                                $opponent = htmlspecialchars($inList['Opponent']);
                                $opponentphone=htmlspecialchars($inList['OpponentPhone']);
                                $opponentemail=htmlspecialchars($inList['OpponentEMail']);
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
                                            <input type="hidden" name="matchid" value="'.$matchid.'">
                                            <input type="submit" value="enter" name="enter">
                                        </form>';
                                }
                                ?>
                                </td>
                                <td><?php echo $opponentemail?></td>
                                <td><?php echo $opponentphone?></td>
                            </tr>
<?php endforeach; ?>
                    </table>

                </div>

            </header>
            <main>

            </main>
        </div>

<?php include 'view/footer.php'; ?>
    </body>
</html>

