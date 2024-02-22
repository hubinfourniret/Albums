<?php
    include("fonctions.php");
    session_start();
    $cnx=mysqli_connect("localhost","root","","albums");
    if (mysqli_connect_error()) {
        echo "Erreur de connexion � la base de donn�es : ".mysqli_connect_error();
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
    <body class="bodySup">
        <form class="divSup" method="post" action="login.php">
            <label for='identifiant'>Identifiant</label>
            <input type="text" id="identifiant" name="identifiant" placeholder="Entrez votre identifiant ..." required>
            <label for=''>Mot de passe</label>
            <input type="password" id="mdp" name="mdp" placeholder="Entrez votre mot de passe..." required>
            <input type="submit" value="Sign in" />
        </form>
    </body>
</html>
<?php
} else {
    $id=$_POST['identifiant'];
    $mdp=$_POST['mdp'];
    $res=select(['user'],['identifiant'=>$id,'mdp'=>$mdp],1);
    $nb=mysqli_num_rows($res);
    if ($nb==1){
        $_SESSION['admin']=true;
        mysqli_close($cnx);
        header("Location: index.php");
    }else{
        header("Location: login.php");
    }
    
}







/*
// Utiliser des requêtes préparées pour éviter les attaques par injection SQL
    $sql = "SELECT * FROM user WHERE identifiant = ? AND mdp = ?";
    
    // Préparer la requête
    $stmt = mysqli_prepare($cnx, $sql);

    // Vérifier si la préparation a réussi
    if ($stmt) {
        // Associer les paramètres
        mysqli_stmt_bind_param($stmt, "ss", $_POST['identifiant'], $_POST['mdp']);

        // Exécuter la requête
        mysqli_stmt_execute($stmt);

        // Récupérer le résultat
        $result = mysqli_stmt_get_result($stmt);

        // Vérifier si une ligne correspond aux identifiants fournis
        if ($row = mysqli_fetch_assoc($result)) {
            // Identifiants valides, rediriger vers la page d'accueil
            mysqli_close($cnx);
            header("Location: index.php");
        } else {
            // Identifiants invalides, afficher un message d'erreur
            echo "Identifiant ou mot de passe incorrect.";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    } else {
        // La préparation a échoué, afficher un message d'erreur
        echo "Erreur lors de la préparation de la requête.";
    }*/
?>