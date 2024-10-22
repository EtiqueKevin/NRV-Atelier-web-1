import {loadData} from "./loader.js";
import { apiUrl } from "./data.js";

export async function getSpectacles() {
    console.log('getSpectacles');
    const data = await loadData('/spectacles');
    console.log(data);
    return data.spectacles.map(spectacle => ({
        id: spectacle.id,
        titre: spectacle.titre,
        description: spectacle.description,
        heure: spectacle.heure,
        urlVideo: spectacle.urlVideo,
        idSoiree: spectacle.idSoiree,
        image :  null//apiUrl + spectacle.image
    }));
}

export function getSoiree(id) {
    return loadData(`/soirees/${id}`);
}