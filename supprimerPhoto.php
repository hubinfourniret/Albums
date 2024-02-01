<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }
    if (empty($_POST)) {
        $sql = "SELECT nomPh FROM photos WHERE idPh = '".$_GET['id']."'";
        $res = mysqli_query($cnx, $sql);
        $ligne = mysqli_fetch_array($res)
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation de suppression</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body class="bodySup">
        <div class="divSup">
            <p> Êtes vous sûr de vouloir surpprimer la photo <?=$ligne['nomPh']?> ?</p>
            <form method="post" action="supprimerPhoto.php?id=<?=$_GET['id']?>&idAlb=<?=$_GET['idAlb']?>">
                <input class="confirm" type="submit" value="OUI" name="ok">
            </form>
            <form method="post" action="index.php">
                <input class="confirm" type="submit" value="NON" name="ok">
            </form>
        </div>
    </body>
</html>
<?php
    } else {
        $sql = "DELETE FROM comporter WHERE comporter.idAlb = ".$_GET['idAlb']." AND comporter.idPh = ".$_GET['id'];
        mysqli_query($cnx, $sql);

        mysqli_close($cnx);
        header("Location: index.php?id=".$_GET['idAlb']);
}
?>

