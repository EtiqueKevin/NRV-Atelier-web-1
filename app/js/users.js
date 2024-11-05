import * as loader from "./loader.js";
import * as jwt from './jwt.js';
import * as alert from './alert.js';

export async function connexion(email, password) {
    const data = await loader.connexionRequest(email, password);
    if (data){
        alert.showAlert('Connexion réussie', 'ok');
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

export function isAdmin(){
    if(localStorage.getItem('role') >= 2){
        return true;
    }else{
        return false;
    }
}

export function getRole(){
    return localStorage.getItem('role') || null;
}

export function deconnexion(){
    jwt.wipeTokens();
}

export async function getPanier(){
    const data = await loader.loadData('panier');

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    return {
        panier: data.panier,
        total: total
    };
}

export async function addToPanier(idSoiree, qte, tarif, categorie){
    const body = {
        "idSoiree": idSoiree,
        "qte": parseInt(qte),
        "tarif": parseFloat(tarif),
        "typeTarif": categorie
    };
    const data = await loader.postData('panier', body);

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    alert.showAlert('Billet(s) ajouté(s) au panier', 'ok');
    return {
        panier: data.panier,
        total: total
    };
}

export async function modifyPanier(idSoiree, qte, categorie){
    const body = {
        "idSoiree": idSoiree,
        "qte": parseInt(qte),
        "typeTarif": categorie
    };
    const data = await loader.putData('panier/modifier', body);

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    alert.showAlert('Panier modifié', 'ok');
    return {
        panier: data.panier,
        total: total
    };
}

export async function inscription(email, password, password2, nom, prenom) {
    const data = await loader.inscriptionRequest(email, password, password2, nom, prenom);

    if(data){
        await connexion(email, password);
    }
    alert.showAlert('Inscription réussie', 'ok');
    return data;
}

export async function getBillets(){
    const data = await loader.loadData('utilisateur/billets');
    return data;
}

export async function getBillet(id){
    const data = await loader.loadData(`utilisateur/billet/${id}`);
    return data;
}

export async function validerPanier(){
    const data = await loader.postData('panier/valider');

    let total = 0;
    data.panier.panierItems.forEach(item => {
        total += item.tarifTotal;
    });
    
    alert.showAlert('Panier validé', 'ok');
    return {
        panier: data.panier,
        total: total
    };
}

export async function payerCommande(codeCarte, dateExpiration, cvv){
    const body = {
        "numero": codeCarte,
        "date": dateExpiration,
        "code": cvv
    };
    await loader.postData('panier/payer', body);
    alert.showAlert('Paiement effectué', 'ok');
}