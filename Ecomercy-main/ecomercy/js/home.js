document.addEventListener("DOMContentLoaded", () => {
    if(localStorage.getItem("sessao")){
        document.getElementById("retorno").innerHTML = JSON.parse(localStorage.getItem("sessao")).email
    }else{
        window.location.href = "../login.html";
    }
});