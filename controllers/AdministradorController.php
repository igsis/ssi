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

    /**
     * <p>Altera o nivel de acesso do usuario para 2 <i>(Administrador)</i> ou 1 <i>(Usuario)</i></p>
     * @return string
     */
    public function nivelAcesso($nvlAcesso)
    {
        $usuario_id = MainModel::limparString($_POST['usuario_id']);
        $usuario_id = MainModel::decryption($usuario_id);

        if ($nvlAcesso == 1) {
            $texto = 'O usuário selecionado removido do grupo de administradores!';
        } else {
            $texto = 'O usuário selecionado agora é um administrador!';
        }

        $update = DbModel::update('usuarios', ['nivel_acesso_id' => $nvlAcesso], $usuario_id);
        if ($update) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Administrador',
                'texto' => $texto,
                'tipo' => 'success',
                'location' => SERVERURL.'administrador/administrador_lista'
            ];
        } else {
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

    public function insereInstituicao()
    {
        $dado['instituicao'] = MainModel::limparString($_POST['instituicao']);

        $insert = DbModel::insert('instituicoes', $dado);
        if ($insert) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Instituição Cadastrada!',
                'texto' => "Instituição <b>{$dado['instituicao']}</b> cadastrada!",
                'tipo' => 'success',
                'location' => SERVERURL.'administrador/instituicao_lista'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'administrador/instituicao_lista'
            ];
        }

        return MainModel::sweetAlert($alerta);
    }
    public function editaInstituicao()
    {
        $dado['instituicao'] = MainModel::limparString($_POST['instituicao']);
        $instituicao_id = MainModel::limparString($_POST['instituicao_id']);
        $instituicao_id = MainModel::decryption($instituicao_id);

        $update = DbModel::update('instituicoes', $dado, $instituicao_id);
        if ($update) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Instituição Editada!',
                'texto' => "Instituição <b>{$dado['instituicao']}</b> Editada!",
                'tipo' => 'success',
                'location' => SERVERURL.'administrador/instituicao_lista'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'administrador/instituicao_lista'
            ];
        }

        return MainModel::sweetAlert($alerta);
    }
}