<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }

    if (empty($_POST)) {
        $sql="SELECT * FROM albums WHERE idAlb=".$_GET["id"];
        $res=mysqli_query($cnx, $sql);
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
        <div class='divSup'>
            <form method="post" action="modifierPhoto.php?id=<?php echo $_GET['id']?>&idAlb=<?php echo $_GET['idAlb']?>" enctype="multipart/form-data">
                <label>Classez la photo dans l'abum(s) :</label>
                <br />
                <table border='1'>
                <th colspan="2">Albums</th>
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
            </form>
        </div>
    </body>
</html>
<?php
    } else {
        if (isset($_POST['retour'])){
            mysqli_close($cnx);
            header("Location: index.php?id=".$_GET['idAlb']);
        }else {
        $sql="DELETE FROM comporter WHERE idPh = ".$_GET['id']."";
        mysqli_query($cnx, $sql);
        echo $sql;
        foreach($_POST['album'] AS $idAlb){
            $sql="INSERT INTO comporter (idAlb, idPh) VALUES ('".$idAlb."', '".$_GET['id']."')";
            mysqli_query($cnx, $sql);
        }
        mysqli_close($cnx);
        header("Location: index.php?id=".$_GET['idAlb']);
        }
    }
?>

