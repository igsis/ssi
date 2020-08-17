<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/UsuarioController.php";

$id = !empty($_GET['id']) ? $_GET['id'] : false;

$chamadoObj = new ChamadoController();
$chamado = $chamadoObj->recuperaChamado($id);

$usuarioObj = new UsuarioController();
$usuario = $usuarioObj->recuperaUsuario($_SESSION['usuario_id_s'])->fetchObject();
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cadastro de chamado</h1>
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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Dados</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="<?= ($id) ? "update" : "save" ?>">
                        <input type="hidden" name="_method" value="<?= ($id) ? "editar" : "cadastrar" ?>">
                        <input type="hidden" name="usuario_id" value="<?= $usuario->id ?>">
<!--                        <input type="hidden" name="administrador_id" value="--><?//= $usuario->administrador_id ?><!--">-->
                        <input type="hidden" name="prioridade_id" value="1">
                        <input type="hidden" name="local_id" value="<?= $usuario->local_id ?>">
                        <?php if (!$id): ?>
                            <input type="hidden" name="data_abertura" value="<?= date('Y-m-d H:i:s') ?>">
                        <?php endif; ?>
                        <?php if ($id): ?>
                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="telefone">Telefone: *</label>
                                    <input type="text" id="telefone" name="telefone" onkeyup="mascara( this, mtel );"  class="form-control" placeholder="Digite o telefone" required value="<?= $usuario->telefones ?? "" ?>" maxlength="15">
                                </div>
                                <div class="form-group col-md">
                                    <label for="email">E-mail: *</label>
                                    <input type="email" id="email" name="email" class="form-control" maxlength="120" placeholder="Digite o E-mail" value="<?= $usuario->email ?? '' ?>" required>
                                </div>
                                <div class="form-group col-md">
                                    <label for="contato">Contato: *</label>
                                    <input type="text" id="contato" name="contato" class="form-control" maxlength="120" placeholder="Digite o E-mail" value="<?= $usuario->contato ?? '' ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Categorias: *</label>
                                        <select class="form-control select2bs4" style="width: 100%;">
                                            <option value="">Selecione uma opção...</option>
                                            <?php
                                            $chamadoObj->geraOpcao("categorias");
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="descricao">Descrição: *</label>
                                        <textarea name="descricao" id="descricao" class="form-control" rows="3" required><?= ($chamado) ? $chamado->descricao : ""?></textarea>
                                    </div>
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