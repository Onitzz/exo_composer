<?php

require 'doctrine-dbal-connect.php';
$nom = "Aziz";
$sql = "SELECT * FROM joueurs WHERE nom = :nom";
$stmt = $conn->prepare($sql);
$stmt->bindValue("nom",$nom);
try {
  $stmt->execute();
}
catch (Exception $e) {
  echo $e->getMessage()."\n";
  exit();
}

while ($row = $stmt->fetch()) {
  echo $row['id']. ' ' . $row['nom']. "<br />\n";
}
//echo "<pre>";
//var_dump($conn);
//echo "</pre>";



/* insert
$conn->insert('joueurs', array('nom' => 'jwage'));
*/

/* select
$sql = "SELECT * FROM joueurs";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

while ($row = $stmt->fetch()) {
  echo $row['id']. ' ' . $row['nom']. "<br />\n";
}
*/
/* update
$conn->update('joueur', array('nom'=>'foo bar'),array('id'=>1));
*/
/* delete
$conn->delete('joueurs', array('id' => 7));
*/
