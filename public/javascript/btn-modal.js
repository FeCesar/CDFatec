function openModal(id){

    let modal = document.getElementById(id)
    modal.classList.add('is-active')

}

function closeModal(id){

    let modal = document.getElementById(id)
    modal.classList.toggle('is-active')

}