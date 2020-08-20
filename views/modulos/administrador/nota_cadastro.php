<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/NotaController.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->recuperaChamado($id);
$funcionario = $chamadoObj->recuperaFuncionarioChamado($id)->fetchAll(PDO::FETCH_OBJ);

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
                                <b>Local:</b> <?= $chamado->local ?>
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
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Notas</h3>
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-notas">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <?php foreach ($nota AS $notas): ?>
                                    <b><?= date('d/m/Y H:i:s', strtotime($notas->data))." - ".strstr($notas->nome,' ', true)?>:</b> <?= $notas->nota ?><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Funcionários</h3>
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-funcionarios">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <table class="table table-striped">
                                <?php foreach ($funcionario AS $funcionarios): ?>
                                    <tr>
                                        <td><?= $funcionarios->nome ?></td>
                                        <td><?= $funcionarios->ferramentas ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-funcionarios"><i class="far fa-edit"></i> Editar</button>
                                        </td>
                                        <td>
                                            <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="update">
                                                <input type="hidden" name="_method" value="excluirFuncionario">
                                                <input type="hidden" name="id" value="<?= $funcionarios->id ?>">
                                                <input type="hidden" name="idChamado" value="<?= $chamado->id ?>">
                                                <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Excluir</button>
                                                <div class="resposta-ajax"></div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="<?= SERVERURL ?>pdf/ordem_servico.php?id=<?= $chamadoObj->encryption($chamado->id) ?>&funcionario=<?= $chamadoObj->encryption($funcionarios->id) ?>" class="btn btn-sm btn-primary float-right" target="_blank"><i class="fas fa-print"></i> Gerar O.S.</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- modal notas -->
<div class="modal fade" id="modal-notas" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/notaAjax.php" role="form" data-form="save">
            <?php if ($funcionario): ?>
                <input type="hidden" name="id" id="id" value="<?= $funcionario->id ?>">
            <?php endif; ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar nota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" value="cadastrar">
                    <input type="hidden" name="pagina" value="administrador">
                    <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                    <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario_id_s'] ?>">
                    <input type="hidden" name="privada" value="0">
                    <input type="hidden" name="data" value="<?= date('Y-m-d H:i:s') ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="nota">Nota: *</label>
                                <textarea name="nota" id="nota" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="row float-right">
                            <div class="form-group col-md">
                                <input class='form-check-input' type='checkbox' name='privada' id="privada" value="1">
                                <label class='form-check-label' for="privada">Privada</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </div>
            <div class="resposta-ajax"></div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal notas -->

<!-- modal funcionarios -->
<div class="modal fade" id="modal-funcionarios" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="<?= ($funcionario) ? "update" : "save" ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar funcionário no chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" value="cadastrarFuncionario">
                    <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="funcionario_id">Funcionário: *</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="funcionario_id" id="funcionario_id">
                                    <option value="">Selecione uma opção...</option>
                                    <?php
                                    $chamadoObj->geraOpcao("funcionarios","",true);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="ferramentas">Materiais / Ferramentas: *</label>
                                <textarea name="ferramentas" id="ferramentas" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </div>
            <div class="resposta-ajax"></div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal funcionarios -->