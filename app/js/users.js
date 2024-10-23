import { connexionRequest, loadData, inscriptionRequest } from "./loader.js";
import * as jwt from './jwt.js';

export async function connexion(email, password) {
    const data = await connexionRequest(email, password);
    if (data){
        return true;
    }
    return false;
}

export function isConnected() {
    if(localStorage.getItem('accessToken')){
        return true;
    }else{
        return false;
    }
}

export function deconnexion(){
    jwt.wipeTokens();
}

export async function getPanier(){
    const data = await loadData('/panier');

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    return {
        panier: data.panier,
        total: total
    };
}

export async function inscription(email, password, password2, nom, prenom) {
    const data = await inscriptionRequest(email, password, password2, nom, prenom);

    if(data){
        await connexion(email, password);
    }
    return data;
}