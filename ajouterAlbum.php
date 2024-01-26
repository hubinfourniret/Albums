<?php
if (empty($_POST)) {
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
    <form method="post" action="ajouterAlbum.php">
        <label for="nomAlb">Nom de l'album</label>
        <input type="text" id="nomAlb" name="nomAlb" placeholder="Entrez le nom de l'album ..." required>
        <input type="submit" value="Enregistrer" name="ok">
    </form>
</body>
</html>
<?php
} else {
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }
 
    $sql="INSERT INTO `albums` (`idAlb`, `nomAlb`) VALUES (NULL, '".$_POST['nomAlb']."')";
    mysqli_query($cnx, $sql);
    $id=mysqli_insert_id($cnx);
    mysqli_close($cnx);
    header("Location: index.php?id=".$id);
}
?>

