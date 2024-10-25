import * as ui from './ui.js';
import * as spectacle from './spectacle.js';
import * as users from './users.js';
import { showAlert } from './alert.js';

function getSearchParams(page) {
    const date = document.getElementById('search-date').value;
    const style = document.getElementById('search-style').value;
    const lieu = document.getElementById('search-lieu').value;

    let query = '';
    if (date) {
        query += `dates=${date}`;
    }

    if (style) {
        query += `${query ? '&' : ''}styles=${style}`;
    }

    if (lieu) {
        query += `${query ? '&' : ''}lieux=${lieu}`;
    }

    if (page) {
        const pageElement = document.getElementById('nb-page');
        const pageId = pageElement ? pageElement.getAttribute('data-id') : null;
        if (pageId) {
            query += `${query ? '&' : ''}page=${pageId}`;
        }
    }
    return query;
}


export function handleNavButtons() {
    const navSpectacle = document.getElementById('nav-spectacle');
    if (navSpectacle) {
        navSpectacle.addEventListener('click', async () => {
            try {
                const data = await spectacle.getSpectacles();
                const lieux = await spectacle.getLieux();
                const styles = await spectacle.getStyles();
                ui.displaySearchList(lieux, styles);
                ui.displaySpectacleList(data);
            } catch (error) {
                showAlert('Erreur lors de la récupération des spectacles', 'error');
            }
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
            try {
                const data = await users.getPanier();
                ui.displayPanier(data);
            } catch (error) {
                showAlert("Erreur lors de l'affichage du panier", 'error');
            }
        });
    }
    
    const navBillets = document.getElementById('nav-billets');
    if (navBillets) {
        navBillets.addEventListener('click', async () => {
            try {
                const data = await users.getBillets();
                ui.displayBilletsList(data);
            } catch (error) {
                showAlert("Erreur lors de l'affichage des billets", 'error');
            }
        });
    }
}

export function handleHomeSpectacleButton() {
    const homeSpectacle = document.getElementById('home-spectacle');
    if (homeSpectacle) {
        homeSpectacle.addEventListener('click', async () => {
            try {
                const data = await spectacle.getSpectacles();
                const lieux = await spectacle.getLieux();
                const styles = await spectacle.getStyles();
                ui.displaySearchList(lieux, styles);
                ui.displaySpectacleList(data);
            } catch (error) {
                showAlert('Erreur lors de la récupération des spectacles', 'error');
            }
        });
    }
}

export function handleSpectacleList(){
    const spectacles = document.getElementsByClassName('spectacle');
    for (const spectacleItem of spectacles) {
        const id = spectacleItem.getAttribute('data-id');

        spectacleItem.addEventListener('click', async () => {
            try {
                const data = await spectacle.getSoiree(id);
                const connected = users.isConnected();
                if (users.getRole() > 0) {
                    const reservations = await spectacle.getReservations(id);
                    ui.displaySoiree(data, connected, reservations);
                    return;
                }
                ui.displaySoiree(data, connected);
            } catch (error) {
                showAlert("Erreur lors de l'affichage de la soiree", 'error');
            }
        });
    }
    const previousPageButton = document.getElementById('previous-page');
    if (previousPageButton) {
        previousPageButton.addEventListener('click', async () => {
            try {
                let url = previousPageButton.getAttribute('data-url');
                url = url + '&' + getSearchParams(false);
                const data = await spectacle.getSpectaclesByUrl(url);
                ui.displaySpectacleList(data);
            } catch (error) {
                showAlert('Erreur lors de la récupération des spectacles', 'error');
            }
        });
    }

    const nextPageButton = document.getElementById('next-page');
    if (nextPageButton) {
        nextPageButton.addEventListener('click', async () => {
            try {
                let url = nextPageButton.getAttribute('data-url');
                url = url + '&' + getSearchParams(false);
                const data = await spectacle.getSpectaclesByUrl(url);
                ui.displaySpectacleList(data);
            } catch (error) {
                showAlert('Erreur lors de la récupération des spectacles', 'error');
            }
        });
    }
}

