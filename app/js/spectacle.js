import {loadData} from "./loader.js";
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
