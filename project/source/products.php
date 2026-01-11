<?php
header("Content-Type: application/json; charset=UTF-8");
$connection = new mysqli("localhost", "root", "", "magazin_saw");

if ($connection->connect_errno) {
    echo json_encode(["error" => 1, "text" => "Eroare: " . $connection->connect_error]);
    exit();
}

if (isset($_GET["read"])) {
    $items = $connection->query("SELECT * FROM produse_petshop ORDER BY id ASC");
    $produse = [];
    while ($row = $items->fetch_assoc()) {
        $produse[] = $row;
    }
    echo json_encode(["items" => $produse]);
}
$connection->close();
?>