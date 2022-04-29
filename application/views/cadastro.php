<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost\App\assets\css\estilo.css">
    <script src="https://kit.fontawesome.com/860c734d0d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 rounded">
            <a class="navbar-brand" href="#">Carros</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Welcome/index') ?>"> <i class="fa-solid fa-house-chimney"></i> Dashboard
                       </a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('Welcome/cadastro') ?>"><i class="fa-solid fa-plus"></i> Cadastrar
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Welcome/lista') ?>"><i class="fa-solid fa-paste"></i> Lista
                    </a>                    
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        </nav>

        <div class="texto">
            <h3>
                Cadastro de veículos
                <small class="text-muted texto">Realize aqui o cadastro</small>
            </h3>
        </div>
    </header>

    <main class="container cadastro">
        <form id="gravarid"  target="contato"  class="container" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                        <label for="marca">Marca</label>
                        <select id="marca_id" name="marca_id" class="form-control" placeholder="Selecione uma marca">
                        <!-- <option value="" disabled selected>Selecione a marca</option>               -->
                            <option>
                                <?php foreach($marcas as $marca): ?>
                                    <option value="<?= $marca['id']?>"><?= $marca['descricao']?> </option>
                                <?php endforeach; ?>
                            </option>
                        </select>
                    </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Modelo</label>
                    <input type="text" class="form-control" name="modelo" id="inputPassword4" placeholder="Ex: Cruze, Onix">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCity">Ano</label>
                    <input type="text" name="ano" class="form-control" id="inputCity" placeholder="1999">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEstado">Cor</label>
                    <select id="inputEstado" name="cor" class="form-control">
                        <option selected>Escolher...</option>
                        <option>Vermelho</option>
                        <option>Verde</option>
                        <option>Azul</option>
                        <option>Prata</option>
                        <option>Branco</option>
                        <option>Preto</option>
                    </select>
                </div>
            </div>

            <button type="button" onclick="gravar()" class="btn btn-success"> 
            <i class="fa-solid fa-circle-check"></i> Gravar</button>
        </form>

        <script>
            function gravar() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url("Welcome/gravar") ?>",
                    data: $('#gravarid').serialize(),
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Dados gravados com sucesso!',
                            footer: '<a href="lista">Clique para ver os registros</a>',
                            confirmButtonColor: "#28a745"
                        })
                    },
                    error: function(data) {}
                });
            }
        </script>


        <iframe style="display:none;" name="contato" src="cadastro.php"></iframe>
    </main>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>