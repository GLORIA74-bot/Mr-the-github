<?php
header("Content-Type: application/json");
$pdo = new PDO("mysql:host=localhost;dbname=ges_the", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE nom LIKE ?");
    $stmt->execute(["%$query%"]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultats);
}
?>