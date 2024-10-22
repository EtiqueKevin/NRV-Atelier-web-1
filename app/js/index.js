import {displayHome} from './ui.js';
import {handleNavButtons} from './handlers.js';

async function init(){
    handleNavButtons();
    displayHome();
}

window.addEventListener('load', init);