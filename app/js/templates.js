export const homeTemplate = `
  <section class="home-section">
    <div id="home-title">
      <h1>Bienvenue au Nancy Rock Vibration Festival 2024</h1>
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
        <select id="search-style" name="search-style">
          <option value="" disabled selected>Choisir un Style</option>
          {{#each styles}}
            <option value="{{this}}">{{this}}</option>
          {{/each}}
        </select>
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
  {{#if spectacles.spectacles.length}}
    <section class="grid grid-col-4-l grid-col-3-m grid-col-2-s grid-col-1-xs gap-2" id="liste-spectacle">
      {{#each spectacles.spectacles}}
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

    <div class="pagination">
      {{#if spectacles.links.previous}}
        <button class="color-button" id="previous-page" data-url="spectacles.links.previous.href"><i class="fa-solid fa-arrow-right"></i></button>
      {{/if}}
      <p> {{spectacles.page}} </p>
      {{#if spectacles.links.next}}
        <button class="color-button" id="next-page" data-url="spectacles.links.next.href"><i class="fa-solid fa-arrow-right"></i></button>
      {{/if}}
    </div>
  {{else}}
    <p>Aucun spectacle trouvé pour les critères de recherche.</p>
  {{/if}}
`;

export const soireeTemplate = `
  <section class="soiree-card">
    <div id="soiree-info">
      <h2>{{soiree.nom}}</h2>
      <p>Thématique: {{soiree.thematique}}</p>
      <p>Date : {{soiree.date}}</p>
      <p>Lieu: {{soiree.lieu.nom}}, {{soiree.lieu.adresse}}</p>
      <p>Tarifs:</p>
      <ul>
        <li>Normal: {{soiree.tarif_normal}} €</li>
        <li>Réduit: {{soiree.tarif_reduit}} €</li>
      </ul>
      {{#if backoffice}}
        <div class="gauge-container">
          <label for="gauge">Réservations:</label>
          <progress id="gauge" class="custom-gauge" value="{{backoffice.reserver}}" max="{{backoffice.total}}"></progress>
          <span>{{backoffice.reserver}} / {{backoffice.total}}</span>
        </div>
      {{/if}}
    </div>
    {{#if connected}}
      <div id="add-to-cart-form">
        <form>
          <input type="hidden" id="soiree-id" name="soiree-id" value="{{soiree.id}}">
          <div class="input-container">
            <label for="quantite">Nombre de billets:</label>
            <input type="number" id="quantite" name="quantity" value="1" min="1" required>
          </div>
          <div class="input-container">
            <label for="tarif">Sélectionnez le tarif:</label>
            <select id="tarif" name="tarif" required>
              <option value="{{soiree.tarif_normal}}" data-categorie="N">Normal</option>
              <option value="{{soiree.tarif_reduit}}" data-categorie="R">Réduit</option>
            </select>
          </div>
          <button type="button" class="boutton" id="submit-button">Ajouter au panier</button>
        </form>
      </div>
    {{/if}}
  </section>

  <section class="grid grid-col-3-l grid-col-2-m grid-col-1-xs gap-4" id="liste-spectacle">
    {{#each soiree.spectacles}}
      <div data-id="{{this.spectacle.id}}" class="spectacle-card spectacle">
        {{#if this.spectacle.image.length}}
          <img src="{{this.spectacle.image.[0]}}" alt="Spectacle Image" loading="lazy">
        {{else}}
          <img src="/public/default-spectacle.jpg" alt="Default Spectacle Image" loading="lazy">
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
      <button type="button" id="submit-button" class="boutton">Inscription</button>
    </form>
    <button id="connexion-button" class="secondary-form-button">Se connecter</button>
  </section>
`;

export const navRightTemplate = `
  <li>
    <button class="boutton-nav" id="nav-spectacle">
      <i class="fa-solid fa-compact-disc"></i>
      <span>Spectacles</span>
    </button>
  </li>
  {{#if connected}}
    <li>
     <button class="boutton-nav" id="nav-billets">
      <i class="fa-solid fa-ticket"></i>
      <span>Mes Billets</span>
     </button>
    </li>
    <li>
     <button class="boutton-nav" id="nav-panier">
      <i class="fa-solid fa-basket-shopping"></i>
      <span>Panier</span>
     </button>
    </li>
    <li>
      <button class="boutton-nav" id="nav-deconnexion">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Déconnexion</span>
      </button>
    </li>
  {{else}}
    <li>
      <button class="boutton-nav" id="nav-connexion">
        <i class="fa-regular fa-circle-user"></i>
        <span>Connexion</span>
      </button>
    </li>
  {{/if}}
`;

