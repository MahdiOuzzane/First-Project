<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=formule.css>
    <title>
    </title>
</head>
<body>
 <?php
  session_start(); 
  if(isset($_POST['submit'])){
  $pseudo=htmlspecialchars(trim($_POST['pseudo']));
  $mdp=htmlspecialchars(trim($_POST['mdp']));
  $mdp=md5($mdp);
  if($mdp && $pseudo){
   try{
  $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
  $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $reponse=$bdd->prepare("SELECT * FROM prof WHERE Pseudo='$pseudo' AND Mdp='$mdp'");
  
  $reponse->execute();
  $rows=$reponse->rowCount();

    if($rows==1){
    $_SESSION["pseudo"]=$pseudo;
    $_SESSION["mdp"]=$mdp;
    header('location:membre.php');
    }
 
    else{
      echo "Mot  de passe ou nom d'utilisateur incorrect";
    }
  }
  catch(PDOException $e){
    echo "erreur".$e->getMessage();
  }

}
 else
 {
  echo "veuillez remplire tous le champs";
}
}       

?>

   <div class=p>
       
           <div class=a1><a href="Acceuil.php"><h1><em>my</em>prof</h1> </a> </div>
         
      
       <div class=b>
           <div class=b1><h2>Se connecter</h2></div>
           <div class=b2><form name="vform" onsubmit="return check()" action="Connecter.php" method="POST">
               <input type="text" placeholder="pseudo" name="pseudo">
               <div id="pseudo_erreur"></div>
               <input type="password" placeholder="Mot de passe" name="mdp">
               <div id="mdp_erreur"></div>
                   <button type="submit" values="Se conecter" name="submit">se connecter</button>
                   <a href=Inscription.php>S'inscrire</a>
           </form></div>
       </div>
       <div class=c></div>
   </div>
   <script>
      function check(){
       let pseudo = document.forms["vform"]["pseudo"];
       let pseudo_erreur =  document.getElementById("pseudo_erreur");
       let mdp = document.forms["vform"]["mdp"];
       let mdp_erreur =  document.getElementById("mdp_erreur");
       if(pseudo.value !== ""){
               pseudo_erreur.textContent = "";
       }
       if(mdp.value !== ""){
               mdp_erreur.textContent = "";
       }
       if (pseudo.value == ""){
               pseudo_erreur.textContent = "le champ est vide !";
               pseudo_erreur.style = "color:red";
               pseudo.focus();
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
        return true ;
      }
   </script>
    
</body>
</html>
