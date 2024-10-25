import Handlebars from 'handlebars';
import * as eventHandler from './handlers.js';
import * as templates from './templates.js';

export function displayHome() {
    const template = Handlebars.compile(templates.homeTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleHomeSpectacleButton();
}

export function displaySearchList(lieux, styles) {
    const template = Handlebars.compile(templates.searchFormTemplate);
    const html = template({ lieu: lieux, styles: styles });
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleSearchForm();
}

export function displaySpectacleList(data) {
    const template = Handlebars.compile(templates.listeSpectacleTemplate);
    const html = template({ spectacles: data});
    document.getElementById('list-spectacle').innerHTML = html;
    eventHandler.handleSpectacleList();
}

export function displaySoiree(data, connected, backOffice) {
    console.log(backOffice);
    const template = Handlebars.compile(templates.soireeTemplate);
    const html = template({ soiree: data, connected: connected, backoffice: backOffice});
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleSoiree();
}

export function displayConnexion() {
    const template = Handlebars.compile(templates.connexionTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleConnexionForm();
}

export function displayInscription() {
    const template = Handlebars.compile(templates.inscriptionTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleInscriptionForm();
}

export function displayNav(connected, backOffice) {
    const template = Handlebars.compile(templates.navRightTemplate);
    const html = template({ connected, backOffice });
    document.getElementsByClassName('nav-right')[0].innerHTML = html;
    eventHandler.handleNavButtons();
}

export function displayPanier(data) {
    console.log(data);
    const template = Handlebars.compile(templates.panierTemplate);
    const html = template({ data });
    const modal = document.getElementById('myModal');
    modal.innerHTML = html;

    eventHandler.handleModal();
    eventHandler.handlePanier();

    modal.style.display = 'block';
}

export function displayBilletsList(data) {
    const template = Handlebars.compile(templates.listeBilletTemplate);
    const html = template({ billets: data.billets });
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleBilletsList();
}

export function displayBillet(data) {
    const template = Handlebars.compile(templates.billetDetailTemplate);
    const html = template({ billet: data.billet, acheteur: data.acheteur });
    const modal = document.getElementById('myModal');
    modal.innerHTML = html;

    eventHandler.handleModal();
    eventHandler.handleBillet();

    modal.style.display = 'block';
}

export function displayPaiement(){
    const template = Handlebars.compile(templates.payerTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handlePaiement();

    const modal = document.getElementById('myModal');
    modal.style.display = 'none';
}