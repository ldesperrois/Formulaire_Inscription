<?php
    //Desperrois Lucas
    //création du code php pour la connexion à phpmyadmin
    require_once 'db_connection.php';
    //veuillez changer le nom par celui que vous souhaitez
    $nom_site  = "Desperrois/>" ;  


   
      
   
        
    //fonction isValidMDP($mdp)
    // fonction booléenne qui retourne vrai si le mot de passe respecte certaines contraintes sinon faux
    // variable $mdp : string
    // résultat possibles : true ou false
    
     function isValidMDP($mdp)
    {
        return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',$mdp) ; 
    }
   
    //permet de vérifier qu'un utilisateur n'utilise pas un email déja inscrit;
    $verif = $db->query("SELECT COUNT(email) from users where email='martindesp8@gmail.com'");
    $count = $verif->fetchColumn();
    
    if(isset($_POST['formsend'])){
        
        extract($_POST);
        
        
        if(!empty($mdp) && !empty($nom) && !empty($prenom) && !empty($email) && isValidMDP($mdp) && $mdp===$confirmation && filter_var($email,FILTER_VALIDATE_EMAIL) ){
        
        
        
        $hashpass = password_hash($mdp,PASSWORD_DEFAULT);
        
        $q = $db->prepare("INSERT INTO users(prenom,nom,mdp,email) VALUES(:prenom,:nom,:mdp,:email)");
        $q->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'mdp' => $hashpass,
            'email' => $email
        ]);
        }

       
        
        
    }
?>

<!DOCTYPE html>
<html>
    <!--Developper par Desperrois Lucas -->
    <!--Description du formulaire -->
    
    <head>
        
        <title>Inscription <?=$nom_site ?></title>
        <link rel="stylesheet" type="text/css" href="src/style_formulaire.css">
        <meta charset="utf-8">
        <script src="src/app.js"></script>
        <meta name="keywords" content="formulaire,inscription,email,mot de passe, site,">
        <meta name="description" content="Formulaire d'inscription avec base de données en php et utilisation de phpmyadmin avec serveur apache">
        <meta name="viewport" content="width=device-width,initial-scale=1" />
    </head>
    <body>

        <!-- j'inclus la page de la navbar -->

        <?php include("navbar.php"); ?>

        <!--section du formulaire-->
        <section class="section-formulaire">
            <form class="formulaire" method="post" id="myform">
                
                
                    <div class="conteneur-titre">
                        <h1 class="titre-formulaire">Créer votre compte <?=$nom_site ?></h1>
                    </div>
                    <!--chaque input est contenu dans un div avec un label et une div qui sert de décoration pour une input plus agréable sur le formulaire -->
                    <div class="inputformulaire"> 
                        <label class="placeholder">Email</label>
                        <input class="moninput" type="text" name="email" id="email" oninput="effacerMessageErreur()"  >
                        <div class="surligne"></div>
                        <div class="emailvide">
                            <p>Vous devez rentrer un email valide avec un arobase et un point<p>
                        </div>
                    </div>
                    <!--exeception pour le mot de passe qui contient une image permettant de la voir ou non 
                        et une autre div qui indique ce que doit contenir le mot de passe-->
                    <div class="inputformulaire">
                        <label class="placeholder">Mot de passe</label>
                        <div>
                            <input class="moninput" type="password" name="mdp" id="mdp">
                            <img src="src/image/icons8-visible-30.png" class="visible" id="eye" onclick="changer()">
                        </div>
                        <div class="surligne"></div>
                        <div class="motdepasse">
                            <p>Le mot de passe doit contenir :<br/>
                            <br/>
                            <p>Au moins 8 caractères avec des lettres majuscules et minuscules, chiffres et caractères spéciaux.<p>
                        </div>
                        <div class="mdpincorrecte">
                            <p>Votre mot de passe est incorrecte :<br/>il doit contenir au moins 8 caractères avec lettres majuscules et minuscles, chiffres et caractères spéciaux<p>
                        </div>

                    </div>
                
                    <div class="inputformulaire">
                        <label  class="placeholder">Confirmation Mot de passe</label>
                        <input class="moninput" type="password" name="confirmation" id="confirmation" >
                        <div class="surligne"></div>
                        <div class="confirmation">
                            <p>le mot de passe que vous avez rentré ci-dessus ne correspond pas au mot de passe confirmé</p>
                        </div>
                    </div>
                    <div class="inputformulaire">
                        <label class="placeholder" id="label4">Nom</label>
                        <input class="moninput" type="text" name="nom" id="nom">
                        <div class="surligne"></div>
                        <div class="nom">
                            <p>Votre nom est vide</p>
                        </div>
                    </div>
                    <div class="inputformulaire">
                        <label class="placeholder" id="label5">Prenom</label>
                        <input class="moninput" type="text" name="prenom" id="prenom" >
                        <div class="surligne"></div>
                        <div class="prenom">
                            <p>Votre prenom est vide</p>
                        </div>
                    </div>
                    <!--conteneur du bouton d'enregistrement du compte -->
                    <div class="conteneur-bouton">
                        <!--bouton d'enregistrement du compte -->
                        <input class="inscription" type="submit" name="formsend" id="formsend" value="Inscription" onclick="validerFormulaire()">
                    </div>
                </form>
        </section>

        <!--pied de page avec droit d'auteur-->
        <footer class="piedpage">
            <div class="piedpage1">
                <p><?=$nom_site?><p>
            </div>
        <!--droit d'auteur-->
            <div class="piedpage2">
                <p>Copyrigh  © 2023, Desperrois Lucas, Tous droits réservés.</p>
            </div>
            
        </footer>
    </body>


</html>
