<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require './inc/Config.inc.php';

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($dados['SendCadUsuario'])):
            unset($dados['SendCadUsuario']);
            $CadUsuario = new Veiculo();
            $CadUsuario->ExeCreate($dados);
            if(!$CadUsuario->getResultado()):
                echo $CadUsuario->getMsg();
            else:
                echo $CadUsuario->getMsg();
            endif;
        endif;
    ?>
    <form name="CadUsuario" method="post" enctype = "multiplar/form-data" action="">
        <label for="">Nome do Veículo: </label>
        <input type="text" name="nomeVeiculo" value="<?php if(isset($dados)): echo $dados['name']; endif;?>">
        <br>
        <label for="">Placa: </label>
        <input type="text" name="placa" value="<?php if(isset($dados)): echo $dados['placa']; endif;?>">
        <br>
        <input type="submit" value="Cadastrar" name="SendCadUsuario">
    </form>
</body>
</html>