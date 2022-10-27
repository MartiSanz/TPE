<?php

include_once './app/models/producto.model.php';
include_once './app/views/producto.view.php';
require_once './app/helpers/auth.helper.php';

class ProductoController{
    private $model;
    private $view;
    private $authHelper;

    public function __construct(){
        $this->view = new ProductoView();
        $this->model = new ProductoModel();
        
        $this->authHelper = new AuthHelper();
    }

    //imprime la lista de productos
    function verProductos($esHome) {    
        session_start();
        //obtiene los productos del modelo
        $productos = $this->model->getAll();

        //asigno titulo
        $titulo = 'LISTADO DE PRODUCTOS';
        //actualiza la vista
        $this->view->verProductos($productos, $esHome, $titulo);
    }

    //muestra el producto
    function verProducto($id, $esHome) {   
//        session_start();
        $producto = $this->model->getProductoById($id);

        //actualiza la vista
        $this->view->verProducto($producto, $esHome);
    }

    function verProductosPorCategoria($categoria) {   
        session_start();
        $productos = $this->model->getProductoByCategoriaId($categoria->id);
        $esHome = 0;
        $titulo = 'LISTADO DE PRODUCTOS POR CATEGORIA: ' .$categoria->nombre;
        //actualiza la vista
        $this->view->verProductos($productos, $esHome, $titulo);
    }

    // inserta un producto
    function agregarProducto($listadoCategorias){

        if (!empty($_POST['nombre']) && !empty($_POST['marca']) && !empty($_POST['precio']) && !empty($_POST['idCategoria'])) {

            $nombreProducto = $_POST['nombre'];
            $nombreMarca = $_POST['marca'];
            $precio = $_POST['precio'];
            $idCategoria = $_POST['idCategoria'];

            if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png" ) {
                $id = $this->model->insertar($nombreProducto, $nombreMarca, $precio, $idCategoria,  $_FILES['input_name']['tmp_name']);
            }
            else {
                $id = $this->model->insertar($nombreProducto, $nombreMarca, $precio, $idCategoria);
            }

            header('Location: ' .BASE_URL. 'home');
        }
        else{
            $error = "Ingrese todos los datos requeridos";
            $this->view->verFormAgregarProducto($listadoCategorias, $error);
        }
    }

    // edita un producto
    function editarProducto($id_producto, $listadoCategorias){

        if (!empty($_POST['nombre']) && !empty($_POST['marca']) && !empty($_POST['precio']) && !empty($_POST['idCategoria'])) {
            $nombreProducto = $_POST['nombre'];
            $nombreMarca = $_POST['marca'];
            $precio = $_POST['precio'];
            $idCategoria = $_POST['idCategoria'];

            if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" || $_FILES['input_name']['type'] == "image/png" ) {
                $id = $this->model->editarProducto($id_producto, $nombreProducto, $nombreMarca, $precio, $idCategoria, $_FILES['input_name']['tmp_name']);
            }
            else {
                $id = $this->model->editarProducto($id_producto, $nombreProducto, $nombreMarca, $precio, $idCategoria);

            }
            header('Location: ' .BASE_URL. 'home');
        }        
        else{
            $error = "Ingrese todos los datos requeridos";
            $producto = $this->model->getProductoById($id_producto);
            $this->view->verFormEditarProducto($listadoCategorias, $producto, $error);
        }
    }

    // elimina un producto
    function eliminarProducto($id, $esHome){
        $this->authHelper->checkLoggedIn(); 
        $producto = $this->model->getProductoById($id);
        $this->model->eliminarProductoById($id);

        if($esHome){
            header('Location: ' .BASE_URL. 'home');
        }
        else{
            header('Location: ' .BASE_URL. 'verProductosPorCategoria/' .$producto->id_categoria_fk);
        }   
    }

    function verFormAgregarProducto($listadoCategorias) {   
        $this->authHelper->checkLoggedIn(); 
        //actualiza la vista
        $this->view->verFormAgregarProducto($listadoCategorias);
    }

    function verFormEditarProducto($listadoCategorias, $id_producto) {   
        $this->authHelper->checkLoggedIn(); 
        //actualiza la vista
        $producto = $this->model->getProductoById($id_producto);
        $this->view->verFormEditarProducto($listadoCategorias, $producto);
    }
}