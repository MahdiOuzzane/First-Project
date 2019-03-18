<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
    </title>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="formule.css">
    
</head>
<body>

      <?php
      session_start();
  if(isset($_POST['inscrire'])){
    $pseudo=htmlspecialchars(trim($_POST['pseudo']));
    $nom=htmlspecialchars(trim($_POST['nom']));
    $prenom=htmlspecialchars(trim($_POST['prenom']));
    $adresse=htmlspecialchars(trim($_POST['adresse']));
    $matiere=htmlspecialchars(trim($_POST['matiere']));
    $niveau=htmlspecialchars(trim($_POST['niveau']));
    $description=htmlspecialchars(trim($_POST['description']));
    $tel=htmlspecialchars(trim($_POST['tel']));
    $email=htmlspecialchars(trim($_POST['email']));
    $mdp=htmlspecialchars(trim($_POST['mdp']));
    $rmdp=htmlspecialchars(trim($_POST['rmdp']));  
    $image=($_POST['image']);

    if($pseudo &&$nom &&$prenom &&$adresse &&$matiere &&$niveau &&$email &&$tel &&$description &&$mdp &&$rmdp){
      if($mdp==$rmdp){
        $mdp=md5($mdp);
        try{
          $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
          $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
            $test=$bdd->prepare(" SELECT * FROM prof WHERE Pseudo='$pseudo' ");
            $test->execute();
            $num=$test->rowCount();
             if($num==0){
          
               $connexion=$bdd->prepare("INSERT INTO prof (Pseudo,Nom,Prenom,Matiere,Adresse,Niveau,Email,Tel,Description,Mdp) VALUES ('$pseudo','$nom','$prenom','$matiere','$adresse','$niveau','$email','$tel','$description','$mdp')");

                 $connexion->execute();
                 header("location:membre.php");
               // echo ('Inscription Avec succee');
              }   
             else{
              echo "Nom D/'utilisateur deja existant";
                }
              }
        catch(PDOException $e){
          echo "erreur ".$e->getMessage();
        }
      }
        else{
          echo "Mot De Passe Incorrect";
        }
      }  
     else{
      echo "Veuiller Remplire Tous Les Champs!!";
        }
  }
 ?>
  <div class=p>
       
           <div class=a1><a href="Acceuil.php"><h1><em>my</em>prof</h1> </a> </div>
       <div class=b>
           <div class=b1><h2>inscription</h2></div>
           <div class=b2><form name="vform" onsubmit="return check()" action="Inscription.php" method="POST">
               <input type="text" placeholder="Pseudo" name="pseudo">
               <div id="pseudo_erreur"></div> 
               <input type="text" placeholder="Nom" name="nom">
               <div id="nom_erreur"></div>
               <input type="text" placeholder="Prènom" name="prenom">
               <div id="prenom_erreur"></div>
               <input type="text" placeholder="matière" name="matiere">
               <div id="matiere_erreur"></div>
               <input type="text" placeholder="Adresse" name="adresse">
               <div id="adresse_erreur"></div>
               <input type="text" placeholder="niveau" name="niveau">
               <div id="niveau_erreur"></div>
               <input type="email" placeholder="Email" name="email">
               <div id="email_erreur"></div>
               <input type="tel" placeholder="Télèphone" name="tel">
               <div id="tel_erreur"></div>
               <input type="text" placeholder="Description" name="description"  style="padding-bottom: 78.4px;">
               <div class="description_erreur"></div>
               <input type="password" placeholder="Mot de passe" name="mdp">
               <div id="mdp_erreur"></div>
               <input type="password" placeholder="Confirmer Mot de passe" name="rmdp">
               <div id="rmdp_erreur"></div>
               <input type="file" name="image">
                   <button type="submit" values="S'inscrire" name="inscrire">S'inscrire</button>
                   <a href="connecter.php">Deja inscrit</a>
           </form></div>
       </div>
   </div>
  <script>
       function check(){
           let pseudo = document.forms["vform"]["pseudo"];
           let pseudo_erreur = document.getElementById("pseudo_erreur");
           let nom = document.forms["vform"]["nom"];
           let nom_erreur = document.getElementById("nom_erreur");
           let prenom = document.forms["vform"]["prenom"];
           let prenom_erreur = document.getElementById("prenom_erreur");
           let matiere = document.forms["vform"]["matiere"];
           let matiere_erreur = document.getElementById("matiere_erreur");
           let niveau = document.forms["vform"]["niveau"];
           let niveau_erreur = document.getElementById("niveau_erreur");
           let email = document.forms["vform"]["email"];
           let email_erreur = document.getElementById("email_erreur");
           let telephone = document.forms["vform"]["tel"];
           let telephone_erreur = document.getElementById("tel_erreur");
           let description = document.forms["vform"]["description"];
           let description_erreur = document.getElementById("description_erreur");
           let adresse = document.forms["vform"]["adresse"];
           let adresse_erreur = document.getElementById("adresse_erreur");
           let mdp = document.forms["vform"]["mdp"];
           let mdp_erreur = document.getElementById("mdp_erreur");
           let rmdp = document.forms["vform"]["rmdp"];
           let rmdp_erreur = document.getElementById("rmdp_erreur");
           if(pseudo.value !== ""){
               pseudo_erreur.textContent = "";
           }
           if(nom.value !== ""){
               nom_erreur.textContent = "";
           }
           if(prenom.value !== ""){
               prenom_erreur.textContent = "";
           }
           if(matiere.value !== ""){
               matiere_erreur.textContent = "";
           }
           if(adresse.value !== ""){
               adresse_erreur.textContent = "";
           }
           if(niveau.value !== ""){
               niveau_erreur.textContent = "";
           }
           if(niveau.value !== 0 ){
               niveau_erreur.textContent = "";
           }
           if(email.value !== ""){
               email_erreur.textContent = "";
           }
           if(telephone.value !== ""){
               telephone_erreur.textContent = "";
           }
           if(description.value !== ""){
               description_erreur.textContent = "";
           }
           
           if(mdp.value !== ""){
               mdp_erreur.textContent = "";
           }
           if(rmdp.value !== ""){
               rmdp_erreur.textContent = "";
           }
           if (pseudo.value == ""){
               pseudo_erreur.textContent = "le champ est vide !";
               pseudo_erreur.style = "color:red";
               pseudo.focus();
               return false;
           }       
           if (nom.value == ""){
               nom_erreur.textContent = "le champ est vide !";
               nom_erreur.style = "color:red";
               return false;
           }
           if (prenom.value == ""){
               prenom_erreur.textContent = "le champ est vide !";
               prenom_erreur.style = "color:red";
               return false;
           }
           if (matiere.value == ""){
               matiere_erreur.textContent = "le champ est vide !";
               matiere_erreur.style = "color:red";
               return false;
           } 
           if (adresse.value == ""){
               adresse_erreur.textContent = "le champ est vide !";
               adresse_erreur.style = "color:red";
               return false;
           }
           if (niveau.value == ""){
               niveau_erreur.textContent = "le champ est vide !";
               niveau_erreur.style = "color:red";
               return false;
           }
           if (niveau.value == 0 ){
               niveau_erreur.textContent = "entrez un niveau valide !";
               niveau_erreur.style = "color:red";
               return false;
           }         
           if (email.value == ""){
               email_erreur.textContent = "le champ est vide !";
               email_erreur.style = "color:red";
               return false;
           }
           if (telephone.value == ""){
               telephone_erreur.textContent = "le champ est vide !";
               telephone_erreur.style = "color:red";
               return false;
           }
           if (telephone.value.length !== 10) {
               telephone_erreur.textContent = "entrez un numéro de téléphone valide !";
               telephone_erreur.style = "color:red";
               return false;
           }
           if (description.value == ""){
               description_erreur.textContent = "le champ est vide !";
               description_erreur.style = "color:red";
               return false;
           }
           
           if (mdp.value == ""){
               mdp_erreur.textContent = "le champ est vide !";
               mdp_erreur.style = "color:red";
               return false;
           }
           if(mdp.value.length < 8){
               mdp_erreur.textContent = "le mot de passe doit avoir plus de 8 caractères !";
               mdp_erreur.style = "color:red";
               return false;
           }
           if (rmdp.value !== mdp.value){
               rmdp_erreur.textContent = "erreur de confirmation de mot de passe !";
               rmdp_erreur.style = "color:red";
               return false;
           }
           return true;
       }
 </script>
    
</body>
</html>