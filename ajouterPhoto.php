<?php
include("fonctions.php");

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
            <form method="post" action="ajouterPhoto.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">
                <label for="nomph">Importez votre photo</label>
                <input type="file" id="nomPh" name="nomPh" accept="image/jpg">
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
                <input type="submit" value="Enregistrer" name="enregistrer">
                <input type="submit" value="retour" name="retour">
        </div>
    </body>
</html>
<?php
} else {
    if (isset($_POST['retour'])){
        mysqli_close($cnx);
        header("Location: index.php?id=".$_GET['idAlb']);
    }else {
    $idPh=edit('photos',['nomPh'=>'NULL']);
    $tmp_name = $_FILES["nomPh"]["tmp_name"];
    $name = "ph_".$idPh.".jpg";
    edit('photos',['nomPh'=>$name],$idPh);
    move_uploaded_file($tmp_name, "photos/$name");
    foreach($_POST['album'] AS $idAlb){
        edit('comporter',['idAlb'=>$idAlb,'idPh'=>$idPh]);
    }
    mysqli_close($cnx);
    header("Location: index.php?id=".$_GET['id']);
    }
}
?>