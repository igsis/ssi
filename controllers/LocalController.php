<?php

if ($pedidoAjax) {
    require_once "../models/LocalModel.php";
} else {
    require_once "./models/LocalModel.php";
}


class LocalController extends LocalModel
{

}
