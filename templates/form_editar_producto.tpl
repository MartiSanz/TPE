{include 'templates/header.tpl'}

<!-- formulario de edicion de producto -->

<div class='card'>
    <div class='card-header'>
        <span class="fs-4 text"> <b>Editar Producto:</b> {$producto->productoNombre}</span>
    </div>
    <div class='card-body'>
        <table class='table text-center'>
            <thead>
                <tr>
                    <th scope='col'>{$tituloCol1}</th>
                    <th scope='col'>{$tituloCol2}</th>
                    <th scope='col'>{$tituloCol3}</th>
                    <th scope='col'>{$tituloCol4}</th>
                    {if isset($producto->imagen)}
                        <th class="col-sm-2" scope='col'>{$tituloCol5}</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                <tr class="col-sm-2">
                    <td>{$producto->productoNombre}</td>
                    <td>{$producto->marca}</td>
                    <td>${$producto->precio}</td>
                    <td>{$producto->categoriaNombre}</td>
                    {if isset($producto->imagen)}
                        <td><img class="img-fluid" src="{$producto->imagen}"/></td>
                    {/if}
                
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class='card'>
    <div class='card-header'></div>

    <div class='card-body'>
        <form action="editarProducto/{$producto->id}" method="POST" class="my-4" enctype="multipart/form-data">
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>{$tituloCol1} nuevo</th>
                        <th scope='col'>{$tituloCol2} nueva</th>
                        <th scope='col'>{$tituloCol3} nuevo</th>
                        <th scope='col'>{$tituloCol4} nueva</th>
                        {if isset($producto->imagen)}
                            <th scope='col'>{$tituloCol5} nueva</th>
                        {/if}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input placeholder="Nombre nuevo" name="nombre" type="text" class="form-control" required></td>
                        <td><input placeholder="Nombre marca nuevo" name="marca" type="text" class="form-control" required></td>
                        <td><input placeholder="Precio nuevo" name="precio" type="number" class="form-control" required></td>
                        <td><select name="idCategoria" class="form-select">
                            {foreach from=$listadoCategorias item=$item}
                                <option value="{$item->id}">{$item->nombre}</option>
                            {/foreach} 
                        </select></td>
                        <td><input class="form-control" type="file" name="input_name" id="imageToUpload"></td>
                    </tr>
                </tbody>
              
            </table>
            
            <div class='card-footer'>
                <button type="submit" class='btn btn-secondary'>Editar Producto</button>
                <span> <a class='btn btn btn-danger' href="./home"> Cancelar </a> </span>
            </div>
        </form>
    </div>
</div>


{include 'templates/footer.tpl'}