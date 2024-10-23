import { connexionRequest } from "./loader.js";
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