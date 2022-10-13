{include 'templates/header.tpl'}

<!-- formulario de alta de producto -->
<form action="agregarProducto" method="POST" class="my-4" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class='card-header'>
                    <span> <b>Agregar Producto</b></span>
                </div>
                <input placeholder="Nombre producto" name="nombre" type="text" class="form-control" required>
                <input placeholder="Nombre marca" name="marca" type="text" class="form-control" required>
                <input placeholder="Precio producto" name="precio" type="number" class="form-control" required>
                <select name="idCategoria" class="form-control">
                    {foreach from=$listadoCategorias item=$item}
                        <option value="{$item->id}">{$item->nombre}</option>
                    {/foreach} 
                </select>
                <input class="form-control" type="file" name="input_name" id="imageToUpload">
                </div>
        </div>
    </div>


        <button type="submit" class='btn btn-secondary'>Guardar</button>
        <span> <a class='btn btn btn-danger' href="./home"> Cancelar </a> </span>


</form>


{include 'templates/footer.tpl'}