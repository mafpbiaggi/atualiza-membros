<?php

//Função para validação de campos
function validaCampos($dados, $regras) {
    $erros = [];
    foreach ($regras as $campo => $regra) {
        if ($regra['required'] && empty($dados[$campo])) {
            $erros[] = "O campo {$campo} é obrigatório.";
        }
        if (isset($regra['max']) && strlen($dados[$campo]) > $regra['max']) {
            $erros[] = "O campo {$campo} excede o tamanho máximo ({$regra['max']} caracteres).";
        }
    }
    return $erros;
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
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
        $conn->beginTransaction();
        
        $queryProf = "INSERT INTO profissaos (nome, church_id, user_id, created, modified) VALUES (:nome, 22, 66, NOW(), NOW())";

        $stmtProf = $conn->prepare($queryProf);
        $stmtProf->bindValue(':nome', trim(mb_strtoupper($dados['profissao'])));
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
        $stmtMemb->bindValue(':nome', trim(mb_strtoupper($dados['nome'])));
        $stmtMemb->bindValue(':sexo', $dados['sexo']);
        $stmtMemb->bindValue(':datanascimento', $dados['datanascimento']);
        $stmtMemb->bindValue(':naturalidade', trim(mb_strtoupper($dados['naturalidade'])));
        $stmtMemb->bindValue(':email', trim(mb_strtolower($dados['email'])));
        $stmtMemb->bindValue(':cel', $dados['cel']);
        $stmtMemb->bindValue(':fone', $dados['fone']);
        $stmtMemb->bindValue(':rg', $dados['rg']);
        $stmtMemb->bindValue(':cpf', $dados['cpf']);
        $stmtMemb->bindValue(':estadocivil', $dados['estadocivil']);
        $stmtMemb->bindValue(':datacasamento', $datacasamento);
        $stmtMemb->bindValue(':nomeconjuge', trim(mb_strtoupper($dados['nomeconjuge'])));
        $stmtMemb->bindValue(':escolaridade_id', $dados['escolaridade']);
        $stmtMemb->bindValue(':profissao_id', $profissao_id);
        $stmtMemb->bindValue(':batizado', $dados['batizado']);
        $stmtMemb->bindValue(':databatismo', $databatismo);
        $stmtMemb->bindValue(':pastorbatismo', trim(mb_strtoupper($dados['pastorbatismo'])));
        $stmtMemb->bindValue(':igrejabatismo', trim(mb_strtoupper($dados['igrejabatismo'])));
        $stmtMemb->bindValue(':profissaofe', $dados['profissaofe']);
        $stmtMemb->bindValue(':dataprofe', $dataprofe);
        $stmtMemb->bindValue(':pastorprofe', trim(mb_strtoupper($dados['pastorprofe'])));
        $stmtMemb->bindValue(':igrejaprofe', trim(mb_strtoupper($dados['igrejaprofe'])));
        $stmtMemb->bindValue(':nomemae', trim(mb_strtoupper($dados['nomemae'])));
        $stmtMemb->bindValue(':nomepai', trim(mb_strtoupper($dados['nomepai'])));
        $stmtMemb->execute();

        $membro_id = $conn->lastInsertId();

        $queryEnd = "INSERT INTO enderecos (logradouro, numero, complemento, bairro, cep, cidade, estado, membro_id, user_id, church_id, created, modified)
        VALUES (:logradouro, :numero, :complemento, :bairro, :cep, :cidade, :estado, :membro_id, 66, 22, NOW(), NOW())";

        $stmtEnd = $conn->prepare($queryEnd);
        $stmtEnd->bindValue(':logradouro', trim(mb_strtoupper($dados['logradouro'])));
        $stmtEnd->bindValue(':numero', $dados['numero']);
        $stmtEnd->bindValue(':complemento', trim(mb_strtoupper($dados['complemento'])));
        $stmtEnd->bindValue(':cep', $dados['cep']);
        $stmtEnd->bindValue(':bairro', trim(mb_strtoupper($dados['bairro'])));
        $stmtEnd->bindValue(':cidade', trim(mb_strtoupper($dados['cidade'])));
        $stmtEnd->bindValue(':estado', $dados['estado']);
        $stmtEnd->bindValue(':membro_id', $membro_id);
        $stmtEnd->execute();
        
        $conn->commit();
        return ['status' => true, 'msg' => "Dados enviados com sucesso."];
    
    } catch (PDOException $err) {
        $conn->rollBack();
        error_log($err->getMessage());

        if (isset($err->errorInfo[1]) && $err->errorInfo[1] == 1062) {
            return ['status' => false, 'msg' => 'CPF já cadastrado.'];
        }
        else{
            return ['status' => false, 'msg' => "Não foi possível finalizar o cadastramento.\nContate o administrador."];
        }
    }
}

$regras = [
    'nome' => ['required' => true, 'max' => 100],
    'sexo' => ['required' => true],
    'datanascimento' => ['required' => true],
    'naturalidade' => ['required' => true],
    
    'logradouro' => ['required' => true, 'max' => 50],
    'numero' => ['required' => true],
    'bairro' => ['required' => true, 'max' => 30],
    'cep' => ['required' => true, 'max' => 9],
    'cidade' => ['required' => true],
    'estado' => ['required' => true, 'max' => 2],
    
    'email' => ['required' => false],
    'cel' => ['required' => false],
    'fone' => ['required' => false],

    'rg' => ['required' => true, 'max' => 12],
    'cpf' => ['required' => true, 'max' => 14],
    'estadocivil' => ['required' => true],
    'datacasamento' => ['required' => false],
    'nomeconjuge' => ['required' => false],
    'nomemae' => ['required' => false],
    'nomepai' => ['required' => false],
    'escolaridade' => ['required' => true],
    'profissao' => ['required' => true, 'max' => 80],
    
    'batizado' => ['required' => true],
    'databatismo' => ['required' => false],
    'pastorbatismo' => ['required' => false],
    'igrejabatismo' => ['required' => false],
    
    'profissaofe' => ['required' => true],
    'dataprofe' => ['required' => false],
    'pastorprofe' => ['required' => false],
    'igrejaprofe' => ['required' => false],
];
