<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class NotaController extends MainModel
{
    public function insereNota()
    {
        /* executa limpeza nos campos */
        $dados = [];
        unset($_POST['_method']);
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }
        /* ./limpeza */

        /* cadastro */
        $insere = DbModel::insert('notas', $dados);
        if ($insere->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $id = DbModel::connection()->lastInsertId();
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Notas',
                'texto' => 'Nota cadastrada com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . '/nota_cadastro&id=' . MainModel::encryption($id) . '&id=' . MainModel::encryption($id)
            ];
        }
        else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . '/nota_cadastro'
            ];
        }
        /* ./cadastro */
        return MainModel::sweetAlert($alerta);
    }

    public function listaNota($idChamado)
    {
        $idChamado = MainModel::decryption($idChamado);
        return MainModel::consultaSimples("SELECT * FROM notas WHERE chamado_id = '$idChamado'")->fetchAll(PDO::FETCH_OBJ);
    }
}