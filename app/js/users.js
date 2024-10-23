import * as loader from "./loader.js";
import * as jwt from './jwt.js';

export async function connexion(email, password) {
    const data = await loader.connexionRequest(email, password);
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
    const data = await loader.loadData('/panier');

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    return {
        panier: data.panier,
        total: total
    };
}

export async function addToPanier(idSoiree, qte, tarif){
    const body = {
        "idSoiree": idSoiree,
        "qte": qte,
        "tarif": tarif
    };
    await loader.postData('/panier', body);
}

export async function inscription(email, password, password2, nom, prenom) {
    const data = await loader.inscriptionRequest(email, password, password2, nom, prenom);

    if(data){
        await connexion(email, password);
    }
    return data;
}