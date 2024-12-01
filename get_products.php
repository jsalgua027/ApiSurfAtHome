<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: text/html; charset=utf-8');

include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
     http_response_code(200);
      exit(); 
    }

// Manejar diferentes métodos HTTP
switch($method) {
    case 'GET':
        if (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            $query = 'SELECT * FROM producto WHERE id_categoria = :categoria';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        } else {
            $query = 'SELECT * FROM producto';
            $stmt = $conn->prepare($query);
        }
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $productosJson = json_encode($productos);
        $productosArray = json_decode($productosJson, true);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $query = 'INSERT INTO producto (marca_producto, precio, foto_producto, id_categoria, stock, descripcion) VALUES (:marca_producto, :precio, :foto_producto, :id_categoria, :stock, :descripcion)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':marca_producto', $data['marca_producto']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':foto_producto', $data['foto_producto']);
        $stmt->bindParam(':id_categoria', $data['id_categoria']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->execute();
        echo json_encode(['message' => 'Producto agregado exitosamente']);
        exit();

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $query = 'UPDATE producto SET marca_producto = :marca_producto, precio = :precio, foto_producto = :foto_producto, id_categoria = :id_categoria, stock = :stock, descripcion = :descripcion WHERE id_producto = :id_producto';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':marca_producto', $data['marca_producto']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':foto_producto', $data['foto_producto']);
        $stmt->bindParam(':id_categoria', $data['id_categoria']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':id_producto', $data['id_producto']);
        $stmt->execute();
        echo json_encode(['message' => 'Producto actualizado exitosamente']);
        exit();

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $query = 'DELETE FROM producto WHERE id_producto = :id_producto';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_producto', $data['id_producto']);
        $stmt->execute();
        echo json_encode(['message' => 'Producto eliminado exitosamente']);
        exit();
}
?>
