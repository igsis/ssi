<?php
$viewObj = new ViewsController();
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Bem-vindo ao SSI</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">SSI</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <div class="widget-user-header">
                                    <h3 class="widget-user-username">Estatistica</h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Categorias</th>
                                        <th>Abertos</th>
                                        <th>Fechados</th>
                                        <th>Em Andamento</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Hidráulica</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2</td>
                                        <td>2</td>

                                    </tr>
                                    <tr>
                                        <th>Alvenaria</th>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>

                                    </tr>
                                    <tr>
                                        <th>Pintura</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <th>Elétrica (lâmpada, tomada, etc.)</th>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <th>Serralheria</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Carpintaria</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Marcenaria</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <th>Manutenção de Equipamentos</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <th>Telhado</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Jardinagem</th>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <div class="widget-user-header bg-warning">
                                <h3 class="widget-user-username">Relatório do {{Mes}}</h3>
                            </div>
                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Abertos <span class="float-right badge bg-primary">31</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Em Andamento <span class="float-right badge bg-info">5</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Fechado <span class="float-right badge bg-success">12</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->