function openGif(){
    let element = document.getElementById('gif')

    if(element.classList.contains('display-none')){
        element.classList.remove('display-none')
    } else{
        element.classList.add('display-none')
    }
}
