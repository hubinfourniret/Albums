<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }

    if (empty($_POST)) {
        $sql="SELECT * FROM albums WHERE idAlb=".$_GET["id"];
        $res=mysqli_query($cnx, $sql);
        $nomAlb = mysqli_fetch_array($res)["nomAlb"];
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
            <body class='body-modif'>
                <form method="post" action="modifierAlbum.php?id=<?php echo $_GET['id']?>">
                    <label for="nomAlb">Nom de l'album</label>
                    <input type="text" id="nomAlb" name="nomAlb" value="<?php echo $nomAlb;?>" placeholder="Entrez le nom de l'album ..." required>
                    <input type="submit" value="Enregistrer" name="ok">
                </form>
            </body>
            </html>
        <?php
    } else {
        $sql="UPDATE albums SET nomAlb = '".$_POST['nomAlb']."' WHERE idAlb ='".$_GET["id"]."'";
        mysqli_query($cnx, $sql);
        mysqli_close($cnx);
        header("Location: index.php?id=".$_GET["id"]);
    }
?>

