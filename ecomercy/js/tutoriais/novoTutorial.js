document.getElementById('enviar').addEventListener('click', function(){
    if (armazenarTutorial()) {
        window.location.href = "../../pages/tutoriais/tutoriais.html";
    }
});

function armazenarTutorial(){
    const listaTutoriais = JSON.parse(localStorage.getItem('listaTutoriais')) || [];

    // CORREÇÃO: Padronizando o nome da propriedade para 'titulo'.
    const obj = {titulo: "", descricao: "", categoria: ""};

    // CORREÇÃO: O ID do input no HTML é 'titulo'.
    obj.titulo = document.getElementById("titulo").value;
    obj.descricao = document.getElementById("descricao").value;

    // Validar se os campos não estão vazios
    if (obj.titulo.trim() === "" || obj.descricao.trim() === "") {
        alert("Por favor, preencha o título и a descrição.");
        return false; // Impede o salvamento
    }

    const radioSelecionado = document.querySelector('input[name="categorias"]:checked');
    if(radioSelecionado){
        obj.categoria = radioSelecionado.value;
    } else {
        alert("Por favor, selecione uma categoria.");
        return false; // Impede o salvamento
    }
    
    listaTutoriais.push(obj);
    localStorage.setItem("listaTutoriais", JSON.stringify(listaTutoriais));
    return true; // Sucesso
};