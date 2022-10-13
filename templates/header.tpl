<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{BASE_URL}">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Tienda</title>
</head>
<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="">Tienda</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
              <li class="nav-item">
                <a class="nav-link" href="verCategorias">Categorias</a>
              </li>
              {if !isset($smarty.session.USER_ID)}
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="ingresar">Ingresar</a>
                </li>
              {else} 
                <li class="nav-item ml-auto">
                  <a class="nav-link" aria-current="page" href="salir">Salir ({$smarty.session.USER_EMAIL})</a>
                </li>
              {/if}
          </div>
        </div>
      </nav>
    </header>

    <!-- inicio main container -->
    <main class="container">
