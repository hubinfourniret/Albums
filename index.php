<?php
    session_start();
    include('fonctions.php');
    $cnx=mysqli_connect("localhost","root","","albums");
    if (mysqli_connect_error()) {
        echo "Erreur de connexion � la base de donn�es : ".mysqli_connect_error();
        exit();
    }
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
    <body>
        <header>
            <h1>Mes albums</h1>
            <nav>
                <?php
                if(!isset($_GET['id'])){
                    $sql ="SELECT idAlb FROM `albums` LIMIT 1";
                    $res = mysqli_query($cnx, $sql);
                    $_GET['id']=mysqli_fetch_array($res)['idAlb'];
                }
                
                $sql ="SELECT * FROM albums";
                $res = mysqli_query($cnx, $sql);
            
                while ($ligne = mysqli_fetch_array($res)) {
                        if($ligne["idAlb"]==$_GET["id"]){
                            $id=' id="courant" ';
                        }
                        else {
                            $id= "";
                        }
                        echo '<a '.$id.'href="index.php?id='. $ligne['idAlb']. '">' .$ligne['nomAlb']. '</a>';
                }
                if (isAdmin()){
                ?>
                <a href="ajouterAlbum.php?id=<?php echo $_GET['id']; ?>"> <img id='icn' src='images/plus.png'/></a>
                <a href="modifierAlbum.php?id=<?php echo $_GET['id']; ?>"> <img id='icn' src='images/edit.png'/></a>
                <a href="supprimerAlbum.php?id=<?php echo $_GET['id']; ?>"> <img id='icn' src='images/corbeille.png'/></a>
                <a href="deconnexion.php" class="bouton">Déconnexion</a>
                <?php
                }
                if (!isAdmin()){
                ?>
                <a href="login.php" class="bouton">Connexion</a>
                <?php
                }
                ?>
            </nav>
        </header>
        <main class='main-index'>
            <?php
            $sql ="SELECT * FROM photos, comporter WHERE photos.idPh=comporter.idPh AND idAlb=".$_GET["id"];
            $res = mysqli_query($cnx, $sql);

            while ($ligne = mysqli_fetch_array($res)) {
                echo "<div>";
                echo "<img src='photos/".$ligne['nomPh']."'class='main-img' alt='Image' onclick='ouvrirImage(\"" . $ligne['nomPh'] . "\")'/>";
                if (isAdmin()){
                echo "<a href='modifierPhoto.php?id=".$ligne['idPh']."&idAlb=".$_GET['id']."'><img class='icnImg2' src='images/edit.png'/></a>";
                echo "<a href='supprimerPhoto.php?id=".$ligne['idPh']."&idAlb=".$_GET['id']."'><img class='icnImg1' src='images/corbeille.png'/></a>";
                }
                echo "</div>";
            }
            mysqli_free_result ($res);
            mysqli_close($cnx);
            
            if (isAdmin()){
            echo "<div class='photoPlus'>";
            echo "<a href='ajouterPhoto.php?id=".$_GET['id']."'> <img src='images/plus.png'/></a>";
            }
            /*$sql=SELECT * FROM albums, useralbums WHERE albums.idAlb=useralbums.idAlb AND idUser=1;    pour récuperer tout les albums de l'utilisateur 1         pour le menu nav
    $res = mysqli_query($cnx, $sql);*/
            ?>
        </div>
        </main>
    </body>
</html>
