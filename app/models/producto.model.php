<?php

class ProductoModel{

    private $db;
    
    public function __construct(){
        $this->db = $this->getDB();
    }

    private function getDB() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_tienda;charset=utf8', 'root', '');
        return $db;
    }
        
    /**
     * Devuelve la lista de productos completa.
     */
    function getAll() {

        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();

        // obtengo los resultados
        $productos = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $productos;
    }

    function getProductoById($id) {

        $query = $this->db->prepare('SELECT p.id, p.nombre as productoNombre, p.marca, p.precio, p.id_categoria_fk, p.imagen, c.nombre as categoriaNombre FROM producto p JOIN categoria c on c.id = p.id_categoria_fk WHERE p.id = ?');
        $query->execute([$id]);

        // obtengo los resultados
        $producto = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos

        return $producto[0];
    }

    function getProductoByCategoriaId($id){

        $query = $this->db->prepare('SELECT * FROM producto WHERE id_categoria_fk = ?');
        $query->execute([$id]);

        // obtengo los resultados
        $productos = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $productos;
    }

    /**
     * Inserta una categoria en la base de datos.
    */
    function insertar($nombreProducto, $nombreMarca, $precio, $idCategoria, $imagen = null){
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);

        $query = $this->db->prepare("INSERT INTO producto (nombre,marca,precio,id_categoria_fk,imagen) VALUES (?,?,?,?,?)");
        $query->execute([$nombreProducto,$nombreMarca,$precio,$idCategoria,$pathImg]);

        return $this->db->lastInsertId(); 
    }

    private function uploadImage($image){
        $target = 'img/producto/' . uniqid() . '.jpg'; // uniqid() le da un nombre unico a la imagen
        move_uploaded_file($image, $target);
        return $target;
    }


    /**
     * elimina un producto en la base de datos.
    */
    function eliminarProductoById($id){
        $query = $this->db->prepare("DELETE FROM producto WHERE id = ?");
        $query->execute([$id]);
    }

    /**
     * edita un producto en la base de datos.
    */
    function editarProducto($id_producto, $nombreProducto, $nombreMarca, $precio, $idCategoria, $imagen = null){
        
        $pathImg = null;
        if ($imagen){
            $pathImg = $this->uploadImage($imagen);
            $query = $this->db->prepare("UPDATE producto SET nombre = ?, marca = ?, precio = ?, id_categoria_fk = ?, imagen = ? WHERE id = ?");
            $query->execute([$nombreProducto, $nombreMarca, $precio, $idCategoria, $pathImg, $id_producto]);
        }
        else{
            $query = $this->db->prepare("UPDATE producto SET nombre = ?, marca = ?, precio = ?, id_categoria_fk = ? WHERE id = ?");
            $query->execute([$nombreProducto, $nombreMarca, $precio, $idCategoria, $id_producto]);
        }
    }
}