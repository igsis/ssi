<?php
if ($pedidoAjax) {
    require_once "../controllers/UsuarioController.php";
} else {
    require_once "./controllers/UsuarioController.php";
}

class AdministradorController extends UsuarioController
{
    public function listaAdmins()
    {
        return DbModel::consultaSimples("SELECT * FROM usuarios WHERE publicado = 1 AND nivel_acesso_id = 2")->fetchAll(PDO::FETCH_OBJ);
    }

    public function insereAdmin()
    {
        $usuario_id = MainModel::limparString($_POST['usuario_id']);

        $update = DbModel::update('usuarios', ['nivel_acesso_id' => 2], $usuario_id);
        if ($update) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Administrador',
                'texto' => 'O usuário selecionado agora é um administrador!',
                'tipo' => 'success',
                'location' => SERVERURL.'administrador/administrador_lista'
            ];
        }
        else{
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'administrador/administrador_lista'
            ];
        }
        return MainModel::sweetAlert($alerta);
    }
}