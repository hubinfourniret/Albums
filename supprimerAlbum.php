<?php
    include("fonctions.php");
    $id=$_GET['id'];
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion a la base de donnees : ".mysqli_connect_error();
        exit();
    }

    if (empty($_POST)) {
        $res=select(['albums'],['idAlb'=>$id]);
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
            <input type="submit" value="Oui" name="oui">
            <input type="submit" value="Non" name="non">
            </form>
        </div>
    </body>
</html>
<?php
    } else {
        if (isset($_POST['non'])){
            mysqli_close($cnx);
            header("Location: index.php?id=".$_GET['id']);
        }else {
            delete('albums',$id);
            mysqli_close($cnx);
            header("Location: index.php");
        }
}
?>

