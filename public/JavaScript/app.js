window.addEventListener('scroll', () => { /* récuperation de la valeur du scroll) */
    const body = document.querySelector("body"); /* selec balise (body) */
    const nav = document.querySelector("nav");
    if(window.scrollY > 30 ){ /* Si la valeur du scroll est supperrieur à 30px */
        nav.classList.add("bg-light");
    }
    else{
        nav.classList.remove("bg-light");
    }
})
