document.getElementById("entrar").addEventListener('click', function(){
    login();
});
async function login(){
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;

    const fd = new FormData();
    fd.append("email", email);
    fd.append("senha", senha);

    const retorno = await fetch("./php/login.php",{
        method: "POST",
        body: fd
    });


    const resposta = await retorno.json();
    console.log(resposta);

    // Repositório LOCALSTORAGE 

    localStorage.setItem("sessao",JSON.stringify(resposta));

    // Deu certo!
    window.location.href = "./home/home.html";
}