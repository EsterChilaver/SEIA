function janelaModal() {

    let modal = document.querySelector('.modal');
    let fundo = document.querySelector('.fundo-escuro');
    let menuUser = document.querySelector('#menu-usuario');
    let containerModal = document.querySelector('.conteiner-modal');

    modal.style.display = 'block';
    fundo.style.display = 'block';
    menuUser.style.display = 'none';
    containerModal.style.display = "flex";

}

function fecharModal() {
    let modal = document.querySelector('.modal');
    let fundo = document.querySelector('.fundo-escuro');
    let containerModal = document.querySelector('.conteiner-modal');

    modal.style.display = 'none';
    fundo.style.display = 'none';
    containerModal.style.display = "none";
}

/*exibe o menu do usuario*/

    function exibirMenu() {
        let modal = document.querySelector('#menu-usuario');
        let fundo = document.querySelector('.fundo-escuro');

        modal.style.display = 'flex';
        fundo.style.display = 'block';
    }

    function fecharMenu() {
        let modal = document.querySelector('#menu-usuario');
        let fundo = document.querySelector('.fundo-escuro');
        
        modal.style.display = 'none';
        fundo.style.display = 'none';
    }

