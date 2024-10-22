import Handlebars from 'handlebars';
import * as eventHandler from './handlers.js';
import * as templates from './templates.js';
import * as spectacle from './spectacle.js';

export function displayHome() {
    const template = Handlebars.compile(templates.homeTemplate);
    const html = template();
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleHomeSpectacleButton();
}

export async function displaySpectacleList() {
    const data = await spectacle.getSpectacles();
    const template = Handlebars.compile(templates.listeSpectacleTemplate);
    const html = template({ spectacles: data });
    document.getElementById('main-content').innerHTML = html;
    eventHandler.handleSpectacleList();
}

export async function displaySoiree(id) {
    const data = await spectacle.getSoiree(id);
    const template = Handlebars.compile(templates.soireeTemplate);
    const html = template(data);
    document.getElementById('main-content').innerHTML = html;
}