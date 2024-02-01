<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }
    if (empty($_POST)) {
        $sql = "SELECT nomAlb FROM albums WHERE idAlb = '".$_GET['id']."'";
        $res = mysqli_query($cnx, $sql);
        $ligne = mysqli_fetch_array($res)
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body class="bodySup">
        <div class="divSup">
            <p> Êtes vous sûr de vouloir surpprimer l'album <?=$ligne['nomAlb']?> ?</p>
            <form method="post" action="supprimerAlbum.php?id=<?=$_GET['id']?>">
                <input class="confirm" type="submit" value="Oui" name="ok">
            </form>
            <form method="post" action="index.php?id=<?=$_GET['id']?>">
                <input class="confirm" type="submit" value="Non" name="ok">
            </form>
        </div>
    </body>
</html>
<?php
    } else {
        $sql = "DELETE FROM `albums` WHERE `idAlb` =".$_GET['id'];
        mysqli_query($cnx, $sql);
        mysqli_close($cnx);
        header("Location: index.php");
}
?>

