<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>
    </title>
</head>
<body>

   <div class=p>
       <div class=a>
           <div class=a1><a class=a11 href="Acceuil.php"><h1><em>my</em>prof</h1> </a></div>
           <div class=a2>
           
               <a title="Se connecter" href="connecter.php">Se connecter</a>
               <a title="S'inscrire" href="Inscription.php">S'inscrire</a>
           </div>
       </div>
       <div class=b>
           <div class=b1><h2>Trouver un professeur</h2></div>
           <div class=b2><form name="vform" onsubmit="return check()" action="Acceuil.php" method="POST" >
               <input type="text" placeholder="Quelle matiére" name="matiere">
               <div id="matiere_erreur"></div>
               <input type="text" placeholder="adress ville ou quartier" name="adresse">
               <div id="adresse_erreur"></div>
                   <button type="submit" value=Recherche name="Recherche" >Rechercher</button>
           </form></div>
       </div>
       <div class=c></div>
   </div>
    
    <?php
 if(isset($_POST['Recherche'])){
    $matiere=htmlspecialchars(trim($_POST['matiere']));
    $adresse=htmlspecialchars(trim($_POST['adresse']));

  
     if($matiere && $adresse){

    try{
          $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
          $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
            $affichage=$bdd->prepare(" SELECT * FROM prof WHERE Matiere='$matiere' AND Adresse='$adresse' ");
            $affichage->execute();
            
            echo "<div class=c>";
             while($donnee=$affichage->fetch()){
              echo "<div>";
              echo "<img src=".$donnee['image']."/><br>";
              echo "pseudo".$donnee['Pseudo'].'<br>';
              echo "Dèscription:".$donnee['Description'].'<br>';
              echo "Tel :".$donnee['Tel'].'<br>';
              echo "Email :".$donnee['Email'].'<br>';
              echo "Matière :".$donnee['Matiere']."  Niveau :".$donnee['Niveau'].'<br>';
              echo "<div>";
             }
          echo "<div>";
        
        }
        catch(PDOException $e){
          echo "erreur ".$e->getMessage();
        }

      }
     else if($matiere || $adresse){

    try{
          $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
          $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
            $affichage=$bdd->prepare(" SELECT * FROM prof WHERE Matiere='$matiere' OR Adresse='$adresse' ");
            $affichage->execute();

             echo "<div class=c>";
             while($donnee=$affichage->fetch()){
              echo "<div>";
              echo "<img src=".$donnee['image']."/><br>";
              echo "pseudo".$donnee['Pseudo'].'<br>';
              echo "Dèscription:".$donnee['Description'].'<br>';
              echo "Tel :".$donnee['Tel'].'<br>';
              echo "Email :".$donnee['Email'].'<br>';
              echo "Matière :".$donnee['Matiere']."  Niveau :".$donnee['Niveau'].'<br>';
              echo "<div>";
             }
             echo "<div>";       
       }
        catch(PDOException $e){
          echo "erreur ".$e->getMessage();
        }
     


     }
     else echo"Veuiller Inseret des information!!";

  }
  else
  {

    try{
          $bdd=new PDO("mysql:host=localhost;dbname=projet","root","");
          $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
          $affichage=$bdd->prepare(" SELECT * FROM prof ");
          $affichage->execute();
          echo "<div class=c>";
          while($donnee=$affichage->fetch()){
              echo "<div>";
              echo "<img src=".$donnee['image']."/><br>";
              echo "pseudo".$donnee['Pseudo'].'<br>';
              echo "Dèscription:".$donnee['Description'].'<br>';
              echo "Tel :".$donnee['Tel'].'<br>';
              echo "Email :".$donnee['Email'].'<br>';
              echo "Matière :".$donnee['Matiere']."  Niveau :".$donnee['Niveau'].'<br>';
              echo "</div>";             
             }
          echo "<div>";

        }
        catch(PDOException $e){
          echo "erreur ".$e->getMessage();
        }
     }
  ?>
  <script>
      function check(){
          let matiere = document.forms["vform"]["matiere"];
          let matiere_erreur = document.getElementById("matiere_erreur");
          let adresse = document.forms["vform"]["adresse"];
          let adresse_erreur = document.getElementById("adresse_erreur");
          if(matiere.value !== ""){
               matiere_erreur.textContent = "";
          }
          if(adresse.value !== ""){
               adresse_erreur.textContent = "";
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
          return true ;
      }
  </script>
</body>
</html>