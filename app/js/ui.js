import Handlebars from 'handlebars';
import * as eventHandler from './handlers.js';
import * as templates from './templates.js';
import * as spectacle from './spectacle.js';
import * as users from './users.js';

export function displayHome() {
    const template = Handlebars.compile(templates.homeTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleHomeSpectacleButton();
}

export async function displaySpectacleList(data, lieux) {
    const template = Handlebars.compile(templates.listeSpectacleTemplate);
    const html = template({ spectacles: data, lieu: lieux });
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleSpectacleList();
    eventHandler.handleSearchForm();
}

export async function displaySoiree(id) {
    const connected = users.isConnected();
    const data = await spectacle.getSoiree(id);
    const template = Handlebars.compile(templates.soireeTemplate);
    const html = template({soiree : data, connected : connected});
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleSoiree();
}

export async function displayConnexion() {
    const template = Handlebars.compile(templates.connexionTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleConnexionForm();
}

export async function displayInscription() {
    const template = Handlebars.compile(templates.inscriptionTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleInscriptionForm();
}

export async function displayNav() {
    const connected = users.isConnected();
    const template = Handlebars.compile(templates.navRightTemplate);
    const html = template({ connected });
    document.getElementsByClassName('nav-right')[0].innerHTML = html;
    eventHandler.handleNavButtons();
}

export async function displayPanier() {
    const data = await users.getPanier();
    
    const template = Handlebars.compile(templates.panierTemplate);
    const html = template({data});
    var modal = document.getElementById('myModal');
    modal.innerHTML = html;

    eventHandler.handlePanier();

    modal.style.display = 'block';
}

export async function displayBilletsList() {
    const data = await users.getBillets();
    const template = Handlebars.compile(templates.listeBilletTemplate);
    const html = template({billets: data.billets});
    document.getElementById('main-content').innerHTML = html;
}