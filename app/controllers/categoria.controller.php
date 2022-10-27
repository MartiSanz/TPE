<?php

include_once './app/models/categoria.model.php';
include_once './app/views/categoria.view.php';
require_once './app/helpers/auth.helper.php';

class CategoriaController{
    private $model;
    private $view;
    private $authHelper;

    public function __construct(){
        $this->view = new CategoriaView();
        $this->model = new CategoriaModel();
    }

    //imprime la lista de categorias
    function verCategorias($esHome) {  
        // BARRRERA DE SEGURIDAD - verifica que el usuario este logueado  
        $this->authHelper = new AuthHelper();
        $seLogueo = 0;
        $seLogueo = $this->authHelper->checkLoggedIn(); 
        
        //obtiene los categorias del modelo
        $categorias = $this->model->getAll();

        //actualiza la vista
        $this->view->verCategorias($categorias, $esHome, $seLogueo);
    }

    //retorna la lista de categorias
    function getCategorias() {    
        
        //obtiene los categorias del modelo
        $categorias = $this->model->getAll();

        //actualiza la vista
        return $categorias;
    }

    function verFormAgregarCategoria() {   
        //actualiza la vista
        $this->view->verFormAgregarCategoria();
    }

    function getCategoriaById($id_categoria){
        return $this->model->getCategoriaById($id_categoria);
    }

    function verFormEditarCategoria($id_categoria) {   
        //actualiza la vista
        $categoria = $this->model->getCategoriaById($id_categoria);

        $this->view->verFormEditarCategoria($categoria);
    }

    // inserta una categoria
    function agregarCategoria(){
        if (!empty($_POST['nombre'])) {
            $nombreCategoria = $_POST['nombre'];
        
            $id = $this->model->insertar($nombreCategoria);

            header('Location: ' .BASE_URL. 'verCategorias');
        }
        else{
            $error = "Ingrese todos los datos";
            $this->view->verFormAgregarCategoria($error);
        }
    }

    // elimina una categoria
    function eliminarCategoria($id){
        $this->model->eliminarCategoriaById($id);

        header('Location: ' .BASE_URL. 'verCategorias');
    }

    // edita una categoria
    function editarCategoria($id){
        if (!empty($_POST['nombre'])) {
            $nombreCategoria = $_POST['nombre'];
        
            $id = $this->model->editarCategoria($id, $nombreCategoria);

            header('Location: ' .BASE_URL. 'verCategorias');
        }
        else{
            $categoria = $this->model->getCategoriaById($id);
            $error = "Ingrese todos los datos";
            $this->view->verFormEditarCategoria($categoria, $error);
        }
    }

    

}