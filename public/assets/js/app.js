function preparaSaida($class, $resp) {
    if (divAlerta) divAlerta.className = $class;
    if (msgAlerta) msgAlerta.innerText = $resp;
}

function confirmaEnvio() {
    return confirm("Tem certeza que deseja enviar os dados? Caso queira revisar os campos, clique em CANCELAR.");
}

const formMembro = document.getElementById("formMembro");
const divAlerta = document.getElementById("divAlerta");
const msgAlerta = document.getElementById("msgAlerta");

if (divAlerta) divAlerta.className = "";
if (msgAlerta) msgAlerta.innerText = "";

if (formMembro) {
    formMembro.addEventListener("submit", async (e) => {
        if (!confirmaEnvio()) {
            e.preventDefault();
            return;
        }

        e.preventDefault();
        const dadosForm = new FormData(formMembro);

        try {
            const dados = await fetch("/api/membro.php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            const csrfInput = formMembro.querySelector('input[name="csrf_token"]');
            if (csrfInput && resposta['csrf_token']) {
                csrfInput.value = resposta['csrf_token'];
            }

            if (resposta['status']) {
                preparaSaida("alert alert-success", resposta['msg']);
                formMembro.reset();

            } else {
                preparaSaida("alert alert-danger", resposta['msg']);
            }
            
        } catch (error) {
            preparaSaida("alert alert-danger", "Erro ao processar envio.\nContate o administrador.");
            console.log(error);
        }
    });
}
