<?php

require 'doctrine-dbal-connect.php';
$stmt=null;
$erreurs = [];
$stmt2=null;
$id=8;
$sql2 = "SELECT nom FROM joueurs WHERE id = :id";
$stmt2 = $conn->prepare($sql2);
$stmt2->bindValue("id", $id);
try {
  $stmt2->execute();
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
if($_POST){
  if(!isset($_POST['nom']) || empty(trim($_POST['nom']))){
    $erreurs[] = 'Vous devez renseigner le champ nom';
  }
  elseif(strlen($_POST['nom']) <= 3){
      $erreurs[] = "Vous devez renseigner un nom de plus de trois caractère.";
  }
  if(!$erreurs) {
    $nom= $_POST['nom'];
    $sql = "UPDATE joueurs SET nom = :nom WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("nom", $nom);
    $stmt->bindValue("id", $_POST['id']);

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
      <?php
        if($stmt2){
          while ($row = $stmt2->fetch()) {
      ?>
      <div>
          <input type="text" name="nom" value=<?php echo '"'.htmlentities($row['nom']).'"'; ?> placeholder="le nom du joueur">
      </div>
      <?php

        }
      }
       ?>
      <div>
        <input type="hidden" name="id" value=<?php echo $_POST['id']; ?> >
        <input type="submit" name="sub" value="Modifier">
      </div>
    </form>
    <div>
<?php
  if($stmt){
    echo "Le nom a été modifié en $nom";
  }
?>
    </div>
  </body>
</html>
