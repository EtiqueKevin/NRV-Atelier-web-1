import {loadData} from "./loader.js";
import { apiUrl } from "./data.js";

let lieux = [];

export async function getSpectacles() {
    const data = await loadData('/spectacles');
    return data.spectacles.map(item => {
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
    });
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

export async function searchSpectacles(date, style, lieu){
    let query = "";
    if (date) {
        query += `dates=${date}`;
    }
    if (style) {
        query += `&styles=${style}`;
    }
    if (lieu) {
        query += `&lieux=${lieu}`;
    }

    const data = await loadData(`/spectacles?${query}`);
    return data.spectacles.map(item => {
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
    });
}