export const panierTemplate = `
  <div class="modal-panier">
    <span id="close-button">&times;</span>
    <h1>Panier</h1>
    <div class="grid grid-col-4 panier-card">
      <div class="header-grid">Nom</div>
      <div class="header-grid">Quantité</div>
      <div class="header-grid">Prix unitaire</div>
      <div class="header-grid">Prix</div>
      {{#if data.panier.valide}}
        {{#each data.panier.panierItems}}
          <div>{{this.soiree.nom}}</div>
          <div class="quantity-container">
            {{this.qte}}
          </div>
          <div>{{this.tarif}} €</div>
          <div>{{this.tarifTotal}} €</div>
        {{/each}}
      {{else}}
        {{#each data.panier.panierItems}}
          <div>{{this.soiree.nom}}</div>
          <div class="quantity-container">
            <input type="number" value="{{this.qte}}" min="1" id="qte-{{this.soiree.id}}">
            <button class="modify-qte-button" data-id="{{this.soiree.id}}"><i class="fa-regular fa-square-check"></i> Modifier</button>
          </div>
          <div>{{this.tarif}} €</div>
          <div>{{this.tarifTotal}} €</div>
        {{/each}}
      {{/if}}
      <div class="col-span-4"></div>
      <div class="col-span-3">Total</div>
      <div id="total-price">{{data.total}} €</div>
    </div>
    {{#if data.panier.valide}}
      <button class="boutton" id="payer-panier-button">Valider et Payer Commande</button>
    {{else}}
      <button class="boutton" id="valider-panier-button">Valider Panier</button>
    {{/if}}
  </div>
`;

export const listeBilletTemplate = `
  {{#if billets.length}}
    <section class="grid grid-col-2 grid-col-1-xs gap-2">
      {{#each billets}}
        <div class="billet" data-id="{{id}}">
          <h2>Billet n°{{id}}</h2>
          <div class="billet-info">
            <p>Soirée: {{nomSoiree}}</p>
            <p>Date: {{dateDebut}}</p>
            <p>
              {{#eq categorie_tarif "N"}}
                <p>Catégorie Tarif: normal</p>
              {{else}}
                <p>Catégorie Tarif: réduit</p>
              {{/eq}}
            </p>
          </div>
        </div>
      {{/each}}
    </section>
  {{else}}
    <h1>Aucun billet trouvé</h1>
  {{/if}}
`;

export const billetDetailTemplate = `
  <div class="modal-billet">
    <span id="close-button">&times;</span>
    <div class="billet-content">
      <h1>Billet n°{{billet.id}}</h1>
      <h3>Billet pour la soirée {{billet.nomSoiree}}</h3>
      <p>Nom de l'acheteur: {{acheteur.nom}} {{acheteur.prenom}}</p>
      <p>Date et horaire de la soirée: {{billet.dateDebut}}</p>
      <p>
        {{#eq billet.categorie_tarif "N"}}
          <p>Catégorie Tarif: normal</p>
        {{else}}
          <p>Catégorie Tarif: réduit</p>
        {{/eq}}
      </p>
      <button id="print" class="boutton">
        <i class="fa-solid fa-print"></i> Imprimer
      </button>
    </div>
  </div>
`;

export const payerTemplate = `
  <section class="connexion-card">
    <h2>Formulaire de Paiement</h2>
    <form class="connexion-form">
      <div class="input-container">
        <label for="card-number">Numéro de Carte:</label>
        <input type="text" id="card-number" name="card-number" pattern="\\d{16}" maxlength="16" required>
      </div>
      <div class="input-container">
        <label for="expiry-date">Date d'Expiration:</label>
        <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/AA" required>
      </div>
      <div class="input-container">
        <label for="cvv">Code de Validation (CVV):</label>
        <input type="text" id="cvv" name="cvv" pattern="\\d{3}" maxlength="3" required>
      </div>
      <button class="boutton" id="paiement-boutton">Payer</button>
    </form>
  </section>
`;
