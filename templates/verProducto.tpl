{include 'templates/header.tpl'}

<div class='card'>
    <div class='card-header'>
        <span> <b>{$titulo}</b></span>
    </div>
    <div class='card-body'>
        <table class='table'>
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
    <div class='card-footer'>
        <span> <a class='btn btn-outline-secondary' href='{$hrefVolver}'> Volver </a> </span>
    </div>

</div>

{include 'templates/footer.tpl'}