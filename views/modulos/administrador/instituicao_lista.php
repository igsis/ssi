<?php
require_once "./controllers/InstituicaoController.php";
require_once "./controllers/UsuarioController.php";

$instituicaoObj =  new InstituicaoController();
$usuarioObj =  new UsuarioController();

$instituicoes =  $instituicaoObj->listaInstituicao();
$usuarios = $usuarioObj->listaUsuarios();


?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"></h1>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Administradores</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Instituição</th>
                                <th>Administrador</th>
                                <th width="19%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($instituicoes as $instituicao):
                                        $administrador = $instituicaoObj->recuperaAdministrador($instituicao->id)
                                ?>

                                    <tr>
                                        <td><?= $instituicao->instituicao ?></td>
                                        <td><?= $administrador->nome ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#adicionar-adm">Alterar Administrador</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Instituição</th>
                                <th>Administrador</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<div class="modal fade" id="adicionar-adm" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="formulario-ajax" data-form="save" action="<?= SERVERURL ?>ajax/administradorAjax.php" method="post">
                <input type="hidden" name="_method" value="insereAdmin">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar novo Administrador</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control select2bs4" name="usuario_id" id="novoAdm">
                            <option value="">Selecione...</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= $administradorObj->encryption($usuario->id) ?>"><?= $usuario->nome ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <div class="resposta-ajax"></div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="application/javascript">
    $(document).ready(function () {
        $('.nav-link').removeClass('active');
        $('#chamado_inicio').addClass('active');
    })
</script>