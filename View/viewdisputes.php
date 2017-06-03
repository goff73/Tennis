<?php
include('header.php');
?>

<!DOCTYPE html>

<html>
<head>
        <meta charset="UTF-8">
        <title>List of Tennis Disputes</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/Tennis/View/main.css"/>
        <link href="https://fonts.googleapis.com/css?family=Palanquin+Dark" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper2">
            <h1>Tennis Match Disputes</h1>
            <?php
                            foreach ($disputeInfo as $disList):
                                $disputeid = htmlspecialchars($disList['disputeid']);
                                $matchid = htmlspecialchars($disList['matchid']);
                                $message = htmlspecialchars($disList['message']);
                                ?>
                        <table>
                                <td><?php echo htmlspecialchars($message); ?></td>
                                <td><form action="index.php" method="post">
                                        <input type="hidden" name="action" value="changematch">
                                        <input type="hidden" name="matchid" value="<?php echo htmlspecialchars($matchid); ?>">
                                        <input type="hidden" name="disputeid" value="<?php echo htmlspecialchars($disputeid); ?>">
                                        <input type="submit" value="Resolve Dispute" name="Resolve Dispute">
                                    </form>
                                </td>
                        </table>
                    <?php endforeach; ?>
        </div>

        <?php include 'view/footer.php'; ?>
    </body>
</html>

