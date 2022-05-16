function janelaModal() {

    let modal = document.querySelector('.modal');
    let fundo = document.querySelector('.fundo-escuro');

    modal.style.display = 'block';
    fundo.style.display = 'block';

}

function fecharModal () {
    let modal = document.querySelector('.modal');
    let fundo = document.querySelector('.fundo-escuro');

    modal.style.display = 'none';
    fundo.style.display = 'none';
}