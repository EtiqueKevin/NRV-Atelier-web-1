import * as ui from './ui.js';
import * as spectacle from './spectacle.js';
import * as users from './users.js';

export function handleNavButtons() {
    const navSpectacle = document.getElementById('nav-spectacle');
    if (navSpectacle) {
        navSpectacle.addEventListener('click', async () => {
            const data = await spectacle.getSpectacles();
            const lieux = await spectacle.getLieux();
            ui.displaySpectacleList(data, lieux);
        });
    }

    const navTitle = document.getElementById('nav-title');
    if (navTitle) {
        navTitle.addEventListener('click', () => {
            ui.displayHome();
        });
    }

    const navConnexion = document.getElementById('nav-connexion');
    if (navConnexion) {
        navConnexion.addEventListener('click', () => {
            ui.displayConnexion();
        });
    }

    const navDeconnexion = document.getElementById('nav-deconnexion');
    if (navDeconnexion) {
        navDeconnexion.addEventListener('click', () => {
            users.deconnexion();
            ui.displayHome();
            ui.displayNav(users.isConnected());
        });
    }

    const navPanier = document.getElementById('nav-panier');
    if (navPanier) {
        navPanier.addEventListener('click', async () => {
            const data = await users.getPanier();
            ui.displayPanier(data);
        });
    }
    
    const navBillets = document.getElementById('nav-billets');
    if (navBillets) {
        navBillets.addEventListener('click', async () => {
            const data = await users.getBillets();
            ui.displayBilletsList(data);
        });
    }
}

export function handleHomeSpectacleButton() {
    const homeSpectacle = document.getElementById('home-spectacle');
    if (homeSpectacle) {
        homeSpectacle.addEventListener('click', async () => {
            const data = await spectacle.getSpectacles();
            const lieux = await spectacle.getLieux();
            ui.displaySpectacleList(data, lieux);
        });
    }
}

export function handleSpectacleList(){
    const spectacles = document.getElementsByClassName('spectacle');
    for (const spectacle of spectacles) {
        const id = spectacle.getAttribute('data-id');

        spectacle.addEventListener('click', async () => {
            const data = await spectacle.getSoiree(id);
            const connected = users.isConnected();
            ui.displaySoiree(data, connected);
        });
    }
}

export function handleSearchForm() {
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const date = document.getElementById('search-date').value;
            const style = document.getElementById('search-style').value;
            const lieu = document.getElementById('search-lieu').value;
            const data = await spectacle.searchSpectacles(date, style, lieu);
            const lieux = await spectacle.getLieux();
            ui.displaySpectacleList(data, lieux);
        });
    }
}

export function handleConnexionForm() {
    const connexionButton = document.getElementById('submit-button');
    if (connexionButton) {
        connexionButton.addEventListener('click', async (event) => {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const user = await users.connexion(email, password);
            if (user) {
                ui.displayNav(users.isConnected());
                ui.displayHome();
            }
        });
    }

    const inscriptionButton = document.getElementById('inscription-button');
    if (inscriptionButton) {
        inscriptionButton.addEventListener('click', () => {
            ui.displayInscription();
        });
    } 
}

export function handleInscriptionForm() {
    const inscriptionButton = document.getElementById('submit-button');
    if (inscriptionButton) {
        inscriptionButton.addEventListener('click', async (event) => {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const password2 = document.getElementById('password-confirm').value;
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const user = await users.inscription(email, password, password2, nom, prenom);
            if (user) {
                ui.displayHome();
                ui.displayNav(users.isConnected());
            }
        });
    }

    const connexionButton = document.getElementById('connexion-button');
    if (connexionButton) {
        connexionButton.addEventListener('click', () => {
            ui.displayConnexion();  
        });
    }
}

export function handlePanier(){
    document.getElementById("myModal").addEventListener('click', function(event) {
        if (event.target === this) {
            this.style.display = "none";
            this.innerHTML = '';
        }
    });
    document.getElementById("close-button").addEventListener('click', function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
        modal.innerHTML = '';
    });
}

export function handleSoiree(){
    const submitButton = document.getElementById('submit-button');
    if (submitButton) {
        submitButton.addEventListener('click', async (event) => {
            event.preventDefault();
            const soireeId = document.getElementById('soiree-id').value;
            const qte = document.getElementById('quantite').value;
            const tarif = document.getElementById('tarif').value;
            const data = await users.addToPanier(soireeId, qte, tarif);
            ui.displayPanier(data);
        });
    }
}

export function handleBilletsList(){
    const billets = document.getElementsByClassName('billet');
    for (const billet of billets) {
        const id = billet.getAttribute('data-id');

        billet.addEventListener('click', async () => {
            const data = await users.getBillet(id);
            ui.displayBillet(data.billet);
        });
    }
}

export function handleBillet(){
    //todo
}