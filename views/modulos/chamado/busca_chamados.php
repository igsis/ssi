<?php
require_once "./controllers/ChamadoController.php";
require_once "./controllers/UsuarioController.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Buscar Chamados</h1>
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
                    <form class="formulario-ajax" method="POST" role="form">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Chamado Nº:</label>
                                                    <input type="text" class="form-control" name="nChamado" placeholder="Digite número do chamado">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <label>Usuário:</label>
                                                    <select class="select2bs4 form-control" multiple="multiple" data-placeholder="Selecione um usuário" style="width: 100%;">
                                                        <option>Qwerty da Silva</option>
                                                        <option>Qwerty dos Santos</option>
                                                        <option>Qwerty Menezes</option>
                                                        <option>Qwerty Sirqueira</option>
                                                        <option>Qwerty Oliveira</option>
                                                        <option>Qwerty Lourenço</option>
                                                        <option>Qwerty Cavalcante</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-8 col-sm-12">
                                                <div class="form-group">
                                                    <label>Categorias:</label>
                                                    <select class="form-control select2bs4" style="width: 100%;">
                                                        <option></option>
                                                        <option>Alabama</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                        <option>Delaware</option>
                                                        <option>Tennessee</option>
                                                        <option>Texas</option>
                                                        <option>Washington</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Staus:</label>
                                                    <select class="form-control" style="width: 100%;">
                                                        <option>Selecione um status</option>
                                                        <option>Aberto</option>
                                                        <option>Aberto</option>
                                                        <option>Aberto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição:</label>
                                                    <input type="text" name="descricao" class="form-control" placeholder="Insira parte do texto da Descrição">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Solução:</label>
                                                    <input type="text" name="descricao" class="form-control" placeholder="Insira parte do texto da Solução">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">
                                Buscar
                            </button>
                        </div>
                        <div class="resposta-ajax"></div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
