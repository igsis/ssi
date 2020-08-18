<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class ChamadoController extends MainModel
{
    public function insereChamado(){
        /* executa limpeza nos campos */
        $dados = [];
        unset($_POST['_method']);
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }
        /* ./limpeza */

        /* cadastro */
        $insere = DbModel::insert('chamados', $dados);
        if ($insere->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $id = DbModel::connection()->lastInsertId();
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Chamado',
                'texto' => 'Chamado cadastrado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . '/chamado_cadastro&id=' . MainModel::encryption($id) . '&id=' . MainModel::encryption($id)
            ];
        }
        else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . '/chamado_cadastro'
            ];
        }
        /* ./cadastro */
        return MainModel::sweetAlert($alerta);
    }

    /* edita */
    public function editaChamado($id){
        $idDecryp = MainModel::decryption($id);

        unset($_POST['_method']);
        unset($_POST['id']);

        $dados = [];
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }

        $edita = DbModel::update('chamados', $dados, $idDecryp);
        if ($edita->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Chamado Legal',
                'texto' => 'Chamado Legal editado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . '/chamado_cadastro&id=' . $id . '&id=' . MainModel::encryption($id)
            ];
        }
        else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL.'/chamado_cadastro&id='.$id.'&id='.MainModel::encryption($id)
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    public function listaChamadoUsuario($idUsuario)
    {
        //$idUsuario = MainModel::decryption($idUsuario);
        return DbModel::consultaSimples("
            SELECT ch.*, c.categoria, l.local, cs.status FROM chamados ch 
                INNER JOIN categorias c on ch.categoria_id = c.id
                INNER JOIN locais l on ch.local_id = l.id
                INNER JOIN chamado_status cs on ch.status_id = cs.id    
            WHERE usuario_id = '$idUsuario' ORDER BY prioridade_id, id")->fetchAll(PDO::FETCH_OBJ);
    }

    public function listaChamadoAdministrador($idAdministrador)
    {
        $idAdministrador = MainModel::decryption($idAdministrador);
        return MainModel::consultaSimples("SELECT * FROM chamados WHERE administrador_id = '$idAdministrador'")->fetchAll(PDO::FETCH_OBJ);
    }

    public function recuperaChamado($id) {
        $id = MainModel::decryption($id);
        $chamado = DbModel::consultaSimples("
            SELECT ch.*, c.categoria, l.local, cs.status FROM chamados ch 
                INNER JOIN categorias c on ch.categoria_id = c.id
                INNER JOIN locais l on ch.local_id = l.id
                INNER JOIN chamado_status cs on ch.status_id = cs.id    
            WHERE ch.id = '$id'
        ")->fetchObject();
        return $chamado;
    }
}