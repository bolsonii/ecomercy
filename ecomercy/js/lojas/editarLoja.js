
    document.addEventListener("DOMContentLoaded", function() {

        const dadosSalvosJSON = localStorage.getItem('dadosLoja');
        //Converte a string JSON de volta para um objeto JavaScript.
        const dadosLoja = JSON.parse(dadosSalvosJSON);

        const formWrapper = document.getElementById('form-wrapper');
        const avisoSemLoja = document.getElementById('sem-loja-aviso');

        // Verifica se existe uma loja salva no localStorage.
        if (dadosLoja) {
            // Se a loja existe, preenchemos o formulário com os dados dela.
            avisoSemLoja.classList.add('d-none');
            formWrapper.classList.remove('d-none');
            
            //Preenche cada campo do formulário com o valor correspondente do objeto 'dadosLoja'.
            document.getElementById("nome_loja").value = dadosLoja.nome;
            document.getElementById("email-loja").value = dadosLoja.email;
            document.getElementById("cep_loja").value = dadosLoja.cep;

            document.getElementById("storeTypeSwitch").checked = (dadosLoja.tipo === "Compra");
            
            // Exibe o nome do arquivo de imagem que está salvo.
            // É importante notar que, por segurança, navegadores não permitem pré-selecionar um arquivo em um input type="file".
            // Por isso, apenas mostramos o nome do arquivo atual para o usuário saber qual imagem está associada.
            if (dadosLoja.fotoCapa) {
                document.getElementById("arquivo-atual").textContent = `Arquivo atual: ${dadosLoja.fotoCapa}`;
            }

        } else {
            // Se a loja NÃO existe, mostramos o aviso e escondemos o formulário.
            formWrapper.classList.add('d-none'); // Esconde o formulário
            avisoSemLoja.classList.remove('d-none'); // Mostra o aviso
            return;
        }


        // FUNÇÃO PARA SALVAR AS ALTERAÇÕES ---
        document.getElementById("salvar_alteracoes").addEventListener("click", function() {
            const fotoInput = document.getElementById("foto_capa_loja");

            // Cria um novo objeto com os dados atualizados do formulário.
            const lojaAtualizada = {
                nome: document.getElementById("nome_loja").value,
                email: document.getElementById("email-loja").value,
                cep: document.getElementById("cep_loja").value,
                tipo: document.getElementById("storeTypeSwitch").checked ? "Compra" : "Venda",
                // Lógica para a imagem:
                // Se o usuário selecionou um NOVO arquivo (fotoInput.files.length > 0), usamos o nome do novo arquivo.
                // Se não, mantemos o nome do arquivo que já estava salvo (dadosLoja.fotoCapa).
                fotoCapa: fotoInput.files.length > 0 ? fotoInput.files[0].name : dadosLoja.fotoCapa
            };

            // Salva o objeto atualizado de volta no localStorage, sobrescrevendo o antigo.
            localStorage.setItem("dadosLoja", JSON.stringify(lojaAtualizada));

            alert("Alterações salvas com sucesso!");
            window.location.href = "lojas.html"; 
        });


        // FUNÇÃO PARA EXCLUIR A LOJA ---
        
        document.getElementById("excluir_loja").addEventListener("click", function() {
            
            // Pede uma confirmação ao usuário antes de prosseguir. Isso é CRUCIAL para evitar exclusões acidentais.
            // A função 'confirm()' mostra uma caixa de diálogo com "OK" e "Cancelar".
            // O código dentro do 'if' só executa se o usuário clicar em "OK".
            if (confirm("Tem certeza que deseja excluir sua loja? Esta ação não pode ser desfeita.")) {
                
                localStorage.removeItem("dadosLoja");
                alert("Sua loja foi excluída.");
                window.location.href = "lojas.html";
            }
        });
    });