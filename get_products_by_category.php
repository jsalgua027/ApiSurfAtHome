<?php include 'db.php';

// Verificar si se proporcionó el parámetro de categoría 
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $query = 'SELECT * FROM producto WHERE id_categoria = categoria';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_INT);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //echo json_encode($productos);
   // echo json_decode($json, true); 
   $productosJson = json_encode($productos);
    $productosArray = json_decode($productosJson, true);
} else {
    $productos = [];
    echo 'No se proporcionó una categoría.';
};
