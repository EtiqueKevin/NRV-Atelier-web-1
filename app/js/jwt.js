function storeTokens(accessToken, refreshToken) {
    localStorage.setItem('accessToken', accessToken);
    localStorage.setItem('refreshToken', refreshToken);
}

function getAccessToken() {
    return localStorage.getItem('accessToken');
}

function getRefreshToken() {
    return localStorage.getItem('refreshToken');
}

function wipeTokens(){
    localStorage.removeItem('accessToken');
    localStorage.removeItem('refreshToken');
}

export { storeTokens, getAccessToken, getRefreshToken, wipeTokens };