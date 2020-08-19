<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class FuncionarioController extends MainModel
{
    public function insereFuncionario()
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
        $insere = DbModel::insert('funcionarios', $dados);
        if ($insere->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $id = DbModel::connection()->lastInsertId();
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Funcionario',
                'texto' => 'Funcionario cadastrado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . $pagina . 'administrador/funcionarios'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . $pagina . 'administrador/funcionario_cadastro'
            ];
        }
        /* ./cadastro */
        return MainModel::sweetAlert($alerta);
    }

    /* edita */
    public function editaFuncionario($id)
    {
        $idDecryp = MainModel::decryption($id);

        unset($_POST['_method']);
        unset($_POST['id']);

        $dados = [];
        foreach ($_POST as $campo => $post) {
            $dados[$campo] = MainModel::limparString($post);
        }

        $edita = DbModel::update('funcionarios', $dados, $idDecryp);
        if ($edita->rowCount() >= 1 || DbModel::connection()->errorCode() == 0) {
            $alerta = [
                'alerta' => 'sucesso',
                'titulo' => 'Funcionario',
                'texto' => 'Funcionario editado com sucesso!',
                'tipo' => 'success',
                'location' => SERVERURL . 'administrador/funcionarios'
            ];
        } else {
            $alerta = [
                'alerta' => 'simples',
                'titulo' => 'Erro!',
                'texto' => 'Erro ao salvar!',
                'tipo' => 'error',
                'location' => SERVERURL . 'administrador/funcionarios'
            ];
        }
        return MainModel::sweetAlert($alerta);
    }

    public function listarFuncionario()
    {
        $funcionarios = DbModel::consultaSimples("SELECT * FROM funcionarios WHERE publicado = 1")->fetchAll(PDO::FETCH_OBJ);
        return $funcionarios;
    }

    public function recuperaFuncionario($id) {
        $usuario = DbModel::getInfo('funcionarios',$id);
        return $usuario->fetchObject();
    }
}