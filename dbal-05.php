<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$yaml = Yaml::parse(file_get_contents('db.yml'));

$config = new \Doctrine\DBAL\Configuration();
//..
$connectionParams = array(
    'dbname' => $yaml['db']['name'],
    'user' => $yaml['db']['user'],
    'password' => $yaml['db']['password'],
    'host' => $yaml['db']['server'],
    'driver' => $yaml['db']['driver'],
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);


$id= 1;
$nom="Aziz";
$sql = "SELECT * FROM joueurs WHERE id = :id or nom = :nom";
$stmt = $conn->prepare($sql);
$stmt->bindValue("id", $id);
$stmt->bindValue("nom", $nom);
$stmt->execute();

while ($row = $stmt->fetch()) {
  echo $row['id']. ' ' . $row['nom']. "<br />\n";
}


$sql = "SELECT * FROM joueurs";
$stmt = $conn->fetchAll($sql);

foreach ($stmt as $value) {
  echo $value['id']. " " .$value['nom']."<br />\n";
}
