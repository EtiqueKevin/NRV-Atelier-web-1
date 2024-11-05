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

    const navBackOffice = document.getElementById('nav-backoffice');
    if (navBackOffice) {
        navBackOffice.addEventListener('click', async () => {
            try {
                ui.displayBackOffice();
            } catch (error) {
                showAlert("Erreur lors de l'affichage du backoffice", 'error');
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
                    ui.displayNav(users.isConnected(), users.isAdmin());
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

    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');
    if (passwordInput && togglePasswordButton) {
        togglePasswordButton.addEventListener('mousedown', () => {
            passwordInput.type = 'text';
        });

        togglePasswordButton.addEventListener('mouseup', () => {
            passwordInput.type = 'password';
        });

        togglePasswordButton.addEventListener('mouseleave', () => {
            passwordInput.type = 'password';
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

    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');
    const togglePasswordButton = document.getElementById('toggle-password');
    const togglePasswordConfirmButton = document.getElementById('toggle-password-confirm');

    if (passwordInput && togglePasswordButton) {
        togglePasswordButton.addEventListener('mousedown', () => {
            passwordInput.type = 'text';
        });

        togglePasswordButton.addEventListener('mouseup', () => {
            passwordInput.type = 'password';
        });

        togglePasswordButton.addEventListener('mouseleave', () => {
            passwordInput.type = 'password';
        });
    }

    if (passwordConfirmInput && togglePasswordConfirmButton) {
        togglePasswordConfirmButton.addEventListener('mousedown', () => {
            passwordConfirmInput.type = 'text';
        });

        togglePasswordConfirmButton.addEventListener('mouseup', () => {
            passwordConfirmInput.type = 'password';
        });

        togglePasswordConfirmButton.addEventListener('mouseleave', () => {
            passwordConfirmInput.type = 'password';
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
                const categorie = event.target.getAttribute('data-categorie');
                const qte = document.getElementById(`qte-${idSoiree}-${categorie}`).value;
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
                ui.displayHome();
            } catch (error) {
                showAlert('Erreur lors du paiement', 'error');
            }
        });
    }
}

export async function handleBackOffice(){
    const addSpectacleButton = document.getElementById('add-spectacle');
    if (addSpectacleButton) {
        addSpectacleButton.addEventListener('click', async () => {
            try {
                const soirees = await spectacle.getSoirees();
                const artists = await spectacle.getArtistes();
                ui.displayBackOfficeAddSpectacle(soirees, artists);
            } catch (error) {
                showAlert('Erreur lors de la récupération des données pour ajouter un spectacle', 'error');
            }
        });
    }

    const addSoireeButton = document.getElementById('add-soiree');
    if (addSoireeButton) {
        addSoireeButton.addEventListener('click', async () => {
            try {
                const locations = await spectacle.getLieux();
                const themes = await spectacle.getStyles();
                ui.displayBackOfficeAddSoiree(locations, themes);
            } catch (error) {
                showAlert('Erreur lors de la récupération des données pour ajouter une soirée', 'error');
            }
        });
    }
}

export async function handleBackOfficeAddSoiree(){
    const addbutton = document.getElementById('add-soiree-boutton');
    if (addbutton) {
        addbutton.addEventListener('click', async () => {
            try {
                const nom = document.getElementById('show-name').value;
                const date = document.getElementById('show-time').value;
                const theme = document.getElementById('show-theme').value;
                const lieu = document.getElementById('show-location').value;
                const tarifNormal = document.getElementById('show-tarifN').value;
                const tarifReduit = document.getElementById('show-tarifR').value;

                await spectacle.addSoiree(nom, date,lieu, theme, tarifNormal, tarifReduit);
                ui.displayBackOffice();
            } catch (error) {
                showAlert('Erreur lors de l\'ajout de la soirée', 'error');
            }
        });
    }
}

export async function handleBackOfficeAddSpectacle(){
    const addSpectacleButton = document.getElementById('ajouter-spectacle-boutton');
    if (addSpectacleButton) {
        addSpectacleButton.addEventListener('click', async () => {
            try {
                const nom = document.getElementById('show-name').value;
                const heure = document.getElementById('show-time').value;
                const soiree = document.getElementById('show-evening').value;
                const description = document.getElementById('show-description').value;
                const urlVideo = document.getElementById('show-urlvideo').value;
                const image = document.getElementById('show-image').files[0];
                const artists = Array.from(document.querySelectorAll('input[name="show-artists"]:checked')).map(artist => artist.value);

                await spectacle.addSpectacle(nom, heure, soiree, description, urlVideo, image, artists);
                ui.displayBackOffice();
            } catch (error) {
                showAlert('Erreur lors de l\'ajout du spectacle', 'error');
            }
        });
    }
}