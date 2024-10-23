export const homeTemplate = `
  <section class="home-section">
    <div id="home-title">
      <h1>Bienvenue au NRV Festival 2024</h1>
    </div>
    <div id="home-description">
      <p>Découvrez les spectacles les plus incroyables et vivez des moments inoubliables.</p>
      <button class="color-button" id="home-spectacle">Voir les spectacles</button>
    </div>
  </section>
`;

export const listeSpectacleTemplate = `
  <section class="search-form">
    <form id="search-form">
      <div class="input-container">
        <label for="search-date">Date:</label>
        <input type="date" id="search-date" name="search-date">
      </div>
      
      <div class="input-container">
        <label for="search-style">Style:</label>
        <input type="text" id="search-style" name="search-style" placeholder="Enter style">
      </div>
      
      <div class="input-container">
        <label for="search-lieu">Lieu:</label>
        <select id="search-lieu" name="search-lieu">
          <option value="" disabled selected>Choisir un lieu</option>
          {{#each lieu}}
            <option value="{{this.id}}">{{this.nom}}</option>
          {{/each}}
        </select>
      </div>
      
      <button type="submit" class="color-button">Search</button>
    </form>
  </section>
  {{#if spectacles.length}}
    <section class="grid grid-col-4-l grid-col-3-m grid-col-2-s grid-col-1-xs gap-2" id="liste-spectacle">
      {{#each spectacles}}
        <div data-id="{{this.idSoiree}}" class="spectacle-card-hover spectacle">
          {{#if this.image.length}}
            <img src="{{this.image.[0]}}" alt="Spectacle Image"  loading="lazy">
          {{else}}
            <img src="/public/default-spectacle.jpg" alt="Default Spectacle Image"  loading="lazy">
          {{/if}}
          <article>
            <h2>{{this.titre}}</h2>
            <p>Date: {{this.heure}}</p>
          </article>
        </div>
      {{/each}}
    </section>
  {{else}}
    <p>Aucun spectacle trouvé pour les critères de recherche.</p>
  {{/if}}
`;

export const soireeTemplate = `
  <section class="soiree-card">
    <h2>{{nom}}</h2>
    <p>Thématique: {{thematique}}</p>
    <p>Date : {{date}}</p>
    <p>Lieu: {{lieu.nom}}, {{lieu.adresse}}</p>
    <p>Tarifs:</p>
    <ul>
      <li>Normal: {{tarif_normal}}</li>
      <li>Réduit: {{tarif_reduit}}</li>
    </ul>
  </section>

  <section class="grid grid-col-3-l grid-col-2-m grid-col-1-xs gap-4" id="liste-spectacle">
    {{#each spectacles}}
      <div data-id="{{this.spectacle.id}}" class="spectacle-card spectacle">
        {{#if this.spectacle.image.length}}
          <img src="{{this.spectacle.image.[0]}}" alt="Spectacle Image"  loading="lazy">
        {{else}}
          <img src="/public/default-spectacle.jpg" alt="Default Spectacle Image"  loading="lazy">
        {{/if}}
        <article>
          <h2>{{this.spectacle.titre}}</h2>
          <p>Date: {{this.spectacle.heure}}</p>
          <p>{{this.spectacle.description}}</p>
          <iframe width="560" height="315" src="{{this.spectacle.urlVideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </article>
        <article>
          <h2>Artistes</h2>
          <ul>
            {{#each this.artistes}}
              <li>{{this.prenom}} {{this.nom}} - {{this.description}}</li>
            {{/each}}
          </ul>
        </article>
      </div>
    {{/each}}
  </section>
`;

export const connexionTemplate = `
  <section class="connexion-card">
    <h1>Connexion</h1>
    <form class="connexion-form">
      <div class="input-container">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="email" required autocomplete="email">
      </div>
      <div class="input-container">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
      </div>
      <button type="button" id="submit-button" class="boutton">Connexion</button>
    </form>
    <button id="inscription-button" class="secondary-form-button">S'inscrire</button>
  </section>
`;

export const inscriptionTemplate = `
  <section class="connexion-card">
    <h1>Inscription</h1>
    <form class="connexion-form">
      <div class="input-container">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" placeholder="Nom" required autocomplete="family-name">
      </div>
      <div class="input-container">
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" placeholder="Prénom" required autocomplete="given-name">
      </div>
      <div class="input-container">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="email" required autocomplete="email">
      </div>
      <div class="input-container">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
      </div>
      <div class="input-container">
        <label for="password-confirm">Confirmer mot de passe:</label>
        <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirmer mot de passe" required autocomplete="current-password">
      </div>
      <button type="button" id="submit" class="boutton">Inscription</button>
    </form>
    <button id="connexion-button" class="secondary-form-button">Se connecter</button>
  </section>
`;

export const navRightTemplate = `
  <li>
    <button class="boutton" id="nav-spectacle">
      <i class="fa-solid fa-compact-disc"></i>
      Spectacles
    </button>
  </li>
  {{#if connected}}
    <li>
     <button class="boutton" id="nav-billets">
      <i class="fa-solid fa-ticket"></i>
      Mes Billets
     </button>
    </li>
    <li>
      <button class="boutton" id="nav-deconnexion">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Déconnexion
      </button>
    </li>
  {{else}}
    <li>
      <button class="boutton" id="nav-connexion">
        <i class="fa-regular fa-circle-user"></i>
        Connexion
      </button>
    </li>
  {{/if}}
`;