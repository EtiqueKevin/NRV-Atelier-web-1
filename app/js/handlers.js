import * as ui from './ui.js';

export function handleNavButtons() {
    const navSpectacle = document.getElementById('nav-spectacle');
    if (navSpectacle) {
        navSpectacle.addEventListener('click', () => {
            ui.displaySpectacleList();
        });
    }

    const navTitle = document.getElementById('nav-title');
    if (navTitle) {
        navTitle.addEventListener('click', () => {
            ui.displayHome();
        });
    }

    // reste des boutons de navigation
}

export function handleHomeSpectacleButton() {
    const homeSpectacle = document.getElementById('home-spectacle');
    if (homeSpectacle) {
        homeSpectacle.addEventListener('click', () => {
            ui.displaySpectacleList();
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

