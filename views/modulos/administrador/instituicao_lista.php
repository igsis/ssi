<?php
require_once "./controllers/InstituicaoController.php";
$instituicaoObj = new InstituicaoController();

$instituicoes = $instituicaoObj->listaInstituicoes();
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
                        <h3 class="card-title">Intituições</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal" data-target="#add-instituicao">
                                <i class="fas fa-plus"></i> Adicionar Intituição
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Instituição</th>
                                    <th width="15%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($instituicoes as $instituicao): ?>
                                    <tr>
                                        <td><?=$instituicao->instituicao?></td>
                                        <td>
                                                <button type="button" class="form-control btn btn-sm bg-gradient-primary"
                                                    data-id="<?=$instituicao->id?>" data-instituicao="<?=$instituicao->instituicao?>"
                                                    onclick="modalEdicao.bind(this)()">
                                                    Editar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Instituição</th>
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
<div class="modal fade" id="add-instituicao" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="formulario-ajax" data-form="save" action="<?= SERVERURL ?>ajax/administradorAjax.php" method="post">
                <input type="hidden" name="_method" id="_method" value="insereInstituicao">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar nova Instituicao</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="instituicao">Instituição: *</label>
                        <input type="text" name="instituicao" class="form-control" id="instituicao" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" id="btnSalvar">Adicionar</button>
                </div>
                <div class="resposta-ajax"></div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$javascript = <<<JAVASCRIPT
<script>
    let modalInstituicao = $('#add-instituicao');
    var estadoInicial = "";

    function modalEdicao() {
        let titulo = $('.modal-title');
        let btnSalvar = $('#btnSalvar');
        let cpoInstituicao = $('#instituicao');
        let nomeInstituicao = $(this).data('instituicao');
        
        titulo.text('Editar instituição: ' + nomeInstituicao);
        cpoInstituicao.val(nomeInstituicao);
        btnSalvar.text('Editar');
        $('#add-instituicao').modal('show');
    }
    
    $(document).ready(function () {
        estadoInicial = modalInstituicao.clone();
    })
    
    modalInstituicao.on('hidden.bs.modal', function () {
        modalInstituicao.replaceWith(estadoInicial);
    });
</script>
JAVASCRIPT;

?>