<?php

require_once("fonctions_bd.php");




function afficher_en_tete(){

    switch($_SESSION["couleur"]){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
?>

<!DOCTYPE html>
<html>

<head>

    <title>Treknet</title>
    <link rel="icon" type="image/png" sizes="16x16" href="logopng.png">
    <link rel="stylesheet" href="../fontawesome-free-5.15.2-web/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="../CSS/style_recherche.css">
    <link rel="stylesheet" href="../CSS/style_general.css" >
    
    
    
</head>

<?php echo '<body style="background-color:'.$color.';">'; ?>
    <div class="wrap">
        <div class="menu">
            <a href="accueil.php" class="logo">treknet</a>
            <div class="recherche">
                <form action="recherche.php" method="GET">
                    <input class="input-recherche" name="search" type="text" placeholder="Chercher un trekker">
                    <input type="hidden" name="searchtype" value="pseudo">
                    <button class="sub-search" type="submit"><i class="fas fa-search"></i></button>
                </form>    
            </div>
        
            <nav>
                <ul>
                    <li><a href="accueil.php" title="Accueil"><i class="fas fa-home"></i></a></li>
                    <li><a href ="publication.php" title="Nouvelle publication"><i class="fas fa-plus"></i></a></li>
                    <li><a href ="#" title="Envoyer un message"><i class="fas fa-paper-plane"></i></a></li>
                    <li><a href ="profil.php" title="Modifier le profil"><i class="fas fa-cog"></i></a></li>
                    <?php
                        if($_SESSION["grade"]>=10){
                            echo '<li><a href ="profil.php" title="Gérer les utilisateurs"><i class="fas fa-user-cog"></i></a></li>"';
                        }
                    ?>
                    <li><a href ="../PHP/deconnexion.php"><i class="fas fa-sign-out-alt"></i></a></li>     
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
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Le projet</a></li>
                            <li><a href="#">Contact</a></li>
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


function afficher_profil($pseudo, $chemin,$oui,$num,$couleur){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    ?>
   <?php echo'<div style="background-color:'.$color.';" class="boite-profil">';?>
        <img class="pp" src=<?php echo $chemin ?> alt="photo de profil">  <!--petites boites lors de recherche de membres -->
        <form action="profil.php" method="post">
        <?php echo '<input type="submit" class="pseudo" value='.$pseudo.'>'; ?>
        
        <input type="hidden" name="num_profil" value=<?php echo $num;?>>
        </form><?php
        afficher_abonnement($oui,$num);       
        

        ?>
        
    </div>
    

    <?php
}

function afficher_page_profil($num){
    afficher_en_tete();
    afficher_utilisateur();

    $connexion=connexion('treknet');
    
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."' AND abonnement.num_profil_suivi='".$num."'
    ORDER BY publication.num_publication DESC";
    $res = requete1($req,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];
        $num_pub=$ligne['num_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,1,$num_pub);
        
    
    }
afficher_pied_de_page();
}

function afficher_abonnement($oui,$num){
    if($oui==0){
        ?>
        <form action="traitement_abonnement.php" method="post">
        <?php echo '<input type="hidden" name="num_suivi" value="'.$num.'">';?>
        <input type="submit" value="+" class="abo">
  </form>
  <?php
    }
}

function afficher_utilisateur(){
    if(isset($_SESSION["pseudo"])){
        
    ?>
    <div class="boite-utilisateur">
        <div class="face front">
            <?php echo '<img class="pp big" src="'.$_SESSION["photo"].'" alt="photo de profil">';?>
            <p class="username"><?php echo $_SESSION['pseudo'] ?></p>
            <div class="infos">
            <p><?php echo $_SESSION['grade'] ?></p>
            <p><?php echo $_SESSION['espece'] ?></p>
            <p>Membre depuis le : <?php echo $_SESSION['date'] ?></p>
            </div>
        </div>
        <div class="face back">
            <div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere nesciunt neque commodi consequatur, sit odio ab, porro, dolor aspernatur hic voluptates omnis tenetur ullam? Iusto eum quae error inventore maiores voluptates at omnis, amet, nemo numquam quos obcaecati ut consectetur reiciendis! Similique praesentium minus nemo sit velit dicta quia mollitia?.</p>
            </div>
        </div>
        
    </div>
    <?php
    }
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
            <form action="../PHP/traitement_connexion.php" method="POST">
                <input type="text" class="input"  name="pseudo" required="required" placeholder="Pseudo">
                <input type="password" class="input" name="mot_de_passe" required="required" placeholder="Mot de Passe">
                <input type="submit" class="bouton" value="CONNEXION" >
                <a class="mdp" href="#">Mot de passe oublié ?</a>
                <a href="../PHP/inscription.php" class="bouton">Inscription</a>
            </form>
        </div>    
    </main>  
</body>
</html>
<?php
}

function afficher_cote_gauche(){
    ?>
    <aside class="gauche">

        <p>Tableau de bord</p>
        <div>
            
        <?php

        echo $_SESSION['grade']." ".$_SESSION["pseudo"];
        echo "<br>";
       
        echo "<br>";
        echo "> Connecté(e)"
          
        ?>
        </div>
        <a href="profil.php" title="Voir le profil">Voir mon profil</a>
        <div>> Flux des publications à jour</div>

        
    </aside>

<?php
}

function afficher_cote_droit(){
    ?>
    <aside class="droit">
        <a href="messagerie.php" title="Envoyer un message">test</a>
    </aside>

<?php
}

function afficher_accueil(){
    afficher_en_tete();
    afficher_cote_gauche();

    #afficher_utilisateur();
    /*echo "<br>";

    echo "<br>";
                                            #pour le debuggage
    echo "<br>";

    echo "<br>";*/

    
    #echo '<a href="test.php">Test</a>';
    afficher_publications(0);
    afficher_cote_droit();
    afficher_pied_de_page();
}

function afficher_publication($image, $texte, $pp, $pseudo,$couleur,$date,$siprofil,$num_pub){
    switch($couleur){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
    if($siprofil==0){
    ?>
        <div class="blank"></div>
        <div class="boite-publication">
            <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>  
            
                <img src="<?php echo $pp; ?>" class="pp" alt="photo de profil">
                <p><?php echo $pseudo; ?></p>
                <p><?php echo $date; ?></p>
            </div>
            <img src="<?php echo $image; ?>" class="img-pub" alt="image publication">
            <p><?php echo $texte;?></p>   
        </div>
    <?php
    }else{
        ?>
        <div class="blank"></div>
        <div class="boite-publication prof">
            <form action="traitement_suppression.php" method="post">
                <input title="Supprimer la publication" class="suppr" type="submit" value="×">
                <input type="hidden" name="num_pub" value="<?php echo $num_pub; ?>">
            </form>
            <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>  
        
            <img src="<?php echo $pp; ?>" class="pp" alt="photo de profil">
            <p><?php echo $pseudo; ?></p>
            <p><?php echo $date; ?></p>
        </div>
        <img src="<?php echo $image; ?>" class="img-pub" alt="image publication">
        <p><?php echo $texte;?></p>   
        </div>
    <?php
    }
}

function afficher_publications($siprofil){
    $connexion=connexion('treknet');
    $num=$_SESSION["num_profil"];
    $req="SELECT * FROM `Publication` LEFT JOIN `Abonnement` 
    ON publication.num_profil = abonnement.num_profil_suivi JOIN `Profil` 
    ON publication.num_profil = profil.num_profil WHERE abonnement.num_profil_suivant='".$num."'
    ORDER BY publication.num_publication DESC";
    $res = requete1($req,$connexion);

    while($ligne=mysqli_fetch_array($res)){
        $image=$ligne['image'];
        $texte=$ligne['texte'];
        $pp=$ligne['photo_de_profil'];
        $pseudo=$ligne['pseudo'];
        $couleur=$ligne['num_section'];
        $date=$ligne['date_publication'];

        afficher_publication($image,$texte,$pp,$pseudo,$couleur,$date,$siprofil,0);
    
    }
}


function afficher_nouvelle_publication($message){
    session_start();

    afficher_en_tete();
    
    switch($_SESSION['couleur']){
        case 1 : $color = "#EABD02"; break;
        case 2 : $color = "#4399D4"; break;
        case 3 : $color = "#E63627"; break;
    }
?>

 <div class="blank"></div>
    <?php afficher_erreurs($message);?>

 <div class="form-sub">
 <?php echo '<div class="publicateur" style="background-color:'.$color.';">'; ?>
    <img src="<?php echo $_SESSION['photo']; ?>" class="pp" alt="photo de profil">
                <p><?php echo $_SESSION['pseudo']; ?></p>
                <p><?php echo date('Y-m-d'); ?></p>
 </div>
  <!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
  <form enctype="multipart/form-data" action="traitement_publication.php" method="post">
    <!-- MAX_FILE_SIZE doit précéder le champs input de type file -->
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
    <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES --> 
    <div class="img-sub">
        <input name="img_publication" value="+"  type="file" />
    </div> 
    <input type="text" name="texte" maxlength="1000" class="txt-sub" placeholder="Mon message">
    <input type="submit" value="Publier" class="bouton"/>
  </form>
 
</div>

<?php
afficher_pied_de_page();
}


?>
