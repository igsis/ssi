<?php
require_once "./controllers/ChamadoController.php";

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->listaChamadoUsuario($_SESSION['usuario_id_s']);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lista Chamados</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Dados</h3>
                        <a href="<?= SERVERURL ?>chamado/chamado_cadastro" class="btn btn-success float-right">
                            <i class="fas fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>Chamado nº</td>
                                <td>Local</td>
                                <td>Contato</td>
                                <td>Categoria</td>
                                <td>Descrição</td>
                                <td>Data abertura</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($chamado AS $ch):?>
                            <tr>
                                <td><?= $ch->id ?></td>
                                <td><?= $ch->nome ?></td>
                                <td><?= $ch->contato ?></td>
                                <td><?= $ch->categoria ?></td>
                                <td><?= $ch->descricao ?></td>
                                <td><?= date('d/m/Y', strtotime($ch->data_abertura)) ?></td>
                                <td><?= $ch->status ?></td>
                                <td>
                                    <a href="nota_cadastro&id=<?= MainModel::encryption($ch->id) ?>" class="btn btn-sm bg-primary">
                                        <i class="fas fa-folder-open"></i> Carregar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Chamado nº</td>
                                <td>Local</td>
                                <td>Contato</td>
                                <td>Categoria</td>
                                <td>Descrição</td>
                                <td>Data abertura</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
