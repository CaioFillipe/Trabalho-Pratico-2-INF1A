let botaoAdicionarLivroEl = document.getElementById("adicionar-livro");
let janelaModal = document.getElementById("modal");
let botaoFecharJanelaEl = document.getElementById("close");

botaoAdicionarLivroEl.addEventListener('click', () => {
    janelaModal.style.display = "block";
});


botaoFecharJanelaEl.addEventListener('click', () => {
   janelaModal.style.display = "none";
});

window.addEventListener('click', (event) => {
    if (event.target == janelaModal) {
       janelaModal.style.display = "none";
    }
});
