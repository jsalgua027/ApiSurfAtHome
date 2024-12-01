
<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');
include 'db.php';
// Consulta SQL para obtener todos los productos
$query = 'SELECT * FROM producto';
$stmt = $conn->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Devolver los productos como JSON 
//echo json_encode($productos);

$productosJson = json_encode($productos);
$productosArray = json_decode($productosJson, true);


/*
 llamada desde el servicio

getAllProducts(): Observable<Product[]> {
    return this.http.get<Product[]>(`${environment.apiUrl}get_product.php`).pipe(
        catchError(this.handleError<Product[]>('getAllProducts', []))
    );
}

// Manejo de errores
private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
        console.error(`${operation} failed: ${error.message}`);
        return of(result as T);
    };
}

*/
?>

