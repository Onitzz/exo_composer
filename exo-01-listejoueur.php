

<?php
$stmt3=null;

require 'doctrine-dbal-connect.php';

if($_GET['id'] && $_GET['del']){
  $stmt5=null;
  $sql5 = "DELETE FROM joueurs where id= :id";
  $stmt5 = $conn->prepare($sql5);
  $stmt5->bindValue("id", $_GET['id']);
  try {
    $stmt5->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    exit();
  }
}
elseif ($_GET['id']) {
  $stmt3=null;
  $sql3 = "SELECT * FROM joueurs where id= :id";
  $stmt3 = $conn->prepare($sql3);
  $stmt3->bindValue("id", $_GET['id']);
  try {
    $stmt3->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    exit();
  }
}
if($stmt3){
  while ($row = $stmt3->fetch()) {
    $id= htmlentities($row['id']);
    $nom= htmlentities($row['nom']);
    $pays= htmlentities($row['pays']);
    $ville= htmlentities($row['ville']);
  }
}
if($_POST){
  if(!isset($_POST['nom']) || empty(trim($_POST['nom']))){
    $erreurs[] = 'Vous devez renseigner le champ nom';
  }
  if(!isset($_POST['ville']) || empty(trim($_POST['ville']))){
    $erreurs[] = 'Vous devez renseigner le champ ville';
  }
  if(!isset($_POST['pays']) || empty(trim($_POST['pays']))){
    $erreurs[] = 'Vous devez renseigner le champ pays';
  }
  elseif(strlen($_POST['nom']) < 3){
      $erreurs[] = "Vous devez renseigner un nom de plus de trois caractère.";
  }
  if(!$erreurs){
    if($_POST['id']){
      $stm4=null;
      $sql4 = "UPDATE joueurs set nom = :nom, pays = :pays, ville = :ville WHERE id = :id";
      $stmt4 = $conn->prepare($sql4);
      $stmt4->bindValue("id", $_POST['id']);
      $stmt4->bindValue("nom", trim($_POST['nom']));
      $stmt4->bindValue("pays", trim($_POST['pays']));
      $stmt4->bindValue("ville", trim($_POST['ville']));
      try {
        $stmt4->execute();
      } catch (Exception $e) {
        echo $e->getMessage();
        exit();
      }
    }
    else{
      $stm2=null;
      $sql2 = "INSERT INTO joueurs(nom,pays,ville) value(:nom,:pays,:ville)";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bindValue("nom", trim($_POST['nom']));
      $stmt2->bindValue("pays", trim($_POST['pays']));
      $stmt2->bindValue("ville", trim($_POST['ville']));
      try {
        $stmt2->execute();
      } catch (Exception $e) {
        echo $e->getMessage();
        exit();
      }
    }
  }
}



$stmt=null;
$sql = "SELECT * FROM joueurs";
$stmt = $conn->prepare($sql);
try {
  $stmt->execute();
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action=<?php echo basename(__FILE__); ?> method="post" enctype="multipart/form-data">
      <div>
        <input type="text" name="nom" value=<?php echo '"'.$nom.'"'; ?> placeholder="Nom">
      </div>
      <div>
        <input type="text" name="pays" value=<?php echo '"'.$pays.'"'; ?> placeholder="Pays">
      </div>
      <div>
        <input type="text" name="ville" value=<?php echo '"'.$ville.'"'; ?>  placeholder="Ville">
        <input type="hidden" name="id" value=<?php echo '"'.$id.'"'; ?>>
      </div>
      <div>
        <input type="submit" name="add" value="Ajouter">
      </div>
    </form>
    <table>
        <?php
        while($row = $stmt->fetch()){ ?>
      <tr>
        <td style="border:1px solid black">
          <a href=<?php echo basename(__FILE__)."?id=".htmlentities($row['id']) ?>><?php echo htmlentities($row['nom']); ?></a>
        </td>
        <td style="border:1px solid black">
          <?php echo htmlentities($row['ville']); ?>
        </td>
        <td style="border:1px solid black">
          <?php echo htmlentities($row['pays']); ?>
        </td>
        <td style="border:1px solid black">
          <a href=<?php echo basename(__FILE__)."?id=".htmlentities($row['id'])."&del=true"?>>Supprimer</a>
        </td>
      </tr>
        <?php
        }
        ?>
    </table>
  </body>
</html>
