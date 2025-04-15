<?php
// db.php
$host = "sql209.infinityfree.com";
$dbname = "if0_38745770_ges_the";
$user = "if0_38745770";
$pass = "6viJQt2CfPh6";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>