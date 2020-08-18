<?php

require_once "./controllers/FuncionarioController.php";

$funcionarioObj =  new FuncionarioController();

$funcionarios = $funcionarioObj->listarFuncionario();

?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Funcionarios</h1>
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
                        <h3 class="card-title">Lista de Funcionario</h3>
                        <a href="<?= SERVERURL ?>administrador/funcionario_cadastro" class="btn btn-success float-right">
                            <i class="fas fa-plus"></i>
                            Adicionar
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="tabela" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Cargo</th>
                                        <th width="20%">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($funcionarios as $funcionario){
                                    ?>
                                            <tr>
                                                <td><?= $funcionario->id ?></td>
                                                <td><?= $funcionario->nome ?></td>
                                                <td><?= $funcionario->cargo ?></td>
                                                <td>
                                                    <a href="<?= SERVERURL ?>administrador/funcionario_cadastro&id=<?= $funcionario->id ?>" class="btn btn-primary">Editar</a>
                                                    <a href="<?= SERVERURL ?>administrador/funcionario_apaga&id=<?= $funcionario->id ?>" class="btn btn-danger">Remover</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Cargo</th>
                                        <th>Ações</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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