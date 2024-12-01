<?php
//include 'db.php';
include 'get_products.php'; // Esto incluirá la variable $productos con los datos

/*
 // URL de la API
  $url = 'http://localhost/Proyectos/api/get_products.php'; 
  // Recuperar el JSON desde la API 
  $json = file_get_contents($url); 
  // Decodificar el JSON en un array de PHP 
  $productos = json_decode($json, true);?>

*/


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Foto</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $productosArray = json_decode($productosJson, true);
            if (!empty($productosArray)):
             ?>
                <?php foreach ($productosArray as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                        <td><?php echo htmlspecialchars($producto['marca_producto']); ?></td>
                        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($producto['foto_producto']); ?>" alt="<?php echo htmlspecialchars($producto['marca_producto']); ?>" width="50"></td>
                        <td><?php echo htmlspecialchars($producto['id_categoria']); ?></td>
                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
