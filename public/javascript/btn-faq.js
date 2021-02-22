function elementShow(id){
    
    let element = document.getElementById(id)
    element.classList.remove('display-none')

}

function elementHidden(id){

    let element = document.getElementById(id)
    element.classList.add('display-none')

}

function openAndClose(id_conteudo, id_cabecalho){

    let el_conteudo = document.getElementById(id_conteudo)
    let el_cabecalho = document.getElementById(id_cabecalho)

    elementShow(id_conteudo)
    el_cabecalho.addEventListener("click", () => {
        
        let classes = el_conteudo.className

        if(classes.indexOf('display-none') == -1){
            elementHidden(id_conteudo)
        } else{
            elementShow(id_conteudo)
        }
    })
}
// OPEN FAQ
function openFaq(id_conteudo, id_cabecalho){

    let el_cabecalho = document.getElementById(id_cabecalho)
    let el_conteudo = document.getElementById(id_conteudo)

    console.log(id_conteudo, id_cabecalho)

    switch(id_conteudo){
        case "q1":
            openAndClose(id_conteudo, id_cabecalho)
            break
        
        case "q2":
            openAndClose(id_conteudo, id_cabecalho)
            break
        
        case "q3":
            openAndClose(id_conteudo, id_cabecalho)
            break
        
        case "q4":
            openAndClose(id_conteudo, id_cabecalho)
    }

}