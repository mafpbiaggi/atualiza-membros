<?php
require_once __DIR__ . '../../src/Bootstrap.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPVP | Atualização de Rol de Membros</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/img/logo-fundo-branco.png" rel="icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>

<body>
    <div class="header">
        <img src="assets/img/logo_branco.svg" alt="logo-branco" width="100px" />
        <h3>Igreja Presbiteriana de Vila Prudente</h3>
        <h5>Atualização de Rol de Membros | Ano <?php echo date('Y'); ?></h5>
    </div>

    <div class="form-body">
        <form method="POST" id="formMembro" class="form">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>" />
            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="session">
                        <p>Este processo de atualização cadastral é realizado em conformidade com
                            a Constituição da Igreja Presbiteriana do Brasil, que atribui ao Conselho
                            da igreja local a responsabilidade pela organização, manutenção e atualização
                            do rol de membros, bem como pela administração da vida e da ordem da igreja.</p><br>

                        <p>As informações coletadas destinam-se exclusivamente a fins administrativos,
                            pastorais, estatísticos e eclesiásticos, sendo tratadas de acordo com a Lei Geral
                            de Proteção de Dados Pessoais (Lei nº 13.709/2018) e em observância às diretrizes
                            estabelecidas na Cartilha de Proteção de Dados da Igreja Presbiteriana do Brasil (LGPD IPB).</p><br>

                        <p>Para mais informações sobre a Política de Privacidade e Proteção de Dados da
                            Igreja Presbiteriana do Brasil, acesse <a href="https://ipb.org.br/politica-de-privacidade" target="_blank">
                            ipb.org.br/politica-de-privacidade</a>.</p><br>

                        <p>Dúvidas, solicitações ou pedidos relacionados aos dados pessoais poderão ser
                            encaminhados para o e-mail <b>conselhoipvp@gmail.com</b>.</p><br>

                        <p>As informações solicitadas abaixo devem ser preenchidas com atenção, responsabilidade
                            e veracidade. Os campos de preenchimento obrigatório estão identificados com um asterisco
                            vermelho (*). Em caso de dúvidas durante o preenchimento, procure um presbítero para
                            auxiliá-lo. Deus o abençoe.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="session">
                        <h6>Dados Pessoais</h6>
                        <p>______________</p>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="nome">Nome completo:<span class="required">*</span></label>
                        <input class="form-control" name="nome" id="nome" type="text" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="sexo">Sexo:<span class="required">*</span></label>
                        <select class="form-select" name="sexo" id="sexo" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="datanascimento">Data de Nascimento:<span class="required">*</span></label>
                        <input class="form-control" name="datanascimento" id="datanascimento" type="date" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="naturalidade">Naturalidade:<span class="required">*</span></label>
                        <input class="form-control" name="naturalidade" id="naturalidade" type="text" placeholder="Ex: São Paulo / SP" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <br>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="logradouro">Logradouro:<span
                                class="required">*</span></label>
                        <input class="form-control" name="logradouro" id="logradouro" type="text" placeholder="Ex: Rua Cananéia" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="numero">Número:<span class="required">*</span></label>
                        <input class="form-control" name="numero" id="numero" type="text" required />
                        <div class="form-check form-switch">
                            <input name="semnumero" type="hidden" value="0" />
                            <input class="form-check-input" name="semnumero" id="semnumero" type="checkbox" value="1" />
                            <label class="form-check-label" for="semnumero">Sem Número</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="complemento">Complemento:</label>
                        <input class="form-control" name="complemento" id="complemento" type="text" placeholder="Ex: Casa 1, Apartamento 191" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="bairro">Bairro:<span class="required">*</span></label>
                        <input class="form-control" name="bairro" id="bairro" type="text" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="cep">CEP:<span class="required">*</span></label>
                        <input class="form-control" name="cep" id="cep" type="text" placeholder="Somente números" oninput="mask(this, 'CEP')" maxlength="9" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="cidade">Cidade:<span class="required">*</span></label>
                        <input class="form-control" name="cidade" id="cidade" type="text" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="estado">Estado (UF):<span class="required">*</span></label>
                        <select class="form-select" name="estado" id="estado" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <br>
                    <p class="obs"><b>Observação:</b> Preencha pelos menos um campo de contato.</p>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="email">E-mail:</label>
                        <input class="form-control" name="email" id="email" type="text" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="cel">Celular:</label>
                        <input class="form-control" name="cel" id="cel" type="text" placeholder="Somente números com DDD" oninput="mask(this, 'CEL')" maxlength="15" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="fone">Telefone Fixo:</label>
                        <input class="form-control" name="fone" id="fone" type="text" placeholder="Somente números com DDD" oninput="mask(this, 'TEL')" maxlength="14" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="session">
                        <h6>Dados Complementares</h6>
                        <p>______________________</p>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="rg">RG:<span class="required">*</span></label>
                        <input class="form-control" name="rg" id="rg" type="text" placeholder="Somente números" oninput="mask(this, 'RG')" maxlength="12" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="cpf">CPF:<span class="required">*</span></label>
                        <input class="form-control" name="cpf" id="cpf" type="text" placeholder="Somente números" oninput="mask(this, 'CPF')" maxlength="14" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="estadocivil">Estado Civil:<span class="required">*</span></label>
                        <select class="form-select" name="estadocivil" id="estadocivil" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="1">Solteiro(a)</option>
                            <option value="2">Casado(a)</option>
                            <option value="3">Separado(a)</option>
                            <option value="4">Viúvo(a)</option>
                            <option value="5">Divorciado(a)</option>
                            <option value="6">União Estável</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="datacasamento">Data de Casamento / União:</label>
                        <input class="form-control" name="datacasamento" id="datacasamento" type="date" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="nomeconjuge">Nome do Cônjuge:</label>
                        <input class="form-control" name="nomeconjuge" id="nomeconjuge" type="text" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="nomemae">Nome da Mãe:</label>
                        <input class="form-control" name="nomemae" id="nomemae" type="text" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="nomepai">Nome do Pai:</label>
                        <input class="form-control" name="nomepai" id="nomepai" type="text" />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="escolaridade">Escolaridade:<span class="required">*</span></label>
                        <select class="form-select" name="escolaridade" id="escolaridade" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="1">Não Informado</option>
                            <option value="2">Não Alfabetizado</option>
                            <option value="3">Ensino Fundamental</option>
                            <option value="4">Ensino Médio</option>
                            <option value="5">Ensino Profissionalizante</option>
                            <option value="6">Ensino Superior</option>
                            <option value="7">Pós Graduação</option>
                            <option value="8">Mestrado</option>
                            <option value="9">Doutorado</option>
                            <option value="10">Pós Doutorado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="profissao">Profissão:<span class="required">*</span></label>
                        <input class="form-control" name="profissao" id="profissao" type="text" required />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="session">
                        <h6>Dados Eclesiásticos</h6>
                        <p>__________________</p>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="batizado">É batizado?<span class="required">*</span></label>
                        <select class="form-select" name="batizado" id="batizado" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="databatismo">Data de Batismo:</label>
                        <input class="form-control" name="databatismo" id="databatismo" type="date" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="pastorbatismo">Pastor de Batismo:</label>
                        <input class="form-control" name="pastorbatismo" id="pastorbatismo" type="text" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="igrejabatismo">Igreja de Batismo:</label>
                        <input class="form-control" name="igrejabatismo" id="igrejabatismo" type="text" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="profissaofe">Fez profissão de fé?<span class="required">*</span></label>
                        <select class="form-select" name="profissaofe" id="profissaofe" required>
                            <option value="" disabled selected>Selecione</option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="dataprofe">Data Profissão de Fé:</label>
                        <input class="form-control" name="dataprofe" id="dataprofe" type="date" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="pastorprofe">Pastor Profissão de Fé:</label>
                        <input class="form-control" name="pastorprofe" id="pastorprofe" type="text" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text" for="igrejaprofe">Igreja Profissão de Fé:</label>
                        <input class="form-control" name="igrejaprofe" id="igrejaprofe" type="text" disabled />
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div id="divAlerta" role="alert">
                        <span id="msgAlerta"></span>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xl-6">
                    <div class="session">
                        <br><p>Ao clicar em <b>Enviar</b>, o membro declara estar ciente e de acordo com o tratamento
                        de seus dados pessoais, conforme os termos acima.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <button type="submit" class=" form-control btn btn-sm btn-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="footer">
        <span><i class="fa-regular fa-envelope"></i> <a href="mailto:conselhoipvp@gmail.com">conselhoipvp@gmail.com</a> |
            <i class="fa-brands fa-instagram"></i> <a href="https://www.instagram.com/ipvilaprudente/" target="_blank">ipvilaprudente</a> |
            <i class="fa-brands fa-instagram"></i> <a href="https://www.instagram.com/ipjovens/" target="_blank">ipjovens</a></span>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/mask.js"></script>
    <script type="text/javascript" src="assets/js/toggleField.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
