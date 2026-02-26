<?php

// Função para validar o token CSRF
function validaCsrf($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Função para sanitizar/padronizar os campos
function normalizaCampos($dados, $campo) {
    
    $resultado = trim($dados[$campo] ?? null);

    if ($campo == 'email'){
        $resultado = mb_strtolower($resultado);
    }

    if (str_contains($campo, 'nome') || str_contains($campo, 'pastor') || str_contains($campo, 'igreja') || $campo == 'profissao' || $campo == 'logradouro' || $campo == 'complemento' || $campo == 'cidade' ) {
        $resultado = mb_strtoupper($resultado);
    }

    return $resultado;
}

//Função para validação dígitos verificadores de CPF
function validaCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);

    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int)$cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;

    if ((int)$cpf[9] !== $digito1) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += (int)$cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;

    return (int)$cpf[10] === $digito2;
}

//Função para validação de campos
function validaCampos($dados, $regras) {
    $erros = [];

    foreach ($regras as $campo => $regra) {
        $dados[$campo] = normalizaCampos($dados, $campo);

        if ($regra['required'] && empty($dados[$campo])) {
            $erros[] = "O campo {$campo} é obrigatório.";
            continue;
        }

        if (isset($regra['max']) && strlen($dados[$campo]) > $regra['max']) {
            $erros[] = "O campo {$campo} excede o tamanho máximo ({$regra['max']} caracteres).";
        }

        if (isset($regra['format']) && !empty($dados[$campo]) && !preg_match($regra['format'], $dados[$campo])) {
            $erros[] = "O campo {$campo} está incompleto ou com formato inválido.";
            continue;
        }

        if ($campo == 'cpf' && !validaCPF($dados[$campo])){
            $erros[] = "O CPF informado é inválido.";
            continue;
        }

        if (isset($regra['select']) && !in_array($dados[$campo], $regra['select'], true)) {
            $erros[] = "Valor inválido para o campo {$campo}.";
            continue;
        }

        if (isset($regra['email']) && !empty($dados[$campo]) && !filter_var($dados[$campo], $regra['email'])) {
            $erros[] = "O campo e-mail está incompleto ou com formato inválido";
        }
        
    }

    return ['erros' => $erros, 'dados' => $dados];
}

//Função para validação de datas
function validaData($valor) {
    return (!empty($valor) && $valor !== '0000-00-00') ? $valor : null;
}


