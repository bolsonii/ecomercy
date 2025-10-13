function validarCamposLoja() {
    const nomeInput = document.getElementById("nome_loja");
    const emailInput = document.getElementById("email-loja");
    const cepInput = document.getElementById("cep_loja");
    const fotoInput = document.getElementById("foto_capa_loja");

    if (
        !nomeInput.value.trim() ||
        !emailInput.value.trim() ||
        !cepInput.value.trim() ||
        fotoInput.files.length === 0
    ) {
        alert("Preencha todos os campos!");
        return false;
    }

    if (!/^\d+$/.test(cepInput.value.trim())) {
        alert("O CEP deve conter apenas números!");
        return false;
    }

    return true;
}

document.getElementById("criar_loja").addEventListener("click", function(event) {
    event.preventDefault();

    if (!validarCamposLoja()) {
        // Não salva nada e permanece na mesma página
        return;
    }

    salvarDadosLoja();

    alert("Loja criada com sucesso! Redirecionando...");

    window.location.href = "../../pages/lojas/lojas.html";
});

function salvarDadosLoja() {
    const nomeInput = document.getElementById("nome_loja");
    const emailInput = document.getElementById("email-loja");
    const cepInput = document.getElementById("cep_loja");
    const tipoSwitch = document.getElementById("storeTypeSwitch");
    const fotoInput = document.getElementById("foto_capa_loja");

    const dadosLoja = {
        nome: nomeInput.value,
        email: emailInput.value,
        cep: cepInput.value,
        // Verifica se o switch está marcado: 'Compra' se sim, 'Venda' se não
        tipo: tipoSwitch.checked ? "Compra" : "Venda",
        fotoCapa: fotoInput.files.length > 0 ? fotoInput.files[0].name : null
    };

    localStorage.setItem("dadosLoja", JSON.stringify(dadosLoja));
    
    console.log("Dados salvos no localStorage:", dadosLoja);
}

