<?php
require_once __DIR__ . '/../../src/Bootstrap.php';
require_once __DIR__ . '/../../src/App.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'msg' => 'Método não permitido.']);
    exit;
}

$tokenRecebido = $_POST['csrf_token'] ?? '';
if (!validaCsrf($tokenRecebido)) {
    http_response_code(403);
    echo json_encode(['status' => false, 'msg' => 'Requisição inválida.']);
    exit;
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

//Recebe os dados do formulário.
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

foreach ($regras as $campo => $regra) {
    if (!isset($dados[$campo])) {
        $dados[$campo] = '';
    }
}

$retorno = validaCampos($dados, $regras);
$erros = $retorno['erros'];
$dados = $retorno['dados'];

if ($erros) {
    echo json_encode(['status' => false, 'msg' => implode("\n", $erros), 'csrf_token' => $_SESSION['csrf_token']]);
    exit;
}

$resultado = addMembro($dados);
$resultado['csrf_token'] = $_SESSION['csrf_token'];
echo json_encode($resultado);