export function handleSearchForm() {
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            try {
                const url = '/spectacles?' + getSearchParams(true);
                const data = await spectacle.getSpectaclesByUrl(url);
                ui.displaySpectacleList(data);
            } catch (error) {
                showAlert('Erreur lors de la recherche', 'error');
            }
        });
    }
}

export function handleConnexionForm() {
    const connexionButton = document.getElementById('submit-button');
    if (connexionButton) {
        connexionButton.addEventListener('click', async (event) => {
            event.preventDefault();
            try {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const user = await users.connexion(email, password);
                if (user) {
                    ui.displayNav(users.isConnected());
                    ui.displayHome();
                }
            } catch (error) {
                showAlert('Erreur lors de la connexion', 'error');
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
            try {
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
            } catch (error) {
                showAlert("Erreur lors de l'inscription", 'error');
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

export function handleModal(){
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

export function handlePanier(){
    const payerPanierButton = document.getElementById('payer-panier-button');
    if (payerPanierButton) {
        payerPanierButton.addEventListener('click', async () => {
            ui.displayPaiement();
        });
    }

    const validerPanierButton = document.getElementById('valider-panier-button');
    if (validerPanierButton) {
        validerPanierButton.addEventListener('click', async () => {
            try {
                const data = await users.validerPanier();
                ui.displayPanier(data);
            } catch (error) {
                showAlert('Impossible de valider le panier', 'error');
            }
        });
    }

    const qteButtons = document.getElementsByClassName('modify-qte-button');
    for (const qteButton of qteButtons) {
        qteButton.addEventListener('click', async (event) => {
            try {
                const idSoiree = event.target.getAttribute('data-id');
                const qte = document.getElementById(`qte-${idSoiree}`).value;
                const categorie = event.target.getAttribute('data-categorie');
                const data = await users.modifyPanier(idSoiree, qte, categorie);
                ui.displayPanier(data);
            } catch (error) {
                showAlert('Erreur lors de la mise à jour du panier', 'error');
            }
        });
    }
}

export function handleSoiree(){
    const submitButton = document.getElementById('submit-button');
    if (submitButton) {
        submitButton.addEventListener('click', async (event) => {
            event.preventDefault();
            try {
                const soireeId = document.getElementById('soiree-id').value;
                const qte = document.getElementById('quantite').value;
                const tarif = document.getElementById('tarif').value;
                const categorieTarif = document.getElementById('tarif').selectedOptions[0].getAttribute('data-categorie');
                const data = await users.addToPanier(soireeId, qte, tarif, categorieTarif);
                ui.displayPanier(data);
            } catch (error) {
                showAlert('Impossible de rajouter le billet au panier', 'error');
            }
        });
    }
}

export function handleBilletsList(){
    const billets = document.getElementsByClassName('billet');
    for (const billet of billets) {
        const id = billet.getAttribute('data-id');

        billet.addEventListener('click', async () => {
            try {
                const data = await users.getBillet(id);
                ui.displayBillet(data);
            } catch (error) {
                showAlert('Erreur lors du chargement du billet', 'error');
            }
        });
    }
}

export function handleBillet(){
    const printButton = document.getElementById('print');
    if (printButton) {
        printButton.addEventListener('click', () => {
            const billetElement = document.querySelector('.modal-billet');
            if (billetElement) {
                window.print();
            }
        });
    }
}

export async function handlePaiement(){
    const paiementBoutton = document.getElementById('paiement-boutton');
    if (paiementBoutton) {
        paiementBoutton.addEventListener('click', async () => {
            try {
                const codeCarte = document.getElementById('card-number').value;
                const dateExpiration = document.getElementById('expiry-date').value;
                const cvv = document.getElementById('cvv').value;
                await users.payerCommande(codeCarte, dateExpiration, cvv);
            } catch (error) {
                showAlert('Erreur lors du paiement', 'error');
            }
        });
    }
}