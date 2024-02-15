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
        $nomAlb=mysqli_fetch_array($res)["nomAlb"];
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
            <form method="post" action="modifierAlbum.php?id=<?php echo $_GET['id']?>">
                <label for="nomAlb">Modifier le nom de l'album</label>
                <input type="text" id="nomAlb" name="nomAlb" value="<?php echo $nomAlb;?>" placeholder="Entrez le nouveau nom ..." required>
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
            header("Location: index.php?id=".$_GET['id']);
        }else {
            $nomAlb=$_POST['nomAlb'];
            edit('albums',['nomAlb'=>$nomAlb],$id);
            mysqli_close($cnx);
            header("Location: index.php?id=".$_GET["id"]);
        }
    }
?>

