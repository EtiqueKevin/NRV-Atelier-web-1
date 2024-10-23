import {displayHome, displayNav} from './ui.js';

async function init(){
    displayNav();
    displayHome();
}

window.addEventListener('load', init);