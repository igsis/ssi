<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class ChamadoController extends MainModel
{
    public function insereChamado()
    {
        /* executa limpeza nos campos */
        $dados = [];
        $pagina = $_POST['pagina'];
        unset($_POST['_method']);
        unset($_POST['pagina']);
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
                'location' => SERVERURL . $pagina . '/nota_cadastro&id=' . MainModel::encryption($id)
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . $pagina . '/chamado_cadastro'
            ];
        }
        /* ./cadastro */
        return MainModel::sweetAlert($alerta);
    }

    /* edita */
    public function editaChamado($id)
    {
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
                'titulo' => 'Chamado',
                'texto' => 'Chamado editado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'administrador/chamado_cadastro&id=' . $id
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . 'administrador/chamado_cadastro&id=' . $id
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
            WHERE usuario_id = '$idUsuario' ORDER BY status_id, id")->fetchAll(PDO::FETCH_OBJ);
    }

    public function listaChamadoAdministrador($idAdministrador)
    {
        //$idAdministrador = MainModel::decryption($idAdministrador);
        return MainModel::consultaSimples("
            SELECT ch.*, c.categoria, l.local, cs.status FROM chamados ch 
                INNER JOIN categorias c on ch.categoria_id = c.id
                INNER JOIN locais l on ch.local_id = l.id
                INNER JOIN chamado_status cs on ch.status_id = cs.id
            WHERE ch.administrador_id = '$idAdministrador'")->fetchAll(PDO::FETCH_OBJ);
    }

    public function buscaChamadoAdministrador($dados)
    {
        $where = '';
        if (count($dados)){
            $where = 'WHERE ';
            foreach ($dados as $key => $dado) {
                if ($key != 'descricao' && $key != 'solucao') {
                    $where .= " ch.{$key} = '{$dado}'";
                }
                else{
                    $where .= " ch.{$key} LIKE '%{$dado}%'";
                }
            }
        }

        $query = "SELECT ch.*, c.categoria, l.local, cs.status FROM chamados ch 
                    INNER JOIN categorias c on ch.categoria_id = c.id
                    INNER JOIN locais l on ch.local_id = l.id
                    INNER JOIN chamado_status cs on ch.status_id = cs.id    
                {$where} ORDER BY prioridade_id, id";

        $chamados = DbModel::consultaSimples($query)->fetchAll(PDO::FETCH_OBJ);

        return $chamados;
    }

    public function recuperaChamado($id)
    {
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

    public function insereFuncionarioChamado()
    {
        /* executa limpeza nos campos */
        $dados = [];
        $idChamado = $_POST['chamado_id'];
        unset($_POST['_method']);
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }
        /* ./limpeza */

        /* cadastro */
        $insere = DbModel::insert('chamado_funcionario', $dados);
        if ($insere->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $id = DbModel::connection()->lastInsertId();
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Chamado',
                'texto' => 'Funcionário cadastrado no chamado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'administrador/nota_cadastro&id=' . MainModel::encryption($idChamado)
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . 'administrador/nota_cadastro&id=' . MainModel::encryption($idChamado)
            ];
        }
        /* ./cadastro */
        return MainModel::sweetAlert($alerta);
    }

    public function editaFuncionarioChamado($id)
    {
        $idDecryp = MainModel::decryption($id);

        $idChamado = $_POST['chamado_id'];
        unset($_POST['_method']);
        unset($_POST['id']);

        $dados = [];
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }

        $edita = DbModel::update('chamado_funcionario', $dados, $idDecryp);
        if ($edita->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Funcionário / Material',
                'texto' => 'Informações editadas com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'administrador/nota_cadastro&id=' . MainModel::encryption($idChamado)
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . 'administrador/nota_cadastro&id=' . MainModel::encryption($idChamado)
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    public function recuperaFuncionarioChamado($idChamado)
    {
        $idChamado = MainModel::decryption($idChamado);
        return DbModel::consultaSimples("
            SELECT f.nome, f.cargo, cf.ferramentas, cf.id FROM chamado_funcionario cf 
                INNER JOIN funcionarios f on cf.funcionario_id = f.id
            WHERE cf.chamado_id = '$idChamado'
        ");
    }
}