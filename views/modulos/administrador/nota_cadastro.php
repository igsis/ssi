<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/NotaController.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->recuperaChamado($id);
$funcionario = $chamadoObj->listaFuncionarioChamado($id);

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
            <?php if ($chamado->status_id != 3): ?>
                <div class="col-sm-2">
                    <p class="text-sm-right">Alterar status para:</p>
                </div>
                <?php if ($chamado->status_id == 1): ?>
                <div class="col-sm-2 float-right">
                    <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="update">
                        <input type="hidden" name="_method" value="editar">
                        <input type="hidden" name="id" value="<?= $chamadoObj->encryption($chamado->id) ?>">
                        <input type="hidden" name="data_progresso" value="<?= date('Y-m-d H:i:s') ?>">
                        <input type="hidden" name="status_id" value="2">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Em andamento</button>
                        <div class="resposta-ajax"></div>
                    </form>
                </div>
                <?php else: ?>
                <div class="col-sm-2 float-right">
                    <button class="btn btn-outline-primary btn-sm btn-block" disabled>Andamento em <?= date("d/m/Y", strtotime($chamado->data_progresso)) ?></button>
                </div>
                <?php endif;?>
                <div class="col-sm-2 float-right">
                    <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#alterarStatus">
                        Fechado
                    </button>
                </div>
            <?php endif; ?>
            <!-- /.col -->
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
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal"
                                data-target="#modal-notas">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <?php foreach ($nota as $notas): ?>
                                    <b><?= date('d/m/Y H:i:s', strtotime($notas->data)) . " - " . strstr($notas->nome, ' ', true) ?><?php if ($notas->privada == 1) echo "(Privada)" ?>:</b> <?= $notas->nota ?><br>
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
                        <button type="button" class="btn btn-sm btn-success float-right" onclick="cadastraChFunc()">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <table class="table table-striped">
                                    <?php foreach ($funcionario as $funcionarios): ?>
                                        <tr>
                                            <td><?= $funcionarios->nome ?></td>
                                            <td><?= mb_strimwidth($funcionarios->ferramentas, 0, 60, "...") ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success float-right"
                                                        data-id="<?= $chamadoObj->encryption($funcionarios->id) ?>"
                                                        data-funcionario_id="<?= $funcionarios->funcionario_id ?>"
                                                        data-ferramentas="<?= $funcionarios->ferramentas ?>"
                                                        onclick="editaChFunc(this)">
                                                    <i class="far fa-edit"></i> Editar
                                                </button>
                                            </td>
                                            <td>
                                                <form class="form-horizontal formulario-ajax" method="POST"
                                                      action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form"
                                                      data-form="update">
                                                    <input type="hidden" name="_method" value="excluirFuncionario">
                                                    <input type="hidden" name="id" value="<?= $funcionarios->id ?>">
                                                    <input type="hidden" name="idChamado" value="<?= $chamado->id ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger float-right"><i
                                                                class="fas fa-trash"></i> Excluir
                                                    </button>
                                                    <div class="resposta-ajax"></div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="<?= SERVERURL ?>pdf/ordem_servico.php?id=<?= $chamadoObj->encryption($chamado->id) ?>&chfunc=<?= $chamadoObj->encryption($funcionarios->id) ?>"
                                                   class="btn btn-sm btn-primary float-right" target="_blank"><i
                                                            class="fas fa-print"></i> O.S.</a>
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
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-outline card-green">
                    <div class="card-header">
                        <h3 class="card-title">Solução</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= SERVERURL ?>ajax/chamadoAjax.php" method="post"
                          class="formulario-ajax">
                    <div class="card-body">
                        <div class="row">
                            <?php if ($chamado->status_id == 3) {
                                echo "<p>{$chamado->solucao}</p>";
                            } else {
                                ?>
                                    <input type="hidden" name="_method" value="atualizarSolucao">
                                    <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                                    <input type="hidden" name="data" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="solucao">Solução: *</label>
                                            <textarea name="solucao" id="nota" class="form-control" cols="250" rows="5"
                                                      required><?= $chamado->solucao ?></textarea>
                                        </div>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                        <?php if ($chamado->status_id != 3):?>
                    <div class="card-footer">
                        <button class="btn btn-success btn-sm" type="submit">Gravar</button>
                    </div>
                    <div class="resposta-ajax"></div>
                        <?php endif; ?>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- modal notas -->
<div class="modal fade" id="modal-notas" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/notaAjax.php"
              role="form" data-form="save">
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
        <form class="form-horizontal formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php"
              role="form" data-form="update">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar funcionário no chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" id="method">
                    <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                    <input type="hidden" name="id" id="idChFun">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="funcionario_id">Funcionário: *</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="funcionario_id"
                                        id="funcionario_id">
                                    <option value="">Selecione uma opção...</option>
                                    <?php
                                    $chamadoObj->geraOpcao("funcionarios", '', true);
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

<!-- Modal -->
<div class="modal fade" id="alterarStatus" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Staus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Você deseja alterar o chamado para Fechado?</p>
            </div>
            <div class="modal-footer">
                <form class="formulario-ajax" action="<?= SERVERURL ?>ajax/chamadoAjax.php" method="post">
                    <input type="hidden" name="_method" value="atualizarStatus">
                    <input type="hidden" name="status_id" value="<?= $chamado->status_id + 1 ?>">
                    <input type="hidden" name="chamado_id" value="<?= $chamado->id ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <div class="resposta-ajax"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal Status -->

<script type="text/javascript">
    function cadastraChFunc() {
        let modal = $('#modal-funcionarios');
        let method = modal.find('#method');
        let titulo = modal.find('.modal-title');

        method.val('cadastrarFuncionario');
        titulo.text('Adicionar funcionário ao chamado')
        modal.find('#funcionario_id').val('').trigger('change')
        modal.find('#ferramentas').text('');
        modal.modal('show');
    }

    function editaChFunc(e) {
        let modal = $('#modal-funcionarios');
        let method = modal.find('#method');
        let titulo = modal.find('.modal-title');
        let id = $(e).data('id');
        let funcionario_id = $(e).data('funcionario_id');
        let ferramentas = $(e).data('ferramentas');

        method.val('editarFuncionario');
        titulo.text('Editar funcionário do chamado');
        modal.find('#idChFun').val(id);
        modal.find('#funcionario_id').val(funcionario_id).trigger('change')
        modal.find('#ferramentas').text(ferramentas);
        modal.modal('show');
    }
</script>