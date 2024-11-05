import { apiUrl } from "./data.js";
import * as jwt from './jwt.js';

async function refreshAccessToken() {
    const refreshToken = jwt.getRefreshToken();
    if (!refreshToken) {
        throw new Error('No refresh token available');
    }

    const response = await fetch(apiUrl + '/utilisateur/refresh', {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Authorization': `Bearer ${refreshToken}`,
        },
    });

    if (response.ok) {
        const data = await response.json();
        jwt.storeTokens(data.atoken, refreshToken);
        return data.atoken;
    } else {
        throw new Error('Failed to refresh token');
    }
}

async function connexionRequest(email, password) {
    const credentials = btoa(`${email}:${password}`);
    const response = await fetch(apiUrl + 'utilisateur/signin', {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Authorization': `Basic ${credentials}`,
        }
    });

    if (!response.ok) {
        throw new Error('Reponse non ok');
    }

    const data = await response.json();
    jwt.storeData(data.atoken, data.rtoken, data.role);
    return data;
};

async function inscriptionRequest(email, password, password2, nom, prenom) {
    const body = {
        "nom": nom,
        "prenom": prenom,
        "email": email,
        "mdp": password,
        "mdp2": password2
    };

    const response = await fetch(apiUrl + 'utilisateur/signup', {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    });

    if (!response.ok) {
        throw new Error('Reponse non ok');
    }

    const data = await response;
    return data.ok;
    
};

async function loadData(url) {
    try {
        let accessToken = jwt.getAccessToken();
        const headers = {};

        if (accessToken) {
            headers['Authorization'] = `Bearer ${accessToken}`;
        }

        const response = await fetch(apiUrl + url, {
            mode: 'cors',
            headers: headers,
        });

        if (!response.ok) {
            if (response.status === 401) {
                let accessToken = await refreshAccessToken();
                headers['Authorization'] = `Bearer ${accessToken}`;
                const newResponse = await fetch(apiUrl + url, {
                    mode: 'cors',
                    headers: headers,
                });

                if (!newResponse.ok) {
                    throw new Error(`HTTP error, status: ${newResponse.status}, message: ${newResponse.statusText}`);
                }
                let data = await newResponse.json();
                return data;
            }
            throw new Error(`HTTP error, status: ${response.status}, message: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        throw new Error('Erreur lors de la récupération des données: ' + error.message);
    }
};

async function postData(url, body, isFormData = false) {
    try {
        let accessToken = jwt.getAccessToken();
        const headers = {};

        if (accessToken) {
            headers['Authorization'] = `Bearer ${accessToken}`;
        }

        if (!isFormData) {
            headers['Content-Type'] = 'application/json';
            body = JSON.stringify(body);
        }

        const response = await fetch(apiUrl + url, {
            method: 'POST',
            mode: 'cors',
            headers: headers,
            body: body,
        });

        if (!response.ok) {
            if (response.status === 401 && accessToken) {
                accessToken = await refreshAccessToken();
                return await loadData(url);
            }
            throw new Error(`HTTP error, status: ${response.status}, message: ${response.statusText}`);
        }
        const responseText = await response.text();
        try {
            return JSON.parse(responseText);
        } catch (e) {
            return responseText;
        }
    } catch (error) {
        throw new Error('Erreur lors de l\'envoi des données: ' + error.message);
    }
};

async function putData(url, body) {
    try {
        let accessToken = jwt.getAccessToken();
        const headers = {};

        if (accessToken) {
            headers['Authorization'] = `Bearer ${accessToken}`;
        }

        headers['Content-Type'] = 'application/json';

        const response = await fetch(apiUrl + url, {
            method: 'PUT',
            mode: 'cors',
            headers: headers,
            body: JSON.stringify(body),
        });

        if (!response.ok) {
            if (response.status === 401 && accessToken) {
                accessToken = await refreshAccessToken();
                return await loadData(url);
            }
            throw new Error(`HTTP error, status: ${response.status}, message: ${response.statusText}`);
        }
        const responseText = await response.text();
        try {
            return JSON.parse(responseText);
        } catch (e) {
            return responseText;
        }
    } catch (error) {
        throw new Error('Erreur lors de l\'envoi des données: ' + error.message);
    }
};

export { loadData,putData, postData, connexionRequest, inscriptionRequest };