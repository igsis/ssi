<?php
require_once "./controllers/AdministradorController.php";
$administradorObj = new AdministradorController();

$usuarios = $administradorObj->listaUsuarios();
$admins = $administradorObj->listaAdmins();
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Administradores</h1>
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
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal" data-target="#adicionar-adm">
                                Adicionar Administrador
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th width="15%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admins as $admin): ?>
                                    <tr>
                                        <td><?=$admin->nome?></td>
                                        <td><?=$admin->email?></td>
                                        <td><?=$admin->telefone?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm bg-gradient-danger">
                                                Remover Administrador
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th width="15%">Ações</th>
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
            <div class="modal-header">
                <h4 class="modal-title">Adicionar novo Administrador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" name="novoAdm" id="novoAdm">
                    <option value="">Selecione...</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?=$usuario->id?>"><?=$usuario->nome?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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