//Função para cadastramento de dados do membro
function addMembro($dados) {
    require_once 'Database.php';
    $conn = null;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ]);
        $conn->beginTransaction();
        
        $queryProf = "INSERT INTO profissaos (nome, church_id, user_id, created, modified) VALUES (:nome, 22, 66, NOW(), NOW())";

        $stmtProf = $conn->prepare($queryProf);
        $stmtProf->bindValue(':nome', $dados['profissao']);
        $stmtProf->execute();

        $profissao_id = $conn->lastInsertId();

        $queryMemb = "INSERT INTO membros (nome, sexo, datanascimento, naturalidade, email, cel, fone, rg, cpf, estadocivil,
                    datacasamento, nomeconjuge, escolaridade_id, profissao_id, batizado, databatismo, pastorbatismo, igrejabatismo, profissaofe,
                    dataprofe, pastorprofe, igrejaprofe, nomemae, nomepai, church_id, user_id, tipo, created, modified) VALUES (:nome, :sexo,
                    :datanascimento, :naturalidade, :email, :cel, :fone, :rg, :cpf, :estadocivil, :datacasamento, :nomeconjuge, :escolaridade_id,
                    :profissao_id, :batizado, :databatismo, :pastorbatismo, :igrejabatismo, :profissaofe, :dataprofe, :pastorprofe, :igrejaprofe,
                    :nomemae, :nomepai, 22, 66, 'Membro', NOW(), NOW())";

        $datacasamento = validaData($dados['datacasamento'] ?? null);
        $databatismo  = validaData($dados['databatismo'] ?? null);
        $dataprofe    = validaData($dados['dataprofe'] ?? null);

        $stmtMemb = $conn->prepare($queryMemb);
        $stmtMemb->bindValue(':nome', $dados['nome']);
        $stmtMemb->bindValue(':sexo', $dados['sexo']);
        $stmtMemb->bindValue(':datanascimento', $dados['datanascimento']);
        $stmtMemb->bindValue(':naturalidade', $dados['naturalidade']);
        $stmtMemb->bindValue(':email', $dados['email']);
        $stmtMemb->bindValue(':cel', $dados['cel']);
        $stmtMemb->bindValue(':fone', $dados['fone']);
        $stmtMemb->bindValue(':rg', $dados['rg']);
        $stmtMemb->bindValue(':cpf', $dados['cpf']);
        $stmtMemb->bindValue(':estadocivil', $dados['estadocivil']);
        $stmtMemb->bindValue(':datacasamento', $datacasamento);
        $stmtMemb->bindValue(':nomeconjuge', $dados['nomeconjuge']);
        $stmtMemb->bindValue(':escolaridade_id', $dados['escolaridade']);
        $stmtMemb->bindValue(':profissao_id', $profissao_id);
        $stmtMemb->bindValue(':batizado', $dados['batizado']);
        $stmtMemb->bindValue(':databatismo', $databatismo);
        $stmtMemb->bindValue(':pastorbatismo', $dados['pastorbatismo']);
        $stmtMemb->bindValue(':igrejabatismo', $dados['igrejabatismo']);
        $stmtMemb->bindValue(':profissaofe', $dados['profissaofe']);
        $stmtMemb->bindValue(':dataprofe', $dataprofe);
        $stmtMemb->bindValue(':pastorprofe', $dados['pastorprofe']);
        $stmtMemb->bindValue(':igrejaprofe', $dados['igrejaprofe']);
        $stmtMemb->bindValue(':nomemae', $dados['nomemae']);
        $stmtMemb->bindValue(':nomepai', $dados['nomepai']);
        $stmtMemb->execute();

        $membro_id = $conn->lastInsertId();

        $queryEnd = "INSERT INTO enderecos (logradouro, numero, complemento, bairro, cep, cidade, estado, membro_id, user_id, church_id, created, modified)
        VALUES (:logradouro, :numero, :complemento, :bairro, :cep, :cidade, :estado, :membro_id, 66, 22, NOW(), NOW())";

        $stmtEnd = $conn->prepare($queryEnd);
        $stmtEnd->bindValue(':logradouro', $dados['logradouro']);
        $stmtEnd->bindValue(':numero', $dados['numero']);
        $stmtEnd->bindValue(':complemento', $dados['complemento']);
        $stmtEnd->bindValue(':cep', $dados['cep']);
        $stmtEnd->bindValue(':bairro', $dados['bairro']);
        $stmtEnd->bindValue(':cidade', $dados['cidade']);
        $stmtEnd->bindValue(':estado', $dados['estado']);
        $stmtEnd->bindValue(':membro_id', $membro_id);
        $stmtEnd->execute();
        
        $conn->commit();
        return ['status' => true, 'msg' => "Dados enviados com sucesso."];
    
    } catch (PDOException $err) {

        if ($conn instanceof PDO && $conn->inTransaction()) {
            $conn->rollBack();
        }
    
        error_log($err->getMessage());
        if (isset($err->errorInfo[1]) && $err->errorInfo[1] == 1062) {
            return ['status' => false, 'msg' => ' Membro já cadastrado.'];
        }
        else{
            return ['status' => false, 'msg' => "Não foi possível finalizar o cadastramento.\nContate o administrador."];
        }
    }
}

$data_format='/^\d{4}-\d{2}-\d{2}$/';
$select_format=['1', '2'];

$regras = [
    'nome' => ['required' => true, 'max' => 100],
    'sexo' => ['required' => true, 'select' => $select_format],
    'datanascimento' => ['required' => true, 'format' => $data_format],
    'naturalidade' => ['required' => true],
    
    'logradouro' => ['required' => true, 'max' => 50],
    'numero' => ['required' => true],
    'bairro' => ['required' => true, 'max' => 30],
    'cep' => ['required' => true, 'max' => 9, 'format' => '/^\d{5}\-\d{3}$/'],
    'cidade' => ['required' => true],
    'estado' => ['required' => true, 'max' => 2],
    
    'email' => ['required' => false, 'email' => FILTER_VALIDATE_EMAIL],
    'cel' => ['required' => false],
    'fone' => ['required' => false],

    'rg' => ['required' => true, 'max' => 12, 'format' => '/^\d{2}\.\d{3}\.\d{3}-[Xx\d]$/'],
    'cpf' => ['required' => true, 'max' => 14, 'format' => '/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
    'estadocivil' => ['required' => true, 'select' => ['1', '2', '3', '4', '5', '6']],
    'datacasamento' => ['required' => false, 'format' => '/^\d{4}-\d{2}-\d{2}$/'],
    'nomeconjuge' => ['required' => false],
    'nomemae' => ['required' => false],
    'nomepai' => ['required' => false],
    'escolaridade' => ['required' => true, 'select' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']],
    'profissao' => ['required' => true, 'max' => 80],
    
    'batizado' => ['required' => true, 'select' => $select_format],
    'databatismo' => ['required' => false, 'format' => $data_format],
    'pastorbatismo' => ['required' => false],
    'igrejabatismo' => ['required' => false],
    
    'profissaofe' => ['required' => true, 'select' => $select_format],
    'dataprofe' => ['required' => false, 'format' => $data_format],
    'pastorprofe' => ['required' => false],
    'igrejaprofe' => ['required' => false],
];
