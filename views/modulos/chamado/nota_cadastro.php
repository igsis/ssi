<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/NotaController.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->recuperaChamado($id);

$notaObj = new NotaController();
$nota = $notaObj->listaNota($id);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chamado nº <?= $chamado->id ?></h1>
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
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Dados</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <b>Status:</b> <?= $chamado->status ?? null ?>
                            </div>
                            <div class="col-md">
                                <b>Data abertura:</b> <?= date('d/m/Y', strtotime($chamado->data_abertura)) ?>
                            </div>
                            <div class="col-md">
                                <b>Categoria:</b> <?= $chamado->categoria ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <b>Local:</b> <?= $chamado->nome ?>
                            </div>
                            <div class="col-md">
                                <b>Telefone:</b> <?= $chamado->telefone ?>
                            </div>
                            <div class="col-md">
                                <b>Email:</b> <?= $chamado->email ?>
                            </div>
                            <div class="col-md">
                                <b>Contato:</b> <?= $chamado->contato ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <b>Descrição:</b> <?= $chamado->descricao ?>
                            </div>
                        </div>
                        <?php if ($nota): ?>
                            <div class="row">
                                <div class="col-md">
                                    <b>Notas</b>
                                    <?php foreach ($nota AS $notas): ?>
                                        <p><b><?= date('d/m/Y', strtotime($notas->data)) ?></b> <?= $notas->nota ?></p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-green">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar nota</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="save">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="nota">Nota: *</label>
                                    <textarea name="nota" id="nota" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="resposta-ajax"></div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Gravar</button>
                        </div>
                        <!-- /.card-footer -->
                        <div class="resposta-ajax"></div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->