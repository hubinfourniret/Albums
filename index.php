<?php
    $cnx=mysqli_connect("localhost","root","","albums");
    
    if (mysqli_connect_error()) {
        echo "Erreur de connexion à la base de données : ".mysqli_connect_error();
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
    </head>
    <body>
        <header>
            <h1>Mes albums</h1>
            <nav>
                <?php
                $sql ="SELECT * FROM albums";
                $res = mysqli_query($cnx, $sql);
            
                while ($ligne = mysqli_fetch_array($res)) {
                        if($ligne["idAlb"]==$_GET["id"]){
                            $id=' id="courant" ';
                        }
                        else {
                            $id='';
                        }
                        echo '<a '.$id.'href="index.php?id='. $ligne['idAlb']. '">' .$ligne['nomAlb']. '</a>';
                }

                ?>
            </nav>
        </header>
        <main>
            <?php
            $sql ="SELECT * FROM photos, comporter WHERE photos.idPh=comporter.idPh AND idAlb=".$_GET["id"];
            $res = mysqli_query($cnx, $sql);

            while ($ligne = mysqli_fetch_array($res)) {
                // Afficher le nom de la photo
                 echo '<img src="photos/'.$ligne['nomph'] . '" />';
            }

            mysqli_free_result ($res);
            mysqli_close($cnx);
            ?>
        </main>
    </body>
</html>