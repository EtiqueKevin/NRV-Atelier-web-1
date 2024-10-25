import {displayHome, displayNav} from './ui.js';
import { isConnected, isAdmin } from './users.js';
import Handlebars from 'handlebars';

async function init(){
    // register le helper eq pour handlebars (comparaison de string)
    Handlebars.registerHelper('eq', function(arg1, arg2, options) {
        return (arg1 == arg2) ? options.fn(this) : options.inverse(this);
    });

    // afficher la nav et la page d'accueil
    displayNav(isConnected(), isAdmin());
    displayHome();
}

window.addEventListener('load', init);