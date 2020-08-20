<?php
require_once "./controllers/LocalController.php";
require_once "./controllers/InstituicaoController.php";

$localObj = new LocalController();

$id = !empty($_GET['id']) ? $_GET['id'] : false;

if ($id) {
    $local = $localObj->recuperaLocal($id)->fetchObject();
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cadastro de local</h1>
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
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="formulario-ajax" method="POST" action="<?= SERVERURL ?>ajax/chamadoAjax.php" role="form" data-form="<?= ($id) ? "update" : "save" ?>">
                        <input type="hidden" name="_method" value="<?= ($id) ? "editaLocal" : "insereLocal" ?>">
                        <?php if ($id): ?>
                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="local">Nome do local: *</label>
                                    <input type="text" class="form-control" id="local" name="local" maxlength="120"
                                           placeholder="Digite o nome do local" value="<?= $local->local ?? '' ?>" required>
                                </div>
                                <div class="form-group col">
                                    <label>Instituição: *</label>
                                    <select name="instituicao_id" class="form-control" required>
                                        <option value="">Selecione...</option>
                                        <?php $localObj->geraOpcao('instituicoes', $local->instituicao_id ?? ''); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="telefone">Telefone: *</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone"
                                           onkeyup="mascara( this, mtel );"  placeholder="Digite o telefone"
                                           value="<?= $usuario->telefone ?? "" ?>" maxlength="15" required>
                                </div>
                                <div class="form-group col">
                                    <label for="contato">Prédio histórico? *</label>
                                    <input type="radio" name="predio_historico" value="1" required>
                                    <input type="radio" name="predio_historico" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>CEP: *</label>
                                        <input type="text" class="form-control" name="cep" id="cep" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Endereço: *</label>
                                        <input type="text" class="form-control" name="logradouro" id="logradouro" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Número: *</label>
                                        <input type="text" class="form-control" name="numero" id="numero" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Região: *</label>
                                        <select name="regiao_id" class="form-control" required>
                                            <option value="">Selecione...</option>
                                            <?php $localObj->geraOpcao('regioes', $local->regiao_id ?? ''); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="local">Funcionamento: *</label>
                                    <input type="text" class="form-control" id="funcionamento" name="funcionamento"
                                           maxlength="100" placeholder="Digite sobre o funcionamento do local" value="<?= $usuario->email ?? '' ?>">
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

<script src="../views/dist/js/cep_api.js"></script>