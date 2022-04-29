<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost\App\assets\css\estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                    <a class="nav-link" href="<?php echo site_url('Welcome/index') ?>"> <i class="fa-solid fa-house-chimney"></i> Dashboard</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link" href="<?php echo site_url('Welcome/cadastro') ?>"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('Welcome/lista') ?>"><i class="fa-solid fa-paste"></i> Lista</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        </nav>
        <div class="texto2">
        <h3>
            Listagem de cadastro
            <small class="text-muted texto">Faça aqui a consulta dos registros cadastrados</small>
        </h3>
    </div>
</header>
    <main class="container">
        <p class="">
            <?php 
            if (isset($contagem)) {
                    echo "Filtro <strong> " . $filtro['modelo'] . " </strong> retornou $contagem resultado(s).";
                }?>
        </p>
        <table class="table table-hover cadastro3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($resultado as $list) { ?>
                    <tr>
                        <th scope="row"><?= $list['veiculo_id'] ?></th>
                        <td><?= $list['descricao'] ?></td>
                        <td><?= $list['modelo'] ?></td>
                        <td><?= $list['cor'] ?></td>
                        <td><?= $list['ano'] ?></td>
                        <td>
                        <a type="button" href="<?php echo site_url("Welcome/edit/").$list['veiculo_id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pencil"></i>
                        </a>
                            <button onclick="deletar(<?= $list['veiculo_id'] ?>)" type="button" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                <?php } ?>
            </tbody>
        </table>

        <script>
            function deletar(id) {
                Swal.fire({
                    title: 'Deseja realmante excluir esse registro?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Sim, excluir',
                    denyButtonText: 'Não',
                    confirmButtonColor: "#28a745", 
                    footer: "Observação: Esta ação não pode ser desfeita.",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url("Welcome/deletar") ?>",
                            data: {  id: id},
                            dataType: 'json',
                            success: function(data) {
                                if (data.error == 0) {
                                    Swal.fire({
                                        title: 'Sucesso!',
                                        text: 'Dados gravados com sucesso!',
                                        type:'success',
                                    }).then((result)=>{
                                        location.reload();
                                    });              
                                } else {
                                    Swal.fire(data.msg_error, '', 'success');
                                }
                            },
                            error: function(data) {
                                Swal.fire(data.msg, 'success')
                            }
                        });
                        
                    } else if (result.isDenied) {
                        Swal.fire('Nenhuma alteração foi feita.', '', 'info')
                    }
                })
            }
        </script>
    </main>

    <script type="text/javascript" src="<?= base_url() ?>assets/js/functions.js"></script>
    <iframe style="display:none;" name="contato" src="lista.php"></iframe>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>