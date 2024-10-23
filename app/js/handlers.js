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
            ui.displayNav();
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
        const dataId = spectacle.getAttribute('data-id');

        spectacle.addEventListener('click', () => {
            ui.displaySoiree(dataId);
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
                ui.displayNav();
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
    const inscriptionForm = document.getElementById('inscription-form');
    if (inscriptionForm) {
        inscriptionForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const user = await user.inscription(email, password, nom, prenom);
            if (user) {
                ui.displayHome();
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
