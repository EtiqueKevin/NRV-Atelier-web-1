import {loadData, postData} from "./loader.js";
import { apiUrl } from "./data.js";

let lieux = [];
let styles = [];

export async function getSpectacles() {
    const data = await loadData('/spectacles');
    return {
        spectacles: data.spectacles.map(item => {
            const spectacle = item.spectacle;
            return {
                id: spectacle.id,
                titre: spectacle.titre,
                description: spectacle.description,
                heure: spectacle.heure,
                urlVideo: spectacle.urlVideo,
                idSoiree: spectacle.idSoiree,
                image: spectacle.imgs && spectacle.imgs.length > 0 ? spectacle.imgs.map(img => apiUrl + img) : null
            };
        }),
        links: data.links,
        page: data.page
    };
}

export async function getSpectaclesByUrl(url) {
    const data = await loadData(url);
    return {
        spectacles: data.spectacles.map(item => {
            const spectacle = item.spectacle;
            return {
                id: spectacle.id,
                titre: spectacle.titre,
                description: spectacle.description,
                heure: spectacle.heure,
                urlVideo: spectacle.urlVideo,
                idSoiree: spectacle.idSoiree,
                image: spectacle.imgs && spectacle.imgs.length > 0 ? spectacle.imgs.map(img => apiUrl + img) : null
            };
        }),
        links: data.links,
        page: data.page
    };
}

export async function getSpectacle(href) {
    const data = await loadData(href);
    const artistes = await Promise.all(data.links.artistes.map(async link => await getArtiste(link.href)));
    return {
        spectacle: {
            id: data.spectacle.id,
            titre: data.spectacle.titre,
            description: data.spectacle.description,
            heure: data.spectacle.heure,
            urlVideo: data.spectacle.urlVideo,
            image: data.spectacle.imgs && data.spectacle.imgs.length > 0 ? data.spectacle.imgs.map(img => apiUrl + img) : null
        },
        artistes: artistes
    };
}

export async function getArtiste(href) {
    const data = await loadData(href);
    return {
        nom : data.artiste.nom,
        prenom : data.artiste.prenom,
        description : data.artiste.description,
    }
}

export async function getArtistes() {
    const data = await loadData('/artistes');
    return data.artistes.map(item => {
        return {
            id: item.id,
            nom: item.nom,
            prenom: item.prenom,
            description: item.description
        };
    });
}

export async function getSoiree(id) {
    const data = await loadData(`/soirees/${id}`);
    const spectacles = await Promise.all(data.links.spectacles.map(async link => await getSpectacle(link.href)));
    return {
        id: data.soiree.id,
        nom: data.soiree.nom,
        thematique: data.soiree.thematique,
        date: data.soiree.date,
        lieu: {
            id: data.soiree.lieu.id,
            nom: data.soiree.lieu.nom,
            adresse: data.soiree.lieu.adresse,
            places_assise: data.soiree.lieu.places_assise,
            places_debout: data.soiree.lieu.places_debout
        },
        tarif_normal: data.soiree.tarif_normal,
        tarif_reduit: data.soiree.tarif_reduit,
        spectacles: spectacles
    };
}

export async function getSoirees() {
    const data = await loadData('/soirees');
    return {
        soirees: data.soirees.map(item => {
            return {
                id: item.id,
                nom: item.nom,
                thematique: item.thematique,
                date: item.date,
                lieu: {
                    id: item.lieu.id,
                    nom: item.lieu.nom,
                    adresse: item.lieu.adresse,
                    places_assise: item.lieu.places_assise,
                    places_debout: item.lieu.places_debout
                },
                tarif_normal: item.tarif_normal,
                tarif_reduit: item.tarif_reduit
            };
        }),
    };
}

export async function getLieux() {
    if (lieux.length > 0) {
        return lieux;
    }
    const data = await loadData('/lieux');
    return data.lieux.map(item => {
        return {
            id: item.id,
            nom: item.nom
        };
    });
}

export async function getStyles() {
    if (styles.length > 0) {
        return styles;
    }

    const data = await loadData('/styles');
    return data.styles;
}

export async function getReservations(id) {
    const data = await loadData(`/backoffice/soirees/${id}`);

    return {
        reserver : data.placeSoiree.nbPlaceReserve,
        total : data.placeSoiree.nbPlacett
    }
}

export async function addSoiree(nom, date, lieu, theme, tarifN, tarifR) {
    const body = {
        "nom": nom,
        "date": date,
        "lieu": lieu,
        "tarif_normal": parseInt(tarifN),
        "tarif_reduit": parseInt(tarifR),
        "thematique": theme
    };
    await postData('/soirees', body);
}

export async function addSpectacle(nom, heure, soiree, description, urlVideo, image, artists) {
    const formData = new FormData();
    formData.append('titre', nom);
    formData.append('heure', heure);
    formData.append('idSoiree', soiree);
    formData.append('description', description);
    formData.append('url_video', urlVideo);
    formData.append('images', image);
    formData.append('artistes', JSON.stringify(artists));

    await postData('/spectacles', formData, true);
}