<?php
include("fonctions.php");
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
        <form method="post" action="ajouterAlbum.php?id=<?=$_GET['id']?>">
            <label for="nomAlb">Ajouter un album</label>
            <input type="text" id="nomAlb" name="nomAlb" placeholder="Entrez le nom de l'album ...">
            <input type="submit" value="Enregistrer" name="enregistrer">
            <input type="submit" value="retour" name="retour">
        </form>
    </div>
</body>
</html>
<?php
} else {
    if (isset($_POST['retour'])){
        header("Location: index.php?id=".$_GET['id']);
    }else {
        $cnx=mysqli_connect("localhost","root","","albums");
        
        if (mysqli_connect_error()) {
            echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
            exit();
        }
        $nomAlb=$_POST['nomAlb'];
        $id=edit('albums',['idAlb'=>'NULL','nomAlb'=>$nomAlb]);
        mysqli_close($cnx);
        header("Location: index.php?id=".$id);
    }
}
?>

