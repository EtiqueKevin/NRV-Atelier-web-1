import { apiUrl } from "./data.js";
import * as jwt from './jwt.js';

async function refreshAccessToken() {
    const refreshToken = jwt.getRefreshToken();
    if (!refreshToken) {
        throw new Error('No refresh token available');
    }

    const response = await fetch(apiUrl + '/utilisateur/refresh', {
        mode: 'cors',
        headers: {
            'Authorization': `Bearer ${refreshToken}`,
        },
    });

    if (response.ok) {
        const data = await response.json();
        jwt.storeTokens(data.accessToken, refreshToken);
        return data.accessToken;
    } else {
        throw new Error('Failed to refresh token');
    }
}

async function connexionRequest(email, password) {
    const credentials = btoa(`${email}:${password}`);
    const response = await fetch(apiUrl + '/utilisateur/signin', {
        mode: 'cors',
        headers: {
            'Authorization': `Basic ${credentials}`,
        }
    });

    if (!response.ok) {
        throw new Error('Reponse non ok');
    }

    const data = await response.json();
    jwt.storeTokens(data.atoken, data.rtoken);
    return data;
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
            if (response.status === 401 && accessToken) {
                accessToken = await refreshAccessToken();
                return await loadData(url);
            }
            throw new Error(`HTTP error, status: ${response.status}, message: ${response.statusText}`);
        }
        return await response.json();
    } catch (error) {
        console.error(error);
    }
};

export { loadData, connexionRequest };