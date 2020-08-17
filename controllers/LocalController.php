<?php

if ($pedidoAjax) {
    require_once "../models/LocalModel.php";
} else {
    require_once "./models/LocalModel.php";
}


class LocalController extends LocalModel
{
    public function retornaAdministrador($usuario='',$local='')
    {
        $adm = LocalModel::getAdministrador(["usuario"=>$usuario,"local"=>$local]);
        return $adm;
    }
}
