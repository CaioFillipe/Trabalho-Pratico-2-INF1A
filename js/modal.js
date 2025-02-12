$("#adicionar-livro").on('click', function(){
    $("#modal").get(0).style.display = "block";
});


$("#close").on('click', function(){
   $("#modal").get(0).style.display = "none";
});

window.addEventListener('click', function(event){
    if (event.target == $("#modal").get(0)) {
       $("#modal").get(0).style.display = "none";
    }
});
