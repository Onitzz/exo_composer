<?php

require 'doctrine-dbal-connect.php';
$stmt=null;
$erreurs = [];
if($_POST){
  if(!isset($_POST['nom']) || empty(trim($_POST['nom']))){
    $erreurs[] = 'Vous devez renseigner le champ nom';
  }
  elseif(strlen($_POST['nom']) <= 3){
      $erreurs[] = "Vous devez renseigner un nom de plus de trois caractère.";
  }
  if(!$erreurs) {
    $nom= $_POST['nom'];
    $sql = "INSERT INTO joueurs(nom) value(:nom)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("nom", trim($nom));
    try {
      $stmt->execute();
    } catch (Exception $e) {
      echo $e->getMessage();
      exit();
    }

  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire PHP</title>
  </head>
  <body>
    <div class="erreur">
<?php
  foreach ($erreurs as $erreur) {
    echo $erreur . "<br />\n";
  }
?>
    </div>
    <form action="<?php echo basename(__FILE__); ?>"  method="post" enctype="multipart/form-data">
      <div>
          <label for="nom">Ajouter un joueur :</label><br>
          <input type="text" name="nom" value="" placeholder="le nom du joueur">
      </div>
      <div>
          <input type="submit" name="sub" value="Chercher">
      </div>
    </form>
    <div>
<?php
  if($stmt){
    echo "$nom a était ajouté a la liste des joueurs.";
  }
?>
    </div>
  </body>
</html>
