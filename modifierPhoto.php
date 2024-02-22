<?php
    include("fonctions.php");
    $id=$_GET["id"];
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }

    if (empty($_POST)) {
        $res=select(['albums'],['idAlb'=>$id]);
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
            <form method="post" action="modifierPhoto.php?id=<?php echo $id ?>&idAlb=<?php echo $_GET['idAlb']?>" enctype="multipart/form-data">
                <label>Classez la photo dans l'abum(s) :</label>
                <br />
                <table border='1'>
                <th colspan="2">Albums</th>
                <?php
                $res=select(['albums']);
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
        delete('comporter',['idPh'=>$id]);
        foreach($_POST['album'] AS $idAlb){
            edit('comporter',['idAlb'=>$idAlb,'idPh'=>$id]);
        }
        mysqli_close($cnx);
        header("Location: index.php?id=".$_GET['idAlb']);
        }
    }
?>

