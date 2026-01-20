<?php
header("Content-Type: application/json; charset=UTF-8");

$connection = new mysqli("localhost", "root", "", "magazin_saw");

if ($connection->connect_errno) {
    echo json_encode(["error" => 1, "text" => "Eroare conexiune: " . $connection->connect_error]);
    exit();
}

if (isset($_GET["read"])) {
    $items = $connection->query("SELECT * FROM produse_petshop ORDER BY id ASC");
    $produse = [];
    if($items) {
        while ($row = $items->fetch_assoc()) {
            $row['sursa'] = 'DATABASE'; 
            $produse[] = $row;
        }
        echo json_encode(["items" => $produse]);
    } else {
        echo json_encode(["error" => 2, "text" => "Eroare la interogare"]);
    }
}

else if (isset($_GET["id"])) {
    $id_cautat = $_GET["id"];

    $stmt = $connection->prepare("SELECT * FROM produse_petshop WHERE id = ?");
    
    $stmt->bind_param("i", $id_cautat);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $produs = $result->fetch_assoc();

    if ($produs) {
        echo json_encode($produs);
    } else {
        echo json_encode(["error" => 3, "text" => "Produsul nu a fost găsit."]);
    }
    $stmt->close();
}

else if (isset($_GET["create"])) {
    $nume = $_GET["nume"] ?? 'fara_nume';
    $categorie = $_GET["categorie"] ?? 'fara_categorie';
    $pret = $_GET["pret"] ?? 0;
    $imagine = $_GET["imagine"] ?? '';
    $c1 = $_GET["c1"] ?? '';
    $c2 = $_GET["c2"] ?? '';
    $c3 = $_GET["c3"] ?? '';
    $c4 = $_GET["c4"] ?? '';
    $c5 = $_GET["c5"] ?? '';

    $stmt = $connection->prepare("INSERT INTO produse_petshop (nume, categorie, pret, imagine, c1, c2, c3, c4, c5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssissssss", $nume, $categorie, $pret, $imagine, $c1, $c2, $c3, $c4, $c5);
    
    if ($stmt->execute()) {
        echo json_encode(["error" => 0, "text" => "Produsul $nume a fost adăugat cu succes!"]);
    } else {
        echo json_encode(["error" => 1, "text" => "Eroare SQL: " . $connection->error]);
    }
    $stmt->close();
}

$connection->close();
?>