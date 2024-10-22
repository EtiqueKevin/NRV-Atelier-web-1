export const homeTemplate = `
  <section class="home-section">
    <h2>Bienvenue au NRV Festival</h2>
    <p>Découvrez les spectacles les plus incroyables et vivez des moments inoubliables.</p>
    <button class="boutton" id="home-spectacle">Voir les spectacles</button>
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
        <input type="text" id="search-lieu" name="search-lieu" placeholder="Enter lieu">
      </div>      
  
      <button type="submit" class="search-button">Search</button>
    </form>
  </section>
  <section class="grid grid-col-4 gap-4" id="liste-spectacle">
    {{#each spectacles}}
      <div data-id="{{this.id}}" class="spectacle-card spectacle">
        {{#if this.image}}
          <img src="{{this.image}}" alt="Spectacle Image">
        {{else}}
          <img src="/public/default-spectacle.png" alt="Default Spectacle Image">
        {{/if}}
        <article>
          <h2>{{this.titre}}</h2>
          <p>Description: {{this.description}}</p>
          <p>Date: {{this.heure}}</p>
        </article>
      </div>
    {{/each}}
  </section>
`;

export const soireeTemplate = `
  <div class="soiree-card">
    <h2>{{nomSoiree}}</h2>
    <p>Thématique: {{thematique}}</p>
    <p>Date et horaire: {{dateHoraire}}</p>
    <p>Lieu: {{lieu}}</p>
    <p>Tarifs:</p>
    <ul>
      <li>Normal: {{tarifNormal}}</li>
      <li>Réduit: {{tarifReduit}}</li>
    </ul>
  </div>
`;

export const spectacleSoireeTemplate = `
  {{#each spectacles}}
  <div class="spectacle-card-horizontal">
    <img src="{{imageSrc}}" alt="image spectacle">
    <article>
      <h2>{{titre}}</h2>
      <p>{{description}}</p>
      <p>{{styleMusique}}</p>
      <p>{{video}}</p>
    </article>
    <section>
      <h2>Artistes</h2>
      <ul>
        {{#each artistes}}
        <li>{{this}}</li>
        {{/each}}
      </ul>
    </section>
  </div>
  {{/each}}
`;