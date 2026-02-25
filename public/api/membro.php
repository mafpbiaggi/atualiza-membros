<?php

require_once __DIR__ . '/../../src/App.php';

//Recebe os dados do formulário.
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

foreach ($regras as $campo => $regra) {
    if (!isset($dados[$campo])) {
        $dados[$campo] = '';
    }
}

$erros = validaCampos($dados, $regras);

if ($erros) {
echo json_encode(['status' => false, 'msg' => implode('\n', $erros)]);
exit;
}

echo json_encode(addMembro($dados));
