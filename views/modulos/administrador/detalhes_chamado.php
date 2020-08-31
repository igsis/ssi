<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/NotaController.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->recuperaChamado($id);
$responsavel = $chamadoObj->recuperaChamadoFuncionario($id);

$notaObj = new NotaController();
$nota = $notaObj->listaNota($id);

?>
<?= $responsavel ?>

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
            <div class="col-12 col-md-6 col-sm-12">
                <!-- Horizontal Form -->
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Dados</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <p>
                            <b>Status:</b> <?= $chamado->status ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Data abertura:</b> <?= date('d/m/Y', strtotime($chamado->data_abertura)) ?>
                        </p>
                        <p>
                            <b>Categoria:</b> <?= $chamado->categoria ?>
                        </p>
                        <p>
                            <b>Local:</b> <?= $chamado->local ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Telefone:</b> <?= $chamado->telefone ?>
                        </p>

                        <p>
                            <b>Email:</b> <?= $chamado->email ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Contato:</b> <?= $chamado->contato ?>
                        </p>
                        <p>
                            <b>Descrição:</b> <?= $chamado->descricao ?>
                        </p>
                        <?php if ($nota): ?>
                            <p>
                            <b>Notas:</b>
                            <?php foreach ($nota as $notas): ?>
                                <p>
                                    <b><?= date('d/m/Y H:i:s', strtotime($notas->data)) ?></b> <?= $notas->nota ?>
                                </p>
                            <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-md-6 col-sm-12">
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Ações</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="prioridade_id">Prioridade:</label>
                                    <select class="form-control" name="prioridade_id">
                                        <?php
                                        $chamadoObj->geraOpcao('prioridades', $chamado->prioridade_id)
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="prioridade_id">Responsavel:</label>
                                    <select class="form-control" name="prioridade_id">
                                        <?php
                                        $chamadoObj->geraOpcao('funcionarios', '', true)
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-left" type="button"> Alterar Status</button>
                            <button class="btn btn-success float-right" type="submit"> Atualizar</button>
                        </div>
                    </form>
                </div>
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
                    <form class="form-horizontal formulario-ajax" method="POST"
                          action="<?= SERVERURL ?>ajax/notaAjax.php" role="form" data-form="save">
                        <input type="hidden" name="_method" value="cadastrar">
                        <input type="hidden" name="pagina" value="chamado">
                        <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                        <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario_id_s'] ?>">
                        <input type="hidden" name="privada" value="0">
                        <input type="hidden" name="data" value="<?= date('Y-m-d H:i:s') ?>">
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