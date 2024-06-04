<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda_online";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModaPerfecta.com</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function agregarAlCarrito(nombreProducto) {
            alert("¡" + nombreProducto + " se ha añadido al carrito!");
        }

        function actualizarStock(producto, nuevaCantidad) {
            const filas = document.querySelectorAll('#stock-table tbody tr');
            for (let fila of filas) {
                if (fila.cells[0].innerText === producto) {
                    fila.cells[3].innerText = nuevaCantidad;
                    break;
                }
            }
        }

        function actualizarStockForm() {
            const producto = document.getElementById('producto').value;
            const cantidad = document.getElementById('cantidad').value;
            actualizarStock(producto, cantidad);
            alert("Stock actualizado para " + producto + " a " + cantidad + " unidades.");
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">ModaPerfecta.com</div>
        <nav>
            <ul>
                <li><a href="#">Hombres</a></li>
                <li><a href="#">Mujeres</a></li>
                <li><a href="#">Niños</a></li>
                <li><a href="#">Accesorios</a></li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Novedades</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a href="#"><img src="ass.png" alt="Carrito"></a>
            <a href="#"><img src="user-icon.png" alt="Usuario"></a>
            <a href="#"><img src="search-icon.png" alt="Buscar"></a>
        </div>
    </header>
    
    <main>
        <aside class="sidebar">
            <h3>Filtrar por:</h3>
            <form>
                <label for="size">Talla:</label>
                <select id="size" name="size">
                    <option value="s">S</option>
                    <option value="m">M</option>
                    <option value="l">L</option>
                </select>
                <label for="color">Color:</label>
                <select id="color" name="color">
                    <option value="red">Rojo</option>
                    <option value="blue">Azul</option>
                    <option value="black">Negro</option>
                </select>
                <label for="price">Precio:</label>
                <select id="price" name="price">
                    <option value="low-high">De menor a mayor</option>
                    <option value="high-low">De mayor a menor</option>
                </select>
                <button type="submit">Aplicar</button>
            </form>
        </aside>
        <div class="content">
            <div class="banner">
                <img src="promo1.jpg" alt="Promoción 1">
                <img src="promo2.jpg" alt="Promoción 2">
            </div>
            <section class="featured-products">
                <h2>Productos Destacados</h2>
                <div class="product-grid">
                    <!-- Producto 1 -->
                    <div class="product">
                        <img src="product1.jpg" alt="Producto 1">
                        <h3>Vestido Floral</h3>
                        <p class="price">$49.99</p>
                        <button onclick="agregarAlCarrito('Vestido Floral')">Añadir al carrito</button>
                    </div>
                    <!-- Producto 2 -->
                    <div class="product">
                        <img src="product2.jpg" alt="Producto 2">
                        <h3>Camisa de Mezclilla</h3>
                        <p class="price">$29.99</p>
                        <button onclick="agregarAlCarrito('Camisa de Mezclilla')">Añadir al carrito</button>
                    </div>
                    <!-- Producto 3 -->
                    <div class="product">
                        <img src="product3.jpg" alt="Producto 3">
                        <h3>Zapatillas Deportivas</h3>
                        <p class="price">$59.99</p>
                        <button onclick="agregarAlCarrito('Zapatillas Deportivas')">Añadir al carrito</button>
                    </div>
                </div>
            </section>
            <section class="stock-section">
                <h2>Stock de Productos</h2>
                <table id="stock-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad en Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['nombre_producto']; ?></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form onsubmit="actualizarStockForm(); return false;">
                    <label for="producto">Producto:</label>
                    <select id="producto" name="producto">
                        <?php foreach($productos as $producto): ?>
                        <option value="<?php echo $producto['nombre_producto']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" min="0">
                    <button type="submit">Actualizar Stock</button>
                </form>
            </section>
            <section class="popular-categories">
                <h2>Categorías Populares</h2>
                <div class="categories-grid">
                    <!-- Categorías -->
                </div>
            </section>
        </div>
    </main>
    
    <footer>
        <div class="quick-links">
            <a href="#">Política de Devoluciones</a>
            <a href="#">Contacto</a>
            <a href="#">Ubicaciones de Tiendas</a>
            <a href="#">Suscripción a Newsletter</a>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/ModaPerfecta"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/ModaPerfecta"><img src="instagram-icon.png" alt="Instagram"></a>
            <a href="https://twitter.com/ModaPerfecta"><img src="twitter-icon.png" alt="Twitter"></a>
        </div>
    </footer>
</body>
</html>