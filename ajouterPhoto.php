<?php
$cnx=mysqli_connect("localhost","root","","albums");
    
if (mysqli_connect_error()) {
    echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
    exit();
}
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
    <body class='bodySup'>
        <div class='divSup'>
            <form method="post" action="ajouterPhoto.php" enctype="multipart/form-data">
                <label for="nomph">Importez votre photo</label>
                <input type="file" id="nomPh" name="nomPh" accept="image/jpg" required>
                <table border='1'>
                <th colspan="2">Choisir album(s) de la photo</th>
                <?php
                $sql = "SELECT * FROM albums";
                $res = mysqli_query($cnx, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td><label for='".$row['idAlb']."'>".$row['nomAlb']."</label></td>";
                    echo "<td><input type='checkbox' id='".$row['idAlb']."' name='album[]' value='".$row['idAlb']."' ></td>";
                    echo "</tr>";
                }
                ?>
                </table>
                <br />
                <input type="submit" value="Enregistrer" name="ok">
            </form>
            <form method="post" action="index.php?id=<?=$_GET['id']?>">
                <input class="confirm" type="submit" value="Retour" name="ok">
            </form>
        </div>
    </body>
</html>
<?php
} else {
    $sql="INSERT INTO photos (nomPh) VALUES (NULL)";
    mysqli_query($cnx, $sql);
    $idPh=mysqli_insert_id($cnx);
    $tmp_name = $_FILES["nomPh"]["tmp_name"];
    $name = "ph_".$idPh.".jpg";
    $sql="UPDATE `photos` SET `nomPh` = '".$name."' WHERE `photos`.`idPh` = ".$idPh;
    mysqli_query($cnx, $sql);
    move_uploaded_file($tmp_name, "photos/$name");
    

    foreach($_POST['album'] AS $idAlb){
        $sql="INSERT INTO comporter (idAlb, idPh) VALUES ('".$idAlb."', '".$idPh."')";
        mysqli_query($cnx, $sql);
    }
            /*
    foreach ($_FILES["nomph"]["error"] as $key => $error) {
        if ($error == 0) {
            $tmp_name = $_FILES["nomph"]["tmp_name"][$key];
            $name = basename($_FILES["nomph"]["name"][$key]);
            move_uploaded_file($tmp_name, "./../htdocs/Albums/photos/$name");

            $sql="INSERT INTO `photos` (`idPh`, `nomph`) VALUES (NULL, '$name')";
            mysqli_query($cnx, $sql);
        }
    }*/
    mysqli_close($cnx);
    header("Location: index.php");
}
?>