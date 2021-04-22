<?php

function afficher_en_tete(){
?>

<!DOCTYPE html>
<html>

<head>

    <title>Treknet</title>
    <link rel="icon" type="image/png" sizes="16x16" href="logopng.png">
    <link rel="stylesheet" href="../fontawesome-free-5.15.2-web/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="../CSS/style_recherche.css">
    <link rel="stylesheet" href="../CSS/style_general.css">
    
    
</head>

<body>
    <div class="wrap">
        <div class="menu">
            <a href="#" class="logo">treknet</a>
            <div class="recherche">
                <form action="recherche.php" method="GET">
                    <input class="input-recherche" name="search" type="text" placeholder="Chercher un membre">
                    <input type="hidden" name="searchtype" value="pseudo">
                    <button class="sub-search" type="submit"><i class="fas fa-search"></i></button>
                </form>    
            </div>
        
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i></a></li>
                    <li><a href ="main.html"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="#"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="profil.php"><i class="fas fa-cog"></i></a></li>
                    <li><a href ="#"><i class="fas fa-sign-out-alt"></i></a></li>     
                </ul>
            </nav>
        </div>


<?php
} 
?>


<?php

function afficher_pied_de_page(){
    global $traduction;
 ?>
        <footer class= "footer">
            <div class= "container">
                <div class= "row">
                    <div class= "footer-col">
                        <h3>MENTIONS LEGALES</h3>
                        <ul>
                            <li><a href="#">Conditions d'utilisation </a></li>
                            <li><a href="#">Politiques de données</a></li>
                            <li><a href="#">Mentions Légales</a></li>
                        </ul>
                    </div>
                    <div class= "footer-col">
                        <h3>RETROUVEZ-NOUS SUR LES RESEAUX</h3>
                        <ul>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Youtube</a></li>
                        </ul>
                    </div>
                    <div class= "footer-col">
                        <h3>QUI SOMMES-NOUS ?</h3>
                        <ul>
                            <li><a href="apropo.html">À propos</a></li>
                            <li><a href="coach.html">Le projet</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
    

<?php
}


function afficher_profil($pseudo, $chemin){
    ?>
    <div class="boite-profil">
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">
        <?php echo '<p class="pseudo">', $pseudo , '</p>'; ?>
    </div>
    

    <?php
}

function afficher_erreurs($message){
    
        echo '<p class="erreur">',$message,'</p>';
    

}

function afficher_connexion($message){
    ?>
    <!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Where no man has gone before</title>

</head>

<body>
   

    <main>


        <div class="logo">

            <h1>treknet</h1> 
            <p>le réseau des trekkies par exellence</p>

        </div>
        <?php
            afficher_erreurs($message);
        ?>

        <div class="connexion">

            <form action="../PHP/action.php" method="POST">

            <input type="text" class="input"  name="pseudo" required="required" placeholder="Pseudo">
            <input type="password" class="input" name="mot_de_passe" required="required" placeholder="Mot de Passe">
            <input type="submit" class="bouton" value="CONNEXION" >
            <a class="mdp" href="#">Mot de passe oublié ?</a>
            <!-- <input type="submit" value="" class="input" placeholder="CONNEXION"> -->
            <a href="inscription.html" class="bouton">Inscription</a>
        </form>

        </div>
        
    </main>
   
</body>

</html>
<?php
}

function afficher_accueil(){
    afficher_en_tete();

    afficher_pied_de_page();

}


?>
