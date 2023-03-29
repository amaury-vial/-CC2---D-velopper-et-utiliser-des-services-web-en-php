<?php


$data = null;
try {
    $bd = new PDO('mysql:host=mysql-bonnin-enzo.alwaysdata.net;dbname=bonnin-enzo_service_web_java', '300222_web_java', 'mdp_web_java ');
    // construction du modèle
    $dataAnnonces = new AnnonceSqlAccess($bd);
    $dataUsers = new UserSqlAccess($bd);

} catch (PDOException $e) {
    print "Erreur de connexion !: " . $e->getMessage() . "<br/>";
    die();
}