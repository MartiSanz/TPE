{include 'templates/header.tpl'}

<div class='card'>
    <div class='card-header'>
        <span class="fs-4 text"> <b>Editar Categoria: </b> {$nombreViejoCategoria}</span>
    </div>

    <div class='card-body'>
        <form action="editarCategoria/{$idCategoria}" method="POST" class="my-4">
        <input value="{$nombreViejoCategoria}" placeholder="Nombre categoria" name="nombre" type="text" class="form-control" required>
            {if $error}
                <div>
                    <span class="text-danger"> {$error} </span>
                </div>
            {/if} 

            <div class='card-footer'>
                <button type="submit" class='btn btn-secondary'>Editar Categoria</button>
                <span> <a class='btn btn btn-danger' href="./verCategorias"> Cancelar </a> </span>
            </div>
        </form>
    </div>
</div>

{include 'templates/footer.tpl'}