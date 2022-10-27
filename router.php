<?php

require_once './app/controllers/producto.controller.php';
require_once './app/controllers/categoria.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // acción por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// tabla de ruteo
switch ($params[0]) {
    case 'home':
        $controllerProducto = new ProductoController();
        $esHome = 1; // si es home muestro el boton agregar producto
        $controllerProducto->verProductos($esHome);
        break;
    case 'verProducto':
        $controllerProducto = new ProductoController();
        $id_producto = $params[1];
        $esHome = $params[2];
        $controllerProducto->verProducto($id_producto, $esHome);
        break;
    case 'verCategorias':
        $esHome = 1;
        $controllerCategoria = new CategoriaController();
        $controllerCategoria->verCategorias($esHome);
        break;
    case 'verProductosPorCategoria':
        $controllerProducto = new ProductoController();
        $controllerCategoria = new CategoriaController();
        
        $categoria = $controllerCategoria->getCategoriaById($params[1]);
        $controllerProducto->verProductosPorCategoria($categoria);
        break;
    case 'verFormAgregarCategoria':
        $controllerCategoria = new CategoriaController();
        $controllerCategoria->verFormAgregarCategoria();
        break;
    case 'verFormEditarCategoria':
        $controllerCategoria = new CategoriaController();
        $id_categoria = $params[1];
        $controllerCategoria->verFormEditarCategoria($id_categoria);
        break;
    case 'verFormAgregarProducto':
        $controllerProducto = new ProductoController();
        $controllerCategoria = new CategoriaController();
        $categorias = $controllerCategoria->getCategorias();
        $controllerProducto->verFormAgregarProducto($categorias);
        break;
    case 'verFormEditarProducto':
        $controllerProducto = new ProductoController();
        $controllerCategoria = new CategoriaController();
        $id_producto = $params[1];
        $categorias = $controllerCategoria->getCategorias();
        $controllerProducto->verFormEditarProducto($categorias, $id_producto);
        break;
    case 'agregarProducto':
        $controllerProducto = new ProductoController();
        $controllerCategoria = new CategoriaController();
        $categorias = $controllerCategoria->getCategorias();
        $controllerProducto->agregarProducto($categorias);
        break;
    case 'editarProducto':
        $controllerProducto = new ProductoController();
        $controllerCategoria = new CategoriaController();
        $id_producto = $params[1];
     //   $esHome = $params[2];
        $categorias = $controllerCategoria->getCategorias();
        $controllerProducto->editarProducto($id_producto, $categorias);
        break;
    case 'eliminarProducto':
        $controllerProducto = new ProductoController();
        $id_producto = $params[1];
        $esHome = $params[2];
        $controllerProducto->eliminarProducto($id_producto, $esHome);
        break;
    case 'agregarCategoria':
        $controllerCategoria = new CategoriaController();
        $controllerCategoria->agregarCategoria();
        break;
    case 'eliminarCategoria':
        $id_categoria = $params[1];
        $controllerCategoria = new CategoriaController();
        $controllerCategoria->eliminarCategoria($id_categoria);
        break;
    case 'editarCategoria':
        $controllerCategoria = new CategoriaController();
        $id_categoria = $params[1];
        $controllerCategoria->editarCategoria($id_categoria);
        break;
    case 'ingresar':
        $authController = new AuthController();
        $authController->verFormIngresar();
        break;
    case 'validarUsuario':
        $authController = new AuthController();
        $authController->validarUsuario();
        break;
    case 'salir':
        $authController = new AuthController();
        $authController->salir();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        break;
}
