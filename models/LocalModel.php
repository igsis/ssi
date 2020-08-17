<?php
if ($pedidoAjax) {
    require_once "../models/MainModel.php";
} else {
    require_once "./models/MainModel.php";
}

class LocalModel extends MainModel
{
    protected function getLocal($dado) {
        $pdo = parent::connection();
        $sql = "SELECT * FROM locais WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $dado['']);
        $statement->execute();
        return $statement;
    }

    protected function getInstituicao($dados) {
        $pdo = parent::connection();
        $sql = "SELECT *
                FROM instituicoes AS ins 
                LEFT JOIN locais AS lo ON ins.id = lo.instituicao_id
                WHERE lo.id = 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $dados['id']);
        $statement->execute();
        return $statement;
    }

    protected function getAdministrador($dados) {
        $pdo = parent::connection();
        $sql = "SELECT ad.administrador_id
                FROM administrador_instituicao AS ad
                LEFT JOIN instituicoes AS ins ON ad.instituicao_id = ins.id
                LEFT JOIN locais AS lo ON ins.id = lo.instituicao_id
                LEFT JOIN usuarios AS us ON lo.id = us.local_id
                WHERE lo.id = :local";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":local", $dados['local']);
        $statement->execute();
        return $statement;
    }
}