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
                <h1 class="m-0 text-dark">Lista Chamados</h1>
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
                        <div class="card-tools">
                            <a href="" class="btn btn-block btn-outline-success">
                                <i class="fas fa-plus"></i>
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="formulario-ajax" method="POST" role="form">
                        <div class="card-body">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td>Chamado Nº</td>
                                        <td>Local</td>
                                        <td>Contato</td>
                                        <td>Categoria</td>
                                        <td>Descrição</td>
                                        <td>Data Abertura</td>
                                        <td>Status</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>3</td>
                                        <td>Teatro-Parque Flávio Império</td>
                                        <td>Ed Robson/Adesilio</td>
                                        <td>Manutenção de Equipamentos</td>
                                        <td>Ar Condicionado Central Q...</td>
                                        <td>08/02/18 - 11:27:32</td>
                                        <td>Aberto</td>
                                        <td>
                                            <a class="btn btn-app bg-success">
                                                <i class="fas fa-folder-open"></i> Carregar
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Chamado Nº</td>
                                        <td>Local</td>
                                        <td>Contato</td>
                                        <td>Categoria</td>
                                        <td>Descrição</td>
                                        <td>Data Abertura</td>
                                        <td>Status</td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">

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
