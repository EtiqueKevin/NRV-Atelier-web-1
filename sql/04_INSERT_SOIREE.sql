\list
\c soirees

INSERT INTO lieux (id, nom, adresse, places_assises, places_debout) VALUES
('46a81617-272a-47b7-83ee-65780c5e91fa','Place Carnot', '1ter Pl. Carnot, 54000 Nancy', 50, 1500),
('48368a86-69fa-4756-8a51-847e285927c1','Place de la Carrière', 'Pl. de la Carrière, 54000 Nancy', 20, 500),
('7049372e-2a88-4bcd-b2e2-80c872cd661a','Parc de la Pépinière', 'Parc de la pepinière, 54000 Nancy', 200, 5000),
('e22df51e-7eb0-43b9-b6c3-4bfdda9f3362','Parc des expositions', 'Rue Catherine Opalinska, 54500 Vandœuvre-lès-Nancy', 500, 10000);

INSERT INTO spectacles (id, titre, description, heure, url_video) VALUES
('14e701bf-a9b2-4037-93fa-c86bcbdc24d5', 'Rock en Fusion', 'Un mélange explosif de rock alternatif et de performances visuelles pour une soirée pleine d’énergie et de vibrations.', '20:00:00','https://www.youtube.com/embed/JSC9ENc78mg'),
('bd3883fc-5e7d-4309-af2d-7194374e030d', 'Les Légendes du Rock', 'Un hommage aux plus grands groupes de rock des années 70 à aujourd’hui, avec des reprises et des performances enflammées.', '21:00:00','https://www.youtube.com/embed/34CZjsEI1yU'),
('a750a2b2-7f13-4208-80f8-071df46afd31', 'Electric Storm', 'Plongez dans une tempête sonore de riffs puissants et de rythmes endiablés, un spectacle incontournable pour les amateurs de rock.', '22:00:00','https://www.youtube.com/embed/i9BupglHdtM'),
('7ed62eed-29e2-472f-96d3-7e94e5f9d37e', 'Revolution Rock', 'Un concert dédié aux icônes du rock contestataire, avec des messages forts et des sons bruts qui ont marqué des générations.', '20:30:00','https://www.youtube.com/embed/Ld37nwZz1RQ'),
('19a5896c-29f5-4275-ad0d-e5499d1cb682', 'Hard Rock Heroes', 'Un spectacle où les plus grands titres du hard rock sont revisités par des musiciens talentueux pour une soirée intense.', '21:30:00','https://www.youtube.com/embed/_vmxUvN5GXE'),
('c8a9348f-32a3-41b9-897c-6362e53d0233', 'Rock Revival', 'Redécouvrez l’énergie brute du rock classique avec des groupes qui réinterprètent les sons légendaires des années 60 et 70.', '19:30:00','https://www.youtube.com/embed/v4xZUr0BEfE'),
('48960340-6122-4494-8654-90227afb4f86', 'Indie Rock Vibes', 'Une soirée dédiée aux groupes émergents de la scène indie rock, avec des mélodies accrocheuses et des paroles introspectives.', '20:45:00','https://www.youtube.com/embed/NLPyySN9Czw'),
('f38c904d-5c31-4173-970a-fe6a36872b65', 'Rock & Roll Circus', 'Un spectacle où le rock rencontre le cirque avec des performances scéniques spectaculaires et une musique entraînante.', '22:15:00','https://www.youtube.com/embed/ceYKKNXFpSE'),
('21e8e3ae-3023-4ca1-a1b9-6f9550fe909b', 'Guitars on Fire', 'Les meilleurs guitaristes de la scène rock se réunissent pour une soirée de solos incroyables et de prouesses musicales.', '21:15:00','https://www.youtube.com/embed/lXI12OqFf1E'),
('59ba6c47-93b6-4206-b50f-d192a2d3e12c', 'Heavy Rock Night', 'Préparez-vous pour une nuit de rock lourd avec des groupes qui repoussent les limites du son et de l’énergie.', '23:00:00','https://www.youtube.com/embed/StZcUAPRRac'),
('fc5bd0a0-cc7e-4421-8418-ecd8d58b91fa', 'Punk Revolution', 'Un hommage à la scène punk underground avec des groupes qui jouent à toute vitesse et avec toute l’énergie brute du genre.', '19:45:00','https://www.youtube.com/embed/ojvFp3ywbMw'),
('8f9d3f5d-36b7-4268-afb5-edb1bbb5e092', 'Grunge Revival', 'Les sons sombres et lourds du grunge des années 90 reviennent à la vie avec des groupes qui reprennent les classiques et apportent leurs propres touches.', '20:15:00','https://www.youtube.com/embed/eciJ-ercyPU'),
('83b852a4-bfb1-46ab-a0fc-556d8d9421c0', 'Metal Mayhem', 'Une nuit dédiée aux fans de heavy metal avec des riffs puissants, des rythmes écrasants et une énergie féroce.', '21:00:00','https://www.youtube.com/embed/G4lTMOmH8Dw'),
('d813c3d6-8ca8-45e4-afe8-4af86ec82cc3', 'Alternative Rock Wave', 'Une sélection des meilleurs groupes de rock alternatif actuels pour une soirée de découvertes musicales intenses.', '20:30:00','https://www.youtube.com/embed/6lnnPnr_0SU'),
('0c02d78e-b108-4c60-8050-62ffa75521d7', 'Psychedelic Rock Jam', 'Un voyage musical à travers des sons psychédéliques et des improvisations qui captivent l’esprit et les sens.', '21:45:00','https://www.youtube.com/embed/tKlVYJTSzuU'),
('2451dd38-f426-442a-ba7d-245dd6c7f716', 'Garage Rock Riot', 'Une soirée brutale et sans compromis avec des groupes de garage rock jouant des morceaux pleins d’énergie brute.', '22:30:00','https://www.youtube.com/embed/qVHyl0P_P-M'),
('483bbd62-16ea-4421-a1ba-7431d951fea4', 'Rock Symphony', 'Une fusion unique de rock et d’orchestre symphonique pour une expérience musicale épique.', '19:00:00','https://www.youtube.com/embed/VpATBBRajP8'),
('ca7ac1fd-f10a-42d0-bcc5-3f530b335a8c', 'Post-Rock Journey', 'Un concert immersif de post-rock où les sons atmosphériques et les textures musicales créent une expérience transcendante.', '20:45:00','https://www.youtube.com/embed/DxkeOkaVRLo'),
('b25c563c-05e9-4971-80d1-50268d83a0f3', 'Stadium Rock Legends', 'Les grands hymnes de rock chantés à plein poumon dans une ambiance survoltée, pour une soirée de légende.', '21:30:00','https://www.youtube.com/embed/yJDBmP9Mexk'),
('86743a46-ce57-4f21-8395-6195a81c30cd', 'Rockabilly Night', 'Un retour aux racines du rock avec une soirée dédiée au rockabilly, un mélange de country et de rock’n’roll.', '22:00:00','https://www.youtube.com/embed/wPJyz0KvudE'),
('03b3f911-74c6-4918-8a65-bc2e6eadac16', 'Post-Punk Echoes', 'Un hommage aux pionniers du post-punk, où les sons sombres et introspectifs résonnent encore aujourd’hui.', '19:30:00','https://www.youtube.com/embed/CSvFpBOe8eY'),
('1768429e-af60-414f-995a-9dd2803fefc1', 'Southern Rock Spirit', 'Une soirée sous le signe du rock sudiste avec des solos de guitare endiablés et des hymnes épiques.', '20:15:00','https://www.youtube.com/embed/BjL2r2FoYcM'),
('a82f7b34-4eb3-480c-a81a-edd3d5f4a4a7', 'Noise Rock Attack', 'Préparez-vous à une décharge sonore brute et sans compromis avec des groupes de noise rock aux expérimentations sonores inédites.', '21:45:00','https://www.youtube.com/embed/VOXOdflScCY'),
('b774871d-dfc9-4417-97cf-ff16ca69fc95', 'Psychedelic Rock Odyssey', 'Un voyage sonore à travers des paysages psychédéliques avec des guitares vibrantes et des voix hypnotiques.', '22:30:00','https://www.youtube.com/embed/R_uS0aT0bG8'),
('a4718fd9-7631-4298-b4af-c18ab46c0e58', 'Rock Anthem Showdown', 'Les plus grands hymnes de rock repris par des groupes de talents pour une soirée de classiques inoubliables.', '19:45:00','https://www.youtube.com/embed/3Ct7lPB-ut0'),
('d5db6f51-cca1-4f64-9821-9d3f0cdf1d00', 'Blues Rock Legends', 'Une soirée où le blues rencontre le rock dans un cocktail explosif de rythmes et de solos poignants.', '21:30:00','https://www.youtube.com/embed/E1Tf9PySS2I'),
('c2ba1db2-638e-4f86-a88f-804f65ee1a28', 'Space Rock Voyage', 'Un concert planant avec des sons venus d’ailleurs, où le rock s’aventure dans l’espace avec des effets sonores cosmique.', '22:00:00','https://www.youtube.com/embed/GCHeNLit3EE'),
('a5841bf1-55f5-4d23-b7fe-2b3a1cdd389f', 'Rockumentary Live', 'Un concert-événement qui retrace l’histoire du rock à travers des performances en live et des images d’archives.', '20:30:00','https://www.youtube.com/embed/kwJTpJjLJi4'),
('ae7b64c6-6f21-4f50-b98a-e68ef2af7f79', 'Industrial Rock Machines', 'Le rock rencontre les sons métalliques de l’industrie dans un show mécanique et brutal.', '21:45:00','https://www.youtube.com/embed/NxviGrBMKKY'),
('fdadf72e-1e41-49b4-94a2-739da9dd3c0e', 'Shoegaze Dreams', 'Des guitares vaporeuses et des voix rêveuses pour une soirée de shoegaze envoûtante.', '20:15:00','https://www.youtube.com/embed/e7kJRGPgvRQ'),
('17c6db99-8532-44e4-8368-378b3d20d1b4', 'Rock Rebels', 'Un concert des groupes les plus rebelles de la scène rock, avec des performances qui défient toutes les conventions.', '19:00:00','https://www.youtube.com/embed/bc0sJvtKrRM'),
('ac130890-7f80-42e1-8fcb-e7fc7b54a32f', 'Glam Rock Glamour', 'Une soirée étincelante avec des performances glam rock pleines de paillettes et de décadence.', '22:15:00','https://www.youtube.com/embed/oRkRwL0vjOg'),
('e65b4a7e-79d9-4f68-bb3d-70d2f7f2bbba', 'Sludge Rock Attack', 'Un mur de son lourd et viscéral pour les fans de sludge rock, avec des rythmes lents et écrasants.', '23:00:00','https://www.youtube.com/embed/mIMgSVuW0y0'),
('a36db2c4-2f67-47a9-9d87-54dc9b2e1a90', 'Prog Rock Adventure', 'Plongez dans des morceaux longs et complexes avec des groupes de rock progressif qui vous emmènent dans un voyage musical épique.', '20:00:00','https://www.youtube.com/embed/1JZGFjufJEY'),
('d0f7c1b2-3b89-4e96-9f0f-9d3f8e91fcfa', 'Post-Grunge Soundscapes', 'Un retour aux années post-grunge avec des groupes qui s’inspirent de l’héritage de cette époque tout en y apportant des sons modernes.', '20:30:00','https://www.youtube.com/embed/TcePkwagNFA'),
('75837c5e-3b7d-4513-b8f0-8c2f7364c071', 'Desert Rock Vibes', 'Un voyage sonore à travers le rock du désert avec des groupes qui capturent la chaleur et l’intensité du son.', '21:15:00','https://www.youtube.com/embed/8ZXBm1NXBaI'),
('ef305b4b-7c9f-41d9-880e-dfb4121dfd09', 'Acoustic Rock Sessions', 'Les plus grands morceaux de rock revisités en version acoustique pour une soirée intime et émotionnelle.', '19:45:00','https://www.youtube.com/embed/nzKWbpSNkmk'),
('ba3c49b7-6ca1-4999-b520-fcfbf3d14807', 'Garage Punk Mayhem', 'Une explosion sonore brute et rapide avec des groupes de garage punk qui mettent l’accent sur l’énergie et l’attitude.', '20:00:00','https://www.youtube.com/embed/KkM4DnKr0AU'),
('06ab32cb-f1f3-4c2d-bb65-2cb91f4f2fb3', 'Rock Ballads Night', 'Une soirée dédiée aux plus belles ballades rock, avec des performances acoustiques et des moments forts en émotions.', '21:00:00','https://www.youtube.com/embed/nd0DtRU6M_c'),
('8b420d23-d928-44d4-b0c8-7af518fc10a7', 'Fuzz Rock Explosion', 'Préparez-vous à des sons saturés et distordus avec des groupes de fuzz rock qui repoussent les limites du genre.', '22:15:00','https://www.youtube.com/embed/Es4N8Hwjoac'),
('f0081e91-91e3-47a2-b03f-c0d1e321f027', 'Neo-Rockabilly Thrills', 'Le rockabilly réinventé pour une nouvelle génération avec des groupes qui mixent les sons rétro et modernes.', '20:30:00','https://www.youtube.com/embed/K70nC0FbxiU'),
('bfe6fe64-87e7-47a2-9867-249c5c0c9a28', 'Synth Rock Odyssey', 'Un concert où le rock rencontre les synthétiseurs pour une soirée de sons futuristes et d’expérimentations.', '21:45:00','https://www.youtube.com/embed/dQw4w9WgXcQ'),
('2d81a542-bcf3-41b4-b1cb-1739ab308c95', 'Rock ’n’ Soul Nights', 'Une fusion de rock et de soul pour une soirée pleine de groove et d’émotion.', '19:30:00','https://www.youtube.com/embed/6Ejga4kJUts'),
('e25c2848-88ad-445b-8038-8fbe7435a409', 'Experimental Rock Lab', 'Des groupes de rock expérimental viennent repousser les frontières du son pour une soirée unique.', '22:00:00','https://www.youtube.com/embed/XfqOB4hvxlY'),
('b6c7a3d6-bb9e-46b5-9f8a-71b02c2739d2', 'Proto-Punk Frenzy', 'Un hommage aux pionniers du punk rock avec des performances inspirées par les premiers groupes qui ont défini le genre.', '20:15:00','https://www.youtube.com/embed/GCHeNLit3EE'),
('fabe32f4-cc6f-4fbf-8160-9738041d5442', 'Art Rock Revolution', 'Des artistes qui mélangent musique et arts visuels pour une expérience rock avant-gardiste et sensorielle.', '21:00:00','https://www.youtube.com/embed/_HtXHReDaTI'),
('fe0b6b24-02b9-4baf-a8b0-bc59550d0874', 'Folk Rock Chronicles', 'Une soirée folk rock où des histoires sont racontées à travers des mélodies émouvantes et des paroles poignantes.', '19:45:00','https://www.youtube.com/embed/OnkTUKtxRic'),
('64075c6e-fd6f-43da-9aa7-73ed48a877e3', 'Psyche Rock Freakout', 'Plongez dans une nuit de rock psychédélique avec des groupes qui repoussent les limites de la perception sonore.', '22:30:00','https://www.youtube.com/embed/x-A5clw2N3E'),
('6cdb23f1-7f23-42c0-8303-e3686108dd7b', 'Stoner Rock Stomp', 'Un concert de stoner rock avec des riffs lourds et des grooves hypnotiques qui transportent dans une autre dimension.', '21:30:00','https://www.youtube.com/embed/udP4ju8MbLA'),
('1ab616d3-4bfb-4cf6-b79a-63cb1b27f5e1', 'Prog Metal Madness', 'Une fusion de rock progressif et de métal avec des morceaux longs et techniques qui vous en mettent plein la vue.', '23:00:00','https://www.youtube.com/embed/PhiSgXz_l20'),
('07d95ca0-51d8-4345-b80f-86eced43fb53', 'Classic Rock Anthems', 'Revivez les plus grands hymnes du rock classique avec des performances qui vous ramènent à l’âge d’or du genre.', '20:00:00','https://www.youtube.com/embed/LT7HqIP55tI'),
('6e764589-c110-46bc-b119-58b4d2c70a2c', 'Alt-Rock Titans', 'Les géants de la scène rock alternative montent sur scène pour offrir des performances épiques et inoubliables.', '21:15:00','https://www.youtube.com/embed/AMhCZrGTeKo'),
('c5910b7b-d627-46b1-b84c-0a2672d57b74', 'Retro Rock Party', 'Un retour aux années folles du rock avec une soirée dédiée aux hits des années 50 à 80.', '19:45:00','https://www.youtube.com/embed/bc0sJvtKrRM'),
('f62fae0b-95d1-4e2b-bfef-3bfe23f9bb65', 'Math Rock Experiments', 'Des rythmes complexes et des structures inhabituelles définissent cette soirée dédiée aux sons math rock.', '22:00:00','https://www.youtube.com/embed/00fbSbxMNKQ'),
('bb4c55d7-bb78-4cf6-b25e-ec80f1240f11', 'Goth Rock Night', 'Une nuit sombre et envoûtante avec des groupes de rock gothique qui plongent dans les ténèbres.', '20:30:00','https://www.youtube.com/embed/hc73pgg5RGU'),
('e3529f6f-660a-44b2-9822-c656d56d2c35', 'Rock Legends Revival', 'Un concert qui célèbre les légendes du rock à travers des reprises épiques et des performances mémorables.', '21:45:00','https://www.youtube.com/embed/cjq7S07ghBA'),
('7f8353ff-b9b2-4937-a3f7-54847ed81ac7', 'Folk Punk Riot', 'Une soirée où le folk et le punk se rencontrent dans un tourbillon d’énergie brute et d’histoires engagées.', '19:30:00','https://www.youtube.com/embed/SBo0gAS3xFc'),
('123912d8-e472-4c8e-9dc1-07b3a7bc880b', 'Rock Opera Extravaganza', 'Un spectacle de rock opéra grandiose avec des morceaux épiques et des récits captivants.', '22:15:00','https://www.youtube.com/embed/l6F2HU4JAIU'),
('27a3fdac-983e-46ed-a982-2b2326c0b49e', 'Industrial Metal Insanity', 'Un mélange furieux de métal et d’industriel pour une soirée brutale et inoubliable.', '23:00:00','https://www.youtube.com/embed/DI-wpzVAtH4'),
('7e1b5c78-6097-4932-8151-51b8265bbfea', 'New Wave Heroes', 'Un hommage à la scène new wave avec des performances qui reprennent les sons iconiques des années 80.', '21:30:00','https://www.youtube.com/embed/EfskK_MS_14'),
('0297cf6e-e339-48f7-912a-1174e51ccbe3', 'Rock & Roll Revival', 'Retour aux sources avec des performances inspirées du rock’n’roll des années 50 et 60.', '20:00:00','https://www.youtube.com/embed/eyaMGdYIdUQ'),
('2ef2c561-dbe6-42ca-8a9e-4c3761651c62', 'Post-Hardcore Intensity', 'Une soirée de post-hardcore intense avec des groupes qui jouent à pleine puissance et émotion.', '21:00:00','https://www.youtube.com/embed/B3Y-w1QdzYw'),
('5edfe9b2-5120-4b21-89ba-1db4ab926818', 'Rockabilly Fever', 'Préparez-vous à danser avec des performances rockabilly pleines d’énergie et de nostalgie.', '19:45:00','https://www.youtube.com/embed/EqQuihD0hoI'),
('b2d8ccf4-7170-4a0f-a7f1-b57e7dd8f379', 'Pop Punk Melodies', 'Des mélodies accrocheuses et des riffs rapides définissent cette soirée pop punk.', '22:00:00','https://www.youtube.com/embed/cJ5XN2P4oCI'),
('f8b72a74-2045-4bff-8dbe-0e2ac681ae18', 'Noise Rock Chaos', 'Plongez dans le chaos sonore avec des groupes de noise rock qui expérimentent les limites du bruit et de l’harmonie.', '22:30:00','https://www.youtube.com/embed/Igq3d6XA75Y'),
('f0a871ef-f621-4b5e-84d5-d1421c3d8b3d', 'Metalcore Mayhem', 'Une soirée violente et énergique avec des groupes de metalcore qui enchaînent les breakdowns furieux.', '23:00:00','https://www.youtube.com/embed/WtW7-_YeabE'),
('2ddc617a-8594-45bb-b94c-52e02487f8fa', 'Grunge Revival', 'Retournez dans les années 90 avec des performances inspirées par les plus grands groupes de grunge.', '20:30:00','https://www.youtube.com/embed/XiHw7MrTx30'),
('9c4172ff-d4d8-4f10-bf37-d7d8f6b38d32', 'Blues Rock Titans', 'Une soirée blues rock avec des guitaristes de légende qui combinent groove et virtuosité.', '21:45:00','https://www.youtube.com/embed/dtIQ4uzbqds'),
('c2457204-18f6-4652-b2c5-d15c0f87e4fb', 'Pop Rock Spectacle', 'Des performances énergiques et des tubes pop rock incontournables pour une soirée festive et entraînante.', '19:15:00','https://www.youtube.com/embed/dQw4w9WgXcQ'),
('b09c1e4a-7dc4-4db1-b76a-55d48b891f69', 'Shoegaze Dreamscapes', 'Des couches de guitares vaporeuses et des mélodies éthérées créent une atmosphère de rêve pour cette soirée shoegaze.', '20:45:00','https://www.youtube.com/embed/XqXouk97qBw'),
('5bf2ef91-b7f0-42c4-97b4-6e8c909e6789', 'Indie Rock Uprising', 'Les meilleurs groupes de la scène indie rock se réunissent pour une nuit de sons authentiques et rafraîchissants.', '21:30:00','https://www.youtube.com/embed/bXYGF_7cyR4'),
('f79cba33-495d-4af3-9db6-1a983c6f60b5', 'Symphonic Rock Majesty', 'Un mélange grandiose de rock et de musique symphonique pour une soirée de sons puissants et époustouflants.', '22:00:00','https://www.youtube.com/embed/vXYVfk7agqU'),
('d504fb1f-1763-47f1-93b1-63f71cb7d9d3', 'Garage Rock Rumble', 'Une explosion de rock brut et énergique avec des groupes de garage rock qui jouent sans filtres.', '19:15:00','https://www.youtube.com/embed/AiaOSGZTwtY'),
('d582c6d6-9d35-4d38-bb37-9e31e1bcd8ef', 'Folk Rock Revival', 'Une soirée où le folk rencontre le rock pour des performances qui allient tradition et modernité.', '20:30:00','https://www.youtube.com/embed/pRw7W9BqGDM'),
('44a19755-99b3-4c97-a0d4-99459e9e6c63', 'Post-Metal Landscapes', 'Des riffs lourds et des ambiances planantes pour une soirée dédiée à la scène post-métal.', '22:30:00','https://www.youtube.com/embed/GaUCBheWCMA'),
('64f848ff-ff21-4dc3-b500-8051f160c5cb', 'Rockabilly Riot', 'Dansez sur des sons rapides et dynamiques avec des groupes qui font revivre l’énergie du rockabilly.', '19:00:00','https://www.youtube.com/embed/D66kVBkAXKI'),
('a10f03f4-1f38-48f1-bb61-907e223ff90e', 'Punk Rock Legends', 'Une nuit dédiée aux pionniers du punk rock avec des reprises et des performances électriques.', '20:45:00','https://www.youtube.com/embed/C7Z-IP2onYQ'),
('d48a9d64-72b6-4c7d-b4b1-f8fd59d37835', 'Noise Rock Frenzy', 'Une immersion totale dans le bruit et l’expérimentation avec des groupes de noise rock intransigeants.', '21:30:00','https://www.youtube.com/embed/AN1RJF55NXI'),
('88a47822-4452-4d10-8064-2bca8c8e0805', 'Post-Punk Shadows', 'Des sonorités sombres et hypnotiques pour une soirée dédiée à la scène post-punk.', '22:00:00','https://www.youtube.com/embed/N6k8BBU8_Go'),
('541f2446-8359-478a-a8a6-bf8e7d61453d', 'Classic Rock Revival', 'Replongez dans les grandes heures du rock classique avec des reprises des groupes emblématiques.', '19:45:00','https://www.youtube.com/embed/9zZYH2tvHQg'),
('91382f3e-e5c5-4c2d-b8b1-d57b245e7c27', 'Alt-Metal Assault', 'Une soirée de métal alternatif avec des riffs puissants et des mélodies accrocheuses.', '21:15:00','https://www.youtube.com/embed/FNj-TAJPCaY'),
('8b6f99fd-7981-4fd6-9ec1-8f939b2f45a1', 'Indie Folk Rock Vibes', 'Des groupes qui fusionnent l’énergie de l’indie rock et les récits introspectifs du folk.', '20:00:00','https://www.youtube.com/embed/bw3UygAi2oo'),
('1b49721d-5c68-4b76-86ed-7cbce306a413', 'Psychedelic Rock Journeys', 'Laissez-vous emporter par des sonorités planantes et des improvisations psychédéliques.', '22:30:00','https://www.youtube.com/embed/1VdALffUMI0'),
('8f1d672a-13d6-45fb-b46f-e74ff65fc7cf', 'Grunge Underground', 'Des groupes qui capturent l’essence du grunge avec des sons bruts et des paroles percutantes.', '21:00:00','https://www.youtube.com/embed/t8Hfi3yLU98'),
('d9f66e15-38f2-4627-b30b-593c33171e23', 'Southern Rock Revival', 'Une soirée dédiée aux sons du sud avec des riffs de guitare puissants et des mélodies entraînantes.', '20:15:00','https://www.youtube.com/embed/Bb42S3n0X8E'),
('cd2c02ab-5fbe-4bde-89f0-d46e3d07f76f', 'Sludge Metal Chaos', 'Des sons lourds, boueux et chaotiques pour une soirée de sludge métal inoubliable.', '22:45:00','https://www.youtube.com/embed/VpATv760tzQ'),
('66c53b19-92b4-4636-835d-579cba5da87b', 'Rock Fusion Night', 'Une fusion de styles et de genres avec des groupes qui brouillent les lignes entre rock, jazz et funk.', '19:30:00','https://www.youtube.com/embed/mb79mnyZfUU'),
('1f77f36e-79d5-4a8c-9f63-3c2e5701a57b', 'Progressive Rock Legends', 'Une soirée où des groupes de rock progressif montrent leur virtuosité à travers des morceaux complexes et épiques.', '21:30:00','https://www.youtube.com/embed/Ui_eoW3BXGI'),
('cc426c58-2e91-4b5d-9103-61df8f191ce1', 'Indie Pop Rock Party', 'Une soirée pop rock festive et entraînante avec des groupes qui font bouger la scène indie.', '20:00:00','https://www.youtube.com/embed/bTHN1eWN7iU'),
('05f93d8e-b63c-4c9e-80c5-2bc26bde2496', 'Experimental Rock Frontier', 'Des groupes qui repoussent les limites du son avec des compositions audacieuses et innovantes.', '22:30:00','https://www.youtube.com/embed/o-CICk9sxFU'),
('e875e08c-42ef-4f5d-85c6-3b1e93c71bb1', 'Blues Rock Revival', 'Un hommage au blues rock avec des performances vibrantes et des solos de guitare mémorables.', '19:00:00','https://www.youtube.com/embed/RJK0jhymE5A'),
('d6e057f4-3314-4b5d-bb9d-0c86a5e6e35f', 'Hard Rock Heroes', 'Les meilleurs groupes de hard rock montent sur scène pour une nuit de riffs puissants et de solos éclatants.', '20:45:00','https://www.youtube.com/embed/GaWqrTtBofY'),
('893c1845-1df3-4d6f-b5b1-0df28c93f580', 'Shoegaze Reveries', 'Des sons atmosphériques et des mélodies envoûtantes pour une soirée shoegaze hypnotique.', '21:15:00','https://www.youtube.com/embed/zxdA9XnC120'),
('8edc4aa7-9d4a-44c6-bb92-b60cb5f1839f', 'Folk Rock Revolution', 'Une soirée où la révolution folk rock prend forme avec des groupes qui marient paroles engagées et mélodies accrocheuses.', '20:30:00','https://www.youtube.com/embed/Nkwhj96kVyU'),
('6d8f2da0-cbe5-4ae3-8aeb-89cb53179c42', 'Psychedelic Stoner Rock', 'Des groupes de stoner rock qui mélangent des riffs lourds et des envolées psychédéliques pour une soirée planante.', '22:00:00','https://www.youtube.com/embed/n5de2XQX358'),
('3ae5d9f5-8a86-4aa4-bc92-6cf8a29e0454', 'Acoustic Rock Sessions', 'Des performances acoustiques qui réinterprètent les classiques du rock avec une touche personnelle.', '19:15:00','https://www.youtube.com/embed/oVWEb-At8yc'),
('ed12b736-4c83-42eb-bc74-ecb803f44ef9', 'Metallica Tribute Night', 'Une soirée dédiée à Metallica avec des reprises énergiques qui raviront tous les fans.', '21:30:00','https://www.youtube.com/embed/pdlAZj5iDc8'),
('88a005ae-c11f-4c45-8414-ff8a8f7cd0c7', 'Britpop Revival', 'Revivez l’âge d’or du Britpop avec des groupes qui rendent hommage aux sons emblématiques de cette époque.', '20:45:00','https://www.youtube.com/embed/7vyP1nH2YRc'),
('ff2d1c9c-1e5b-4678-bbe5-112d39a1e324', 'Hardcore Punk Night', 'Une soirée explosive avec des groupes de hardcore punk qui livrent des performances intenses.', '22:00:00','https://www.youtube.com/embed/3S2Qtazfqio');

-- Faire un INSERT INTO de 48 soirees, sur 12 dates différentes, sur les 4 lieux (avec des uuid réaliste)
INSERT INTO soirees (id, nom, thematique, date, id_lieu, tarif_normal, tarif_reduit) VALUES
('b7b2e51e-5d34-4a83-b16c-33f8122de220', 'Nuit des Idoles du Rock', 'Metal', '2024-11-1', '46a81617-272a-47b7-83ee-65780c5e91fa', 28.00, 16.00),
('dcaa5019-76eb-4424-9c91-d8720f6b89cc', 'Les Héros du Rock', 'Slam', '2024-11-1', '48368a86-69fa-4756-8a51-847e285927c1', 30.00, 18.00),
('4f9d8891-bb95-4a3a-8c91-1600f74c3621', 'Rock au Fil du Temps', 'Rock', '2024-11-1', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 25.00, 15.00),
('e46d5253-4d5d-4a6b-94c0-fc84217dc42d', 'Les Voix du Rock', 'Jazz', '2024-11-1', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00),
('4d19c2c8-28be-4dff-9f35-bcf8b7d38b5e', 'Nuit de la Révolution Rock', 'Rock', '2024-11-2', '46a81617-272a-47b7-83ee-65780c5e91fa', 29.00, 17.00),
('7819e353-09e2-43fc-bc72-258fbd35a59e', 'Célébration du Rock Alternatif', 'Rock', '2024-11-2', '48368a86-69fa-4756-8a51-847e285927c1', 24.00, 14.00),
('d3040c3c-cb8c-4e74-9e1e-dff1eb8e7024', 'Nuit des Rockeurs Indépendants', 'Rock', '2024-11-2', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 27.00, 15.00),
('e05e054b-f3c0-4c3e-bb12-b8a047da4141', 'Rock et Innovateurs', 'Rock', '2024-11-2', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00),
('e35019fa-b8eb-4e54-bde6-17b6de6bb098', 'Rock en Seine', 'Rock', '2024-11-3', '46a81617-272a-47b7-83ee-65780c5e91fa', 25.00, 15.00),
('e8b8c768-c527-4e09-9f55-9067b85b4c53', 'Fête du Rock', 'Rock', '2024-11-3', '48368a86-69fa-4756-8a51-847e285927c1', 20.00, 12.00),
('d3c2b97b-1773-45c2-99f4-b4e372914428', 'Festival de Guitare', 'Rock', '2024-11-3', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 30.00, 18.00),
('fa6e43e0-4f3e-4cc6-a10f-03858b4b9d51', 'Soirée Électro-Rock', 'Rock', '2024-11-3', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 14.00),
('fbf3dc73-64e9-4033-b167-01f5f6325e77', 'Nuit du Rock', 'Metal', '2024-11-4', '46a81617-272a-47b7-83ee-65780c5e91fa', 28.00, 16.00),
('7a8be342-f60f-4c73-bf9c-e0b577bf1c1e', 'Rock Legends', 'Rock', '2024-11-4', '48368a86-69fa-4756-8a51-847e285927c1', 27.00, 15.00),
('e0b8b637-43b0-4379-a5b0-1b2c1348ef62', 'Guitares en Fête', 'Metal', '2024-11-4', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 25.00, 15.00),
('d621cd7e-0c47-4cb5-905f-e5e9ab0c65ff', 'Tribute to Rock', 'Rock', '2024-11-4', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00),
('c9456a3c-d4f5-463f-b9e1-4dcf1b3f81c7', 'Rock et Rythmique', 'Jazz', '2024-11-5', '46a81617-272a-47b7-83ee-65780c5e91fa', 26.00, 14.00),
('0c3c9d24-99f4-48d1-8d6e-e19049eb33bc', 'Rock n Roll Night', 'Rock', '2024-11-5', '48368a86-69fa-4756-8a51-847e285927c1', 24.00, 13.00),
('7f69455e-0dc8-44a2-a1cf-e659b5dcdd60', 'Rock au Sommet', 'Rock', '2024-11-5', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 29.00, 17.00),
('d5e2f7d7-4df2-4b29-b5ff-ec31327cb8db', 'Acoustique et Rock', 'Rock', '2024-11-5', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 23.00, 12.00),
('c593a12d-660c-46e7-b756-2c8e0ef7f3e4', 'Les Grands du Rock', 'Rock', '2024-11-6', '46a81617-272a-47b7-83ee-65780c5e91fa', 30.00, 18.00),
('56e831be-0f61-49dc-b24b-78586e1e5a70', 'Soirée Rock et Blues', 'Rock', '2024-11-6', '48368a86-69fa-4756-8a51-847e285927c1', 20.00, 10.00),
('037574e7-b474-4181-b707-bc3458271ff7', 'Nuit des Rockeurs', 'Rock', '2024-11-6', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 31.00, 19.00),
('2e098de7-00be-41aa-82fc-80d456c6e50e', 'Rock et Gastronomie', 'Rock', '2024-11-6', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 21.00, 11.00),
('c26d5a90-b6c7-4a2f-9f3b-ffbd6a7d5a7b', 'Guitares et Voix', 'Rock', '2024-11-7', '46a81617-272a-47b7-83ee-65780c5e91fa', 25.00, 15.00),
('4436de11-5d9f-4fc0-bf0e-5b203f58bc77', 'Rock au Féminin', 'Slam', '2024-11-7', '48368a86-69fa-4756-8a51-847e285927c1', 28.00, 16.00),
('dc1aa44e-5555-4733-ae41-d10b743c5362', 'Célébration du Rock', 'Slam', '2024-11-7', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 30.00, 18.00),
('d3f11fc3-e8b4-47c6-bc47-c9ee1949479f', 'Tribute Bands Night', 'Rock', '2024-11-7', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 24.00, 14.00),
('d2c676d7-05c6-4197-9a1b-74971c39d372', 'Rock à l Ancienne', 'Slam', '2024-11-8', '46a81617-272a-47b7-83ee-65780c5e91fa', 26.00, 15.00),
('b0b50061-8d4d-4b59-9fd9-e10cf5e71ab3', 'Soirée Rock Mythique', 'Rock', '2024-11-8', '48368a86-69fa-4756-8a51-847e285927c1', 29.00, 17.00),
('02f19347-0525-4c62-b89f-b8cfb8020a7f', 'Nuit des Légendes', 'Rock', '2024-11-8', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 32.00, 20.00),
('e5a10d49-5b9b-4fc0-973e-ec3d176287d0', 'Mélodies Rock', 'Rock', '2024-11-8', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00),
('c5a89a66-78a4-4f78-bca1-8c9a3a13d828', 'Nuit de la Guitare', 'Metal', '2024-11-9', '46a81617-272a-47b7-83ee-65780c5e91fa', 25.00, 15.00),
('50da872f-94ae-4be4-b3a8-b37c6034628f', 'Rock et Emotion', 'Rock', '2024-11-9', '48368a86-69fa-4756-8a51-847e285927c1', 28.00, 16.00),
('ce5e721b-8f4f-4cb9-8c7a-f934a48bc5d4', 'Célébration du Rock', 'Rock', '2024-11-9', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 30.00, 18.00),
('4e38aa78-ece6-4c53-b12f-0c8f44a8020c', 'Nuit de la Musique', 'Metal', '2024-11-9', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 24.00, 14.00),
('ae4c8d5d-d16e-4713-b785-0a5643b203a1', 'Rock et Poésie', 'Rock', '2024-11-10', '46a81617-272a-47b7-83ee-65780c5e91fa', 26.00, 15.00),
('c96f0c69-3f6b-4ebd-bc66-0a95b022f340', 'Rock et Acoustique', 'Rock', '2024-11-10', '48368a86-69fa-4756-8a51-847e285927c1', 29.00, 17.00),
('c74c8491-5387-426f-8324-8bcb83ae5e92', 'Célébration des Artistes', 'Rock', '2024-11-10', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 32.00, 20.00),
('e42fca6f-2a57-4bce-93cc-d8f65bb0db67', 'Les Voix du Rock', 'Rock', '2024-11-10', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00),
('0de0c5f2-72a3-4139-b0d4-cd7614e2ec2e', 'Nuit du Rock Alternatif', 'Jazz', '2024-11-11', '46a81617-272a-47b7-83ee-65780c5e91fa', 30.00, 18.00),
('7c56bfa5-4406-4b99-b771-dc9b307ef58b', 'Soirée Rock Progressif', 'Metal', '2024-11-11', '48368a86-69fa-4756-8a51-847e285927c1', 25.00, 15.00),
('bd5681c6-d8d4-4c38-83f5-e045f05cc73d', 'Les Classiques du Rock', 'Rock', '2024-11-11', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 28.00, 16.00),
('81f24939-594c-4b69-bb5d-e1be1de3baf7', 'Rock et Blues', 'Rock', '2024-11-11', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 20.00, 10.00),
('72835cd3-4461-4f88-8d79-63414be33f1a', 'Nuit de l Histoire du Rock', 'Rock', '2024-11-12', '46a81617-272a-47b7-83ee-65780c5e91fa', 26.00, 15.00),
('13bc65ab-8e91-4e1b-a3cf-8be91e2e7f4f', 'Les Maîtres du Rock', 'Slam', '2024-11-12', '48368a86-69fa-4756-8a51-847e285927c1', 29.00, 17.00),
('f2f2e0e8-b29e-4e4e-947f-bfa4ebc17e6e', 'Guitares et Percussions', 'Rock', '2024-11-12', '7049372e-2a88-4bcd-b2e2-80c872cd661a', 31.00, 19.00),
('e2bc84d8-46ae-407e-9e60-b5b9dc8e3df7', 'Gala du Rock', 'Rock', '2024-11-12', 'e22df51e-7eb0-43b9-b6c3-4bfdda9f3362', 22.00, 12.00);

INSERT INTO soirees_spectacles (id_soiree, id_spectacle) VALUES
('b7b2e51e-5d34-4a83-b16c-33f8122de220', '14e701bf-a9b2-4037-93fa-c86bcbdc24d5'),
('b7b2e51e-5d34-4a83-b16c-33f8122de220', 'bd3883fc-5e7d-4309-af2d-7194374e030d'),
('dcaa5019-76eb-4424-9c91-d8720f6b89cc', 'a750a2b2-7f13-4208-80f8-071df46afd31'),
('dcaa5019-76eb-4424-9c91-d8720f6b89cc', '7ed62eed-29e2-472f-96d3-7e94e5f9d37e'),
('4f9d8891-bb95-4a3a-8c91-1600f74c3621', '19a5896c-29f5-4275-ad0d-e5499d1cb682'),
('4f9d8891-bb95-4a3a-8c91-1600f74c3621', 'c8a9348f-32a3-41b9-897c-6362e53d0233'),
('e46d5253-4d5d-4a6b-94c0-fc84217dc42d', '48960340-6122-4494-8654-90227afb4f86'),
('e46d5253-4d5d-4a6b-94c0-fc84217dc42d', 'f38c904d-5c31-4173-970a-fe6a36872b65'),
('4d19c2c8-28be-4dff-9f35-bcf8b7d38b5e', '21e8e3ae-3023-4ca1-a1b9-6f9550fe909b'),
('4d19c2c8-28be-4dff-9f35-bcf8b7d38b5e', '59ba6c47-93b6-4206-b50f-d192a2d3e12c'),
('7819e353-09e2-43fc-bc72-258fbd35a59e', 'fc5bd0a0-cc7e-4421-8418-ecd8d58b91fa'),
('7819e353-09e2-43fc-bc72-258fbd35a59e', '8f9d3f5d-36b7-4268-afb5-edb1bbb5e092'),
('d3040c3c-cb8c-4e74-9e1e-dff1eb8e7024', '83b852a4-bfb1-46ab-a0fc-556d8d9421c0'),
('d3040c3c-cb8c-4e74-9e1e-dff1eb8e7024', 'd813c3d6-8ca8-45e4-afe8-4af86ec82cc3'),
('e05e054b-f3c0-4c3e-bb12-b8a047da4141', '0c02d78e-b108-4c60-8050-62ffa75521d7'),
('e05e054b-f3c0-4c3e-bb12-b8a047da4141', '2451dd38-f426-442a-ba7d-245dd6c7f716'),
('e35019fa-b8eb-4e54-bde6-17b6de6bb098', '483bbd62-16ea-4421-a1ba-7431d951fea4'),
('e35019fa-b8eb-4e54-bde6-17b6de6bb098', 'ca7ac1fd-f10a-42d0-bcc5-3f530b335a8c'),
('e8b8c768-c527-4e09-9f55-9067b85b4c53', 'b25c563c-05e9-4971-80d1-50268d83a0f3'),
('e8b8c768-c527-4e09-9f55-9067b85b4c53', '86743a46-ce57-4f21-8395-6195a81c30cd'),
('d3c2b97b-1773-45c2-99f4-b4e372914428', '03b3f911-74c6-4918-8a65-bc2e6eadac16'),
('d3c2b97b-1773-45c2-99f4-b4e372914428', '1768429e-af60-414f-995a-9dd2803fefc1'),
('fa6e43e0-4f3e-4cc6-a10f-03858b4b9d51', 'a82f7b34-4eb3-480c-a81a-edd3d5f4a4a7'),
('fa6e43e0-4f3e-4cc6-a10f-03858b4b9d51', 'b774871d-dfc9-4417-97cf-ff16ca69fc95'),
('fbf3dc73-64e9-4033-b167-01f5f6325e77', 'a4718fd9-7631-4298-b4af-c18ab46c0e58'),
('fbf3dc73-64e9-4033-b167-01f5f6325e77', 'd5db6f51-cca1-4f64-9821-9d3f0cdf1d00'),
('7a8be342-f60f-4c73-bf9c-e0b577bf1c1e', 'c2ba1db2-638e-4f86-a88f-804f65ee1a28'),
('7a8be342-f60f-4c73-bf9c-e0b577bf1c1e', 'a5841bf1-55f5-4d23-b7fe-2b3a1cdd389f'),
('e0b8b637-43b0-4379-a5b0-1b2c1348ef62', 'ae7b64c6-6f21-4f50-b98a-e68ef2af7f79'),
('e0b8b637-43b0-4379-a5b0-1b2c1348ef62', 'fdadf72e-1e41-49b4-94a2-739da9dd3c0e'),
('d621cd7e-0c47-4cb5-905f-e5e9ab0c65ff', '17c6db99-8532-44e4-8368-378b3d20d1b4'),
('d621cd7e-0c47-4cb5-905f-e5e9ab0c65ff', 'ac130890-7f80-42e1-8fcb-e7fc7b54a32f'),
('c9456a3c-d4f5-463f-b9e1-4dcf1b3f81c7', 'e65b4a7e-79d9-4f68-bb3d-70d2f7f2bbba'),
('c9456a3c-d4f5-463f-b9e1-4dcf1b3f81c7', 'a36db2c4-2f67-47a9-9d87-54dc9b2e1a90'),
('0c3c9d24-99f4-48d1-8d6e-e19049eb33bc', 'd0f7c1b2-3b89-4e96-9f0f-9d3f8e91fcfa'),
('0c3c9d24-99f4-48d1-8d6e-e19049eb33bc', '75837c5e-3b7d-4513-b8f0-8c2f7364c071'),
('7f69455e-0dc8-44a2-a1cf-e659b5dcdd60', 'ef305b4b-7c9f-41d9-880e-dfb4121dfd09'),
('7f69455e-0dc8-44a2-a1cf-e659b5dcdd60', 'ba3c49b7-6ca1-4999-b520-fcfbf3d14807'),
('d5e2f7d7-4df2-4b29-b5ff-ec31327cb8db', '06ab32cb-f1f3-4c2d-bb65-2cb91f4f2fb3'),
('d5e2f7d7-4df2-4b29-b5ff-ec31327cb8db', '8b420d23-d928-44d4-b0c8-7af518fc10a7'),
('c593a12d-660c-46e7-b756-2c8e0ef7f3e4', 'f0081e91-91e3-47a2-b03f-c0d1e321f027'),
('c593a12d-660c-46e7-b756-2c8e0ef7f3e4', 'bfe6fe64-87e7-47a2-9867-249c5c0c9a28'),
('56e831be-0f61-49dc-b24b-78586e1e5a70', '2d81a542-bcf3-41b4-b1cb-1739ab308c95'),
('56e831be-0f61-49dc-b24b-78586e1e5a70', 'e25c2848-88ad-445b-8038-8fbe7435a409'),
('037574e7-b474-4181-b707-bc3458271ff7', 'b6c7a3d6-bb9e-46b5-9f8a-71b02c2739d2'),
('037574e7-b474-4181-b707-bc3458271ff7', 'fabe32f4-cc6f-4fbf-8160-9738041d5442'),
('2e098de7-00be-41aa-82fc-80d456c6e50e', 'fe0b6b24-02b9-4baf-a8b0-bc59550d0874'),
('2e098de7-00be-41aa-82fc-80d456c6e50e', '64075c6e-fd6f-43da-9aa7-73ed48a877e3'),
('c26d5a90-b6c7-4a2f-9f3b-ffbd6a7d5a7b', '6cdb23f1-7f23-42c0-8303-e3686108dd7b'),
('c26d5a90-b6c7-4a2f-9f3b-ffbd6a7d5a7b', '1ab616d3-4bfb-4cf6-b79a-63cb1b27f5e1'),
('4436de11-5d9f-4fc0-bf0e-5b203f58bc77', '07d95ca0-51d8-4345-b80f-86eced43fb53'),
('4436de11-5d9f-4fc0-bf0e-5b203f58bc77', '6e764589-c110-46bc-b119-58b4d2c70a2c'),
('dc1aa44e-5555-4733-ae41-d10b743c5362', 'c5910b7b-d627-46b1-b84c-0a2672d57b74'),
('dc1aa44e-5555-4733-ae41-d10b743c5362', 'f62fae0b-95d1-4e2b-bfef-3bfe23f9bb65'),
('d3f11fc3-e8b4-47c6-bc47-c9ee1949479f', 'bb4c55d7-bb78-4cf6-b25e-ec80f1240f11'),
('d3f11fc3-e8b4-47c6-bc47-c9ee1949479f', 'e3529f6f-660a-44b2-9822-c656d56d2c35'),
('d2c676d7-05c6-4197-9a1b-74971c39d372', '7f8353ff-b9b2-4937-a3f7-54847ed81ac7'),
('d2c676d7-05c6-4197-9a1b-74971c39d372', '123912d8-e472-4c8e-9dc1-07b3a7bc880b'),
('b0b50061-8d4d-4b59-9fd9-e10cf5e71ab3', '27a3fdac-983e-46ed-a982-2b2326c0b49e'),
('b0b50061-8d4d-4b59-9fd9-e10cf5e71ab3', '7e1b5c78-6097-4932-8151-51b8265bbfea'),
('02f19347-0525-4c62-b89f-b8cfb8020a7f', '0297cf6e-e339-48f7-912a-1174e51ccbe3'),
('02f19347-0525-4c62-b89f-b8cfb8020a7f', '2ef2c561-dbe6-42ca-8a9e-4c3761651c62'),
('e5a10d49-5b9b-4fc0-973e-ec3d176287d0', '5edfe9b2-5120-4b21-89ba-1db4ab926818'),
('e5a10d49-5b9b-4fc0-973e-ec3d176287d0', 'b2d8ccf4-7170-4a0f-a7f1-b57e7dd8f379'),
('c5a89a66-78a4-4f78-bca1-8c9a3a13d828', 'f8b72a74-2045-4bff-8dbe-0e2ac681ae18'),
('c5a89a66-78a4-4f78-bca1-8c9a3a13d828', 'f0a871ef-f621-4b5e-84d5-d1421c3d8b3d'),
('50da872f-94ae-4be4-b3a8-b37c6034628f', '2ddc617a-8594-45bb-b94c-52e02487f8fa'),
('50da872f-94ae-4be4-b3a8-b37c6034628f', '9c4172ff-d4d8-4f10-bf37-d7d8f6b38d32'),
('ce5e721b-8f4f-4cb9-8c7a-f934a48bc5d4', 'c2457204-18f6-4652-b2c5-d15c0f87e4fb'),
('ce5e721b-8f4f-4cb9-8c7a-f934a48bc5d4', 'b09c1e4a-7dc4-4db1-b76a-55d48b891f69'),
('4e38aa78-ece6-4c53-b12f-0c8f44a8020c', '5bf2ef91-b7f0-42c4-97b4-6e8c909e6789'),
('4e38aa78-ece6-4c53-b12f-0c8f44a8020c', 'f79cba33-495d-4af3-9db6-1a983c6f60b5'),
('ae4c8d5d-d16e-4713-b785-0a5643b203a1', 'd504fb1f-1763-47f1-93b1-63f71cb7d9d3'),
('ae4c8d5d-d16e-4713-b785-0a5643b203a1', 'd582c6d6-9d35-4d38-bb37-9e31e1bcd8ef'),
('c96f0c69-3f6b-4ebd-bc66-0a95b022f340', '44a19755-99b3-4c97-a0d4-99459e9e6c63'),
('c96f0c69-3f6b-4ebd-bc66-0a95b022f340', '64f848ff-ff21-4dc3-b500-8051f160c5cb'),
('c74c8491-5387-426f-8324-8bcb83ae5e92', 'a10f03f4-1f38-48f1-bb61-907e223ff90e'),
('c74c8491-5387-426f-8324-8bcb83ae5e92', 'd48a9d64-72b6-4c7d-b4b1-f8fd59d37835'),
('e42fca6f-2a57-4bce-93cc-d8f65bb0db67', '88a47822-4452-4d10-8064-2bca8c8e0805'),
('e42fca6f-2a57-4bce-93cc-d8f65bb0db67', '541f2446-8359-478a-a8a6-bf8e7d61453d'),
('0de0c5f2-72a3-4139-b0d4-cd7614e2ec2e', '91382f3e-e5c5-4c2d-b8b1-d57b245e7c27'),
('0de0c5f2-72a3-4139-b0d4-cd7614e2ec2e', '8b6f99fd-7981-4fd6-9ec1-8f939b2f45a1'),
('7c56bfa5-4406-4b99-b771-dc9b307ef58b', '1b49721d-5c68-4b76-86ed-7cbce306a413'),
('7c56bfa5-4406-4b99-b771-dc9b307ef58b', '6d8f2da0-cbe5-4ae3-8aeb-89cb53179c42'),
('7c56bfa5-4406-4b99-b771-dc9b307ef58b', '8f1d672a-13d6-45fb-b46f-e74ff65fc7cf'),
('bd5681c6-d8d4-4c38-83f5-e045f05cc73d', 'd9f66e15-38f2-4627-b30b-593c33171e23'),
('bd5681c6-d8d4-4c38-83f5-e045f05cc73d', '3ae5d9f5-8a86-4aa4-bc92-6cf8a29e0454'),
('bd5681c6-d8d4-4c38-83f5-e045f05cc73d', 'cd2c02ab-5fbe-4bde-89f0-d46e3d07f76f'),
('81f24939-594c-4b69-bb5d-e1be1de3baf7', '66c53b19-92b4-4636-835d-579cba5da87b'),
('81f24939-594c-4b69-bb5d-e1be1de3baf7', 'ed12b736-4c83-42eb-bc74-ecb803f44ef9'),
('81f24939-594c-4b69-bb5d-e1be1de3baf7', '1f77f36e-79d5-4a8c-9f63-3c2e5701a57b'),
('72835cd3-4461-4f88-8d79-63414be33f1a', 'cc426c58-2e91-4b5d-9103-61df8f191ce1'),
('72835cd3-4461-4f88-8d79-63414be33f1a', '88a005ae-c11f-4c45-8414-ff8a8f7cd0c7'),
('72835cd3-4461-4f88-8d79-63414be33f1a', '7ed62eed-29e2-472f-96d3-7e94e5f9d37e'),
('13bc65ab-8e91-4e1b-a3cf-8be91e2e7f4f', '05f93d8e-b63c-4c9e-80c5-2bc26bde2496'),
('13bc65ab-8e91-4e1b-a3cf-8be91e2e7f4f', 'e875e08c-42ef-4f5d-85c6-3b1e93c71bb1'),
('f2f2e0e8-b29e-4e4e-947f-bfa4ebc17e6e', 'd6e057f4-3314-4b5d-bb9d-0c86a5e6e35f'),
('f2f2e0e8-b29e-4e4e-947f-bfa4ebc17e6e', 'ff2d1c9c-1e5b-4678-bbe5-112d39a1e324'),
('f2f2e0e8-b29e-4e4e-947f-bfa4ebc17e6e', '893c1845-1df3-4d6f-b5b1-0df28c93f580'),
('e2bc84d8-46ae-407e-9e60-b5b9dc8e3df7', '8edc4aa7-9d4a-44c6-bb92-b60cb5f1839f');


-- 50 artistes fictif avec des description simple
INSERT INTO artistes (id, nom, prenom, description) VALUES
('1f35d5c8-b0e3-4f96-bc2e-60a8eec73587', 'Smith', 'John', 'Chanteur de rock au style énergique.'),
('c2f8e2e1-69d2-4c59-a091-8d32af92a654', 'Doe', 'Jane', 'Guitariste talentueuse avec une voix puissante.'),
('f38b1289-5b67-4851-8c4a-ecbcb3e43ee2', 'Brown', 'David', 'Batteur dynamique avec une passion pour le rythme.'),
('7d50d1a4-68a5-4e5a-b3f8-e2c60e1d2b93', 'Johnson', 'Emily', 'Claviériste créative avec un flair pour la mélodie.'),
('b1cf6f2e-fde1-4c82-a1d4-8e2d04572a7d', 'Wilson', 'Michael', 'Bassiste expérimenté avec un groove unique.'),
('3e9dabe1-03ab-4e62-bdcb-086c121d8d0f', 'Taylor', 'Sarah', 'Chanteuse de backing avec une voix douce.'),
('e92347d5-72f6-41be-b9bc-53b4b5b64d35', 'Anderson', 'James', 'Guitariste solo avec un style influent.'),
('5f7f1233-49e1-4fa5-a8b9-57b6e9a8d1f8', 'Thomas', 'Laura', 'Chanteuse et compositrice de chansons touchantes.'),
('df4d2a3e-fec0-4f76-a255-f07a2503e0c0', 'Jackson', 'Daniel', 'Drummer polyvalent avec une grande énergie.'),
('ee3271e7-78b7-41e7-93b7-0b1a4bfbfd88', 'White', 'Jessica', 'Pianiste talentueuse avec un style classique.'),
('612ab2d3-502f-49b5-bd40-1b94a1f22f8a', 'Harris', 'Chris', 'Chanteur de rock avec une forte présence scénique.'),
('70d36267-e92e-432f-9b38-dc50a7350d37', 'Martin', 'Amanda', 'Guitariste avec un amour pour le blues.'),
('b5a1484a-f0e5-4e81-a190-645623af4f3a', 'Thompson', 'Robert', 'Bassiste passionné par le funk.'),
('c81b6d91-c788-4f8c-83f7-9783f2f6b621', 'Garcia', 'Megan', 'Claviériste avec une approche innovante.'),
('b20606da-dfc1-45ef-a891-00b648f8d9d2', 'Martinez', 'Joshua', 'Chanteur de ballades romantiques.'),
('42089405-7ac9-4b2a-b54e-b4d7c5aa7f43', 'Robinson', 'Michelle', 'Batteur avec un sens du rythme exceptionnel.'),
('06b0638f-e87e-407f-a4c0-bc9c2fd9b61e', 'Clark', 'Kevin', 'Guitariste avec une technique impressionnante.'),
('8403cbf5-4d44-4c12-b1ba-0bcf74864359', 'Rodriguez', 'Angela', 'Chanteuse avec une voix puissante et émotive.'),
('e54c4f9e-8242-4114-9338-3ffb1db1a4e3', 'Lewis', 'Brian', 'Claviériste avec un flair pour le jazz.'),
('67bba6a1-3027-4b90-bb38-24560f96115b', 'Lee', 'Samantha', 'Chanteuse avec une grande diversité musicale.'),
('f2f688d1-e457-4c78-9f24-f0b54b12f7e8', 'Walker', 'Andrew', 'Batteur influencé par le rock classique.'),
('de2240b1-2419-4a79-bd71-81334d70204b', 'Hall', 'Patricia', 'Chanteuse de pop avec un style accrocheur.'),
('a2f24bc2-3f05-44c5-8a67-fc86dc5f7ee4', 'Allen', 'Matthew', 'Guitariste passionné par la musique folk.'),
('36b2433d-e7ab-4edb-8a63-e2347b0b8b1b', 'Young', 'Kimberly', 'Bassiste avec un sens du groove incroyable.'),
('64166bc2-b63c-45b0-a78f-ef8326c50d68', 'King', 'Charles', 'Claviériste avec une grande énergie sur scène.'),
('dc7ed7f4-1534-44c9-9d69-df27056af36e', 'Wright', 'Nancy', 'Chanteuse et compositrice avec une grande passion.'),
('5df80c72-b8a4-4f93-a827-8c3a84a3d0c6', 'Scott', 'Timothy', 'Batteur avec un style unique et innovant.'),
('003dfc0a-69ec-46d2-98c4-d460a6728d68', 'Torres', 'Jennifer', 'Guitariste avec une belle technique.'),
('b7fbd949-1161-4945-8a99-1c20a8cfc8b5', 'Nguyen', 'Paul', 'Chanteur au timbre vocal exceptionnel.'),
('6cb1e858-1b67-46ca-8e60-c8c84c76b84b', 'Murphy', 'Angela', 'Batteuse avec une grande expérience.'),
('9f6c90e3-d2f1-4799-a285-f9425b7c1c2e', 'Cooper', 'Edward', 'Chanteur avec une passion pour le rock alternatif.'),
('7b207b9d-ecb7-4535-8393-0c47a3f8eec1', 'Bailey', 'Jessica', 'Guitariste avec un style distinctif.'),
('b7c1bcb4-f39e-4863-b9a4-b44dfb58cc61', 'Rivera', 'Laura', 'Claviériste avec un style captivant.'),
('e08c2b48-3287-46b2-bcb3-94c1b70b5c79', 'Gonzalez', 'Richard', 'Batteur avec une technique impeccable.'),
('f3e4441c-e0ae-4822-a9e2-e9c10435c1da', 'Foster', 'Diana', 'Chanteuse avec un répertoire varié.'),
('0cbe66bc-bb5c-4622-a6ee-473e08347c37', 'Sanders', 'George', 'Guitariste avec un style audacieux.'),
('57592e35-bc25-46c6-b4ed-7693c4d9efba', 'Patel', 'Brittany', 'Claviériste avec une sensibilité musicale.'),
('f4f7943a-4c09-438f-a1cf-5e1885e25c95', 'Fisher', 'Ronald', 'Chanteur avec une grande portée vocale.'),
('858649d6-9d65-4a54-90b7-7ff169648f9d', 'Rodgers', 'Katherine', 'Guitariste avec un amour pour le rock.'),
('1b4500ff-b177-47ee-9ae4-5a2e4c1b0b6c', 'Stewart', 'Jessica', 'Chanteuse avec une voix envoûtante.'),
('5a5d20aa-3c5b-42d0-bb79-1f66aa49735c', 'Sullivan', 'Eric', 'Batteur avec un style percutant.'),
('f52f8925-bf0d-4425-8b7a-1895c1dc6d74', 'Bennett', 'Grace', 'Chanteuse avec une présence scénique captivante.');

-- atribution des spectacles aux artistes sachant qu'ils peuvent être plusieurs par spectacle
-- Artiste 1 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('1f35d5c8-b0e3-4f96-bc2e-60a8eec73587', '14e701bf-a9b2-4037-93fa-c86bcbdc24d5'),
       ('1f35d5c8-b0e3-4f96-bc2e-60a8eec73587', 'bd3883fc-5e7d-4309-af2d-7194374e030d'),
       ('1f35d5c8-b0e3-4f96-bc2e-60a8eec73587', 'a750a2b2-7f13-4208-80f8-071df46afd31');

-- Artiste 2 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('c2f8e2e1-69d2-4c59-a091-8d32af92a654', '7ed62eed-29e2-472f-96d3-7e94e5f9d37e'),
       ('c2f8e2e1-69d2-4c59-a091-8d32af92a654', '19a5896c-29f5-4275-ad0d-e5499d1cb682');

-- Artiste 3 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('f38b1289-5b67-4851-8c4a-ecbcb3e43ee2', 'c8a9348f-32a3-41b9-897c-6362e53d0233'),
       ('f38b1289-5b67-4851-8c4a-ecbcb3e43ee2', '48960340-6122-4494-8654-90227afb4f86'),
       ('f38b1289-5b67-4851-8c4a-ecbcb3e43ee2', 'f38c904d-5c31-4173-970a-fe6a36872b65'),
       ('f38b1289-5b67-4851-8c4a-ecbcb3e43ee2', '21e8e3ae-3023-4ca1-a1b9-6f9550fe909b');

-- Artiste 4 dans 1 spectacle
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('7d50d1a4-68a5-4e5a-b3f8-e2c60e1d2b93', '59ba6c47-93b6-4206-b50f-d192a2d3e12c');

-- Artiste 5 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('b1cf6f2e-fde1-4c82-a1d4-8e2d04572a7d', 'fc5bd0a0-cc7e-4421-8418-ecd8d58b91fa'),
       ('b1cf6f2e-fde1-4c82-a1d4-8e2d04572a7d', '8f9d3f5d-36b7-4268-afb5-edb1bbb5e092');

-- Artiste 6 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('3e9dabe1-03ab-4e62-bdcb-086c121d8d0f', '83b852a4-bfb1-46ab-a0fc-556d8d9421c0'),
       ('3e9dabe1-03ab-4e62-bdcb-086c121d8d0f', 'd813c3d6-8ca8-45e4-afe8-4af86ec82cc3'),
       ('3e9dabe1-03ab-4e62-bdcb-086c121d8d0f', '0c02d78e-b108-4c60-8050-62ffa75521d7');

-- Artiste 7 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('e92347d5-72f6-41be-b9bc-53b4b5b64d35', '2451dd38-f426-442a-ba7d-245dd6c7f716'),
       ('e92347d5-72f6-41be-b9bc-53b4b5b64d35', '483bbd62-16ea-4421-a1ba-7431d951fea4');

-- Artiste 8 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('5f7f1233-49e1-4fa5-a8b9-57b6e9a8d1f8', 'ca7ac1fd-f10a-42d0-bcc5-3f530b335a8c'),
       ('5f7f1233-49e1-4fa5-a8b9-57b6e9a8d1f8', 'b25c563c-05e9-4971-80d1-50268d83a0f3'),
       ('5f7f1233-49e1-4fa5-a8b9-57b6e9a8d1f8', '86743a46-ce57-4f21-8395-6195a81c30cd'),
       ('5f7f1233-49e1-4fa5-a8b9-57b6e9a8d1f8', '03b3f911-74c6-4918-8a65-bc2e6eadac16');

-- Artiste 9 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('df4d2a3e-fec0-4f76-a255-f07a2503e0c0', '1768429e-af60-414f-995a-9dd2803fefc1'),
       ('df4d2a3e-fec0-4f76-a255-f07a2503e0c0', 'a82f7b34-4eb3-480c-a81a-edd3d5f4a4a7');

-- Artiste 10 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('ee3271e7-78b7-41e7-93b7-0b1a4bfbfd88', 'b774871d-dfc9-4417-97cf-ff16ca69fc95'),
       ('ee3271e7-78b7-41e7-93b7-0b1a4bfbfd88', 'a4718fd9-7631-4298-b4af-c18ab46c0e58'),
       ('ee3271e7-78b7-41e7-93b7-0b1a4bfbfd88', 'd5db6f51-cca1-4f64-9821-9d3f0cdf1d00');

-- Artiste 11 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('612ab2d3-502f-49b5-bd40-1b94a1f22f8a', 'c2ba1db2-638e-4f86-a88f-804f65ee1a28'),
       ('612ab2d3-502f-49b5-bd40-1b94a1f22f8a', 'a5841bf1-55f5-4d23-b7fe-2b3a1cdd389f');

-- Artiste 12 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('70d36267-e92e-432f-9b38-dc50a7350d37', 'ae7b64c6-6f21-4f50-b98a-e68ef2af7f79'),
       ('70d36267-e92e-432f-9b38-dc50a7350d37', 'fdadf72e-1e41-49b4-94a2-739da9dd3c0e'),
       ('70d36267-e92e-432f-9b38-dc50a7350d37', '17c6db99-8532-44e4-8368-378b3d20d1b4'),
       ('70d36267-e92e-432f-9b38-dc50a7350d37', 'ac130890-7f80-42e1-8fcb-e7fc7b54a32f');

-- Artiste 13 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('b5a1484a-f0e5-4e81-a190-645623af4f3a', 'e65b4a7e-79d9-4f68-bb3d-70d2f7f2bbba'),
       ('b5a1484a-f0e5-4e81-a190-645623af4f3a', 'a36db2c4-2f67-47a9-9d87-54dc9b2e1a90'),
       ('b5a1484a-f0e5-4e81-a190-645623af4f3a', 'd0f7c1b2-3b89-4e96-9f0f-9d3f8e91fcfa');

-- Artiste 14 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('c81b6d91-c788-4f8c-83f7-9783f2f6b621', '75837c5e-3b7d-4513-b8f0-8c2f7364c071'),
       ('c81b6d91-c788-4f8c-83f7-9783f2f6b621', 'ef305b4b-7c9f-41d9-880e-dfb4121dfd09');

-- Artiste 15 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('b20606da-dfc1-45ef-a891-00b648f8d9d2', 'ba3c49b7-6ca1-4999-b520-fcfbf3d14807'),
       ('b20606da-dfc1-45ef-a891-00b648f8d9d2', '06ab32cb-f1f3-4c2d-bb65-2cb91f4f2fb3'),
       ('b20606da-dfc1-45ef-a891-00b648f8d9d2', '8b420d23-d928-44d4-b0c8-7af518fc10a7');

-- Artiste 16 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('42089405-7ac9-4b2a-b54e-b4d7c5aa7f43', 'f0081e91-91e3-47a2-b03f-c0d1e321f027'),
       ('42089405-7ac9-4b2a-b54e-b4d7c5aa7f43', 'bfe6fe64-87e7-47a2-9867-249c5c0c9a28');

-- Artiste 17 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('8403cbf5-4d44-4c12-b1ba-0bcf74864359', '2d81a542-bcf3-41b4-b1cb-1739ab308c95'),
       ('8403cbf5-4d44-4c12-b1ba-0bcf74864359', 'e25c2848-88ad-445b-8038-8fbe7435a409'),
       ('8403cbf5-4d44-4c12-b1ba-0bcf74864359', 'b6c7a3d6-bb9e-46b5-9f8a-71b02c2739d2');

-- Artiste 18 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('e54c4f9e-8242-4114-9338-3ffb1db1a4e3', 'fabe32f4-cc6f-4fbf-8160-9738041d5442'),
       ('e54c4f9e-8242-4114-9338-3ffb1db1a4e3', 'fe0b6b24-02b9-4baf-a8b0-bc59550d0874');

-- Artiste 19 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('67bba6a1-3027-4b90-bb38-24560f96115b', '64075c6e-fd6f-43da-9aa7-73ed48a877e3'),
       ('67bba6a1-3027-4b90-bb38-24560f96115b', '6cdb23f1-7f23-42c0-8303-e3686108dd7b'),
       ('67bba6a1-3027-4b90-bb38-24560f96115b', '1ab616d3-4bfb-4cf6-b79a-63cb1b27f5e1'),
       ('67bba6a1-3027-4b90-bb38-24560f96115b', '07d95ca0-51d8-4345-b80f-86eced43fb53');

-- Artiste 20 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('f2f688d1-e457-4c78-9f24-f0b54b12f7e8', '6e764589-c110-46bc-b119-58b4d2c70a2c'),
       ('f2f688d1-e457-4c78-9f24-f0b54b12f7e8', 'c5910b7b-d627-46b1-b84c-0a2672d57b74'),
       ('f2f688d1-e457-4c78-9f24-f0b54b12f7e8', 'f62fae0b-95d1-4e2b-bfef-3bfe23f9bb65');

-- Artiste 21 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('de2240b1-2419-4a79-bd71-81334d70204b', 'bb4c55d7-bb78-4cf6-b25e-ec80f1240f11'),
       ('de2240b1-2419-4a79-bd71-81334d70204b', 'e3529f6f-660a-44b2-9822-c656d56d2c35');

-- Artiste 22 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('a2f24bc2-3f05-44c5-8a67-fc86dc5f7ee4', '7f8353ff-b9b2-4937-a3f7-54847ed81ac7'),
       ('a2f24bc2-3f05-44c5-8a67-fc86dc5f7ee4', '123912d8-e472-4c8e-9dc1-07b3a7bc880b'),
       ('a2f24bc2-3f05-44c5-8a67-fc86dc5f7ee4', '27a3fdac-983e-46ed-a982-2b2326c0b49e'),
       ('a2f24bc2-3f05-44c5-8a67-fc86dc5f7ee4', '7e1b5c78-6097-4932-8151-51b8265bbfea');

-- Artiste 23 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('36b2433d-e7ab-4edb-8a63-e2347b0b8b1b', '0297cf6e-e339-48f7-912a-1174e51ccbe3'),
       ('36b2433d-e7ab-4edb-8a63-e2347b0b8b1b', '2ef2c561-dbe6-42ca-8a9e-4c3761651c62'),
       ('36b2433d-e7ab-4edb-8a63-e2347b0b8b1b', '5edfe9b2-5120-4b21-89ba-1db4ab926818');

-- Artiste 24 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('64166bc2-b63c-45b0-a78f-ef8326c50d68', 'b2d8ccf4-7170-4a0f-a7f1-b57e7dd8f379'),
       ('64166bc2-b63c-45b0-a78f-ef8326c50d68', 'f8b72a74-2045-4bff-8dbe-0e2ac681ae18');

-- Artiste 25 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('dc7ed7f4-1534-44c9-9d69-df27056af36e', 'f0a871ef-f621-4b5e-84d5-d1421c3d8b3d'),
       ('dc7ed7f4-1534-44c9-9d69-df27056af36e', '2ddc617a-8594-45bb-b94c-52e02487f8fa'),
       ('dc7ed7f4-1534-44c9-9d69-df27056af36e', '9c4172ff-d4d8-4f10-bf37-d7d8f6b38d32'),
       ('dc7ed7f4-1534-44c9-9d69-df27056af36e', 'c2457204-18f6-4652-b2c5-d15c0f87e4fb');

-- Artiste 26 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('5df80c72-b8a4-4f93-a827-8c3a84a3d0c6', 'b09c1e4a-7dc4-4db1-b76a-55d48b891f69'),
       ('5df80c72-b8a4-4f93-a827-8c3a84a3d0c6', '5bf2ef91-b7f0-42c4-97b4-6e8c909e6789'),
       ('5df80c72-b8a4-4f93-a827-8c3a84a3d0c6', 'f79cba33-495d-4af3-9db6-1a983c6f60b5');

-- Artiste 27 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('003dfc0a-69ec-46d2-98c4-d460a6728d68', 'd504fb1f-1763-47f1-93b1-63f71cb7d9d3'),
       ('003dfc0a-69ec-46d2-98c4-d460a6728d68', 'd582c6d6-9d35-4d38-bb37-9e31e1bcd8ef');

-- Artiste 28 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('b7fbd949-1161-4945-8a99-1c20a8cfc8b5', '44a19755-99b3-4c97-a0d4-99459e9e6c63'),
       ('b7fbd949-1161-4945-8a99-1c20a8cfc8b5', '64f848ff-ff21-4dc3-b500-8051f160c5cb'),
       ('b7fbd949-1161-4945-8a99-1c20a8cfc8b5', 'a10f03f4-1f38-48f1-bb61-907e223ff90e');

-- Artiste 29 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('6cb1e858-1b67-46ca-8e60-c8c84c76b84b', 'd48a9d64-72b6-4c7d-b4b1-f8fd59d37835'),
       ('6cb1e858-1b67-46ca-8e60-c8c84c76b84b', '88a47822-4452-4d10-8064-2bca8c8e0805');

-- Artiste 30 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('9f6c90e3-d2f1-4799-a285-f9425b7c1c2e', '541f2446-8359-478a-a8a6-bf8e7d61453d'),
       ('9f6c90e3-d2f1-4799-a285-f9425b7c1c2e', '91382f3e-e5c5-4c2d-b8b1-d57b245e7c27'),
       ('9f6c90e3-d2f1-4799-a285-f9425b7c1c2e', '8b6f99fd-7981-4fd6-9ec1-8f939b2f45a1'),
       ('9f6c90e3-d2f1-4799-a285-f9425b7c1c2e', '1b49721d-5c68-4b76-86ed-7cbce306a413');

-- Artiste 31 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('7b207b9d-ecb7-4535-8393-0c47a3f8eec1', '8f1d672a-13d6-45fb-b46f-e74ff65fc7cf'),
       ('7b207b9d-ecb7-4535-8393-0c47a3f8eec1', 'd9f66e15-38f2-4627-b30b-593c33171e23'),
       ('7b207b9d-ecb7-4535-8393-0c47a3f8eec1', 'cd2c02ab-5fbe-4bde-89f0-d46e3d07f76f');

-- Artiste 32 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('b7c1bcb4-f39e-4863-b9a4-b44dfb58cc61', '66c53b19-92b4-4636-835d-579cba5da87b'),
       ('b7c1bcb4-f39e-4863-b9a4-b44dfb58cc61', '1f77f36e-79d5-4a8c-9f63-3c2e5701a57b');

-- Artiste 33 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('e08c2b48-3287-46b2-bcb3-94c1b70b5c79', 'cc426c58-2e91-4b5d-9103-61df8f191ce1'),
       ('e08c2b48-3287-46b2-bcb3-94c1b70b5c79', '05f93d8e-b63c-4c9e-80c5-2bc26bde2496'),
       ('e08c2b48-3287-46b2-bcb3-94c1b70b5c79', 'e875e08c-42ef-4f5d-85c6-3b1e93c71bb1'),
       ('e08c2b48-3287-46b2-bcb3-94c1b70b5c79', 'd6e057f4-3314-4b5d-bb9d-0c86a5e6e35f');

-- Artiste 34 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('f3e4441c-e0ae-4822-a9e2-e9c10435c1da', '893c1845-1df3-4d6f-b5b1-0df28c93f580'),
       ('f3e4441c-e0ae-4822-a9e2-e9c10435c1da', '8edc4aa7-9d4a-44c6-bb92-b60cb5f1839f');

-- Artiste 35 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('0cbe66bc-bb5c-4622-a6ee-473e08347c37', '6d8f2da0-cbe5-4ae3-8aeb-89cb53179c42'),
       ('0cbe66bc-bb5c-4622-a6ee-473e08347c37', '3ae5d9f5-8a86-4aa4-bc92-6cf8a29e0454');

-- Artiste 36 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('57592e35-bc25-46c6-b4ed-7693c4d9efba', 'ed12b736-4c83-42eb-bc74-ecb803f44ef9'),
       ('57592e35-bc25-46c6-b4ed-7693c4d9efba', '88a005ae-c11f-4c45-8414-ff8a8f7cd0c7'),
       ('57592e35-bc25-46c6-b4ed-7693c4d9efba', 'ff2d1c9c-1e5b-4678-bbe5-112d39a1e324');

-- Artiste 37 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('f4f7943a-4c09-438f-a1cf-5e1885e25c95', '2d81a542-bcf3-41b4-b1cb-1739ab308c95'),
       ('f4f7943a-4c09-438f-a1cf-5e1885e25c95', 'e25c2848-88ad-445b-8038-8fbe7435a409'),
       ('f4f7943a-4c09-438f-a1cf-5e1885e25c95', 'b6c7a3d6-bb9e-46b5-9f8a-71b02c2739d2');

-- Artiste 38 dans 2 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('858649d6-9d65-4a54-90b7-7ff169648f9d', 'fabe32f4-cc6f-4fbf-8160-9738041d5442'),
       ('858649d6-9d65-4a54-90b7-7ff169648f9d', 'fe0b6b24-02b9-4baf-a8b0-bc59550d0874');

-- Artiste 39 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('1b4500ff-b177-47ee-9ae4-5a2e4c1b0b6c', '64075c6e-fd6f-43da-9aa7-73ed48a877e3'),
       ('1b4500ff-b177-47ee-9ae4-5a2e4c1b0b6c', '6cdb23f1-7f23-42c0-8303-e3686108dd7b'),
       ('1b4500ff-b177-47ee-9ae4-5a2e4c1b0b6c', '1ab616d3-4bfb-4cf6-b79a-63cb1b27f5e1');

-- Artiste 40 dans 4 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('5a5d20aa-3c5b-42d0-bb79-1f66aa49735c', '07d95ca0-51d8-4345-b80f-86eced43fb53'),
       ('5a5d20aa-3c5b-42d0-bb79-1f66aa49735c', '6e764589-c110-46bc-b119-58b4d2c70a2c'),
       ('5a5d20aa-3c5b-42d0-bb79-1f66aa49735c', 'c5910b7b-d627-46b1-b84c-0a2672d57b74'),
       ('5a5d20aa-3c5b-42d0-bb79-1f66aa49735c', 'f62fae0b-95d1-4e2b-bfef-3bfe23f9bb65');

-- Artiste 41 dans 3 spectacles
INSERT INTO artistes_spectacles (id_artiste, id_spectacle)
VALUES ('f52f8925-bf0d-4425-8b7a-1895c1dc6d74', 'bb4c55d7-bb78-4cf6-b25e-ec80f1240f11'),
       ('f52f8925-bf0d-4425-8b7a-1895c1dc6d74', 'e3529f6f-660a-44b2-9822-c656d56d2c35'),
       ('f52f8925-bf0d-4425-8b7a-1895c1dc6d74', '7f8353ff-b9b2-4937-a3f7-54847ed81ac7');

-- img_spectacle

INSERT INTO img_spectacles (id_spectacle, url_img) VALUES
('14e701bf-a9b2-4037-93fa-c86bcbdc24d5','00CCE7BA-4EF2-4C83-80C0-81603134944C.png'),
('bd3883fc-5e7d-4309-af2d-7194374e030d','01D2FA08-D989-49FF-9F89-64DF9EAF3B83.jpg'),
('a750a2b2-7f13-4208-80f8-071df46afd31','05906CA0-11B3-41A7-9BA9-7ACC9E6B7518.jpg'),
('7ed62eed-29e2-472f-96d3-7e94e5f9d37e','08EE67EF-2AE4-47FC-9154-BDC3F1B95225.jpg'),
('19a5896c-29f5-4275-ad0d-e5499d1cb682','0A47A355-1CE7-4F16-BD94-BEA88BB29EF6.jpg'),
('c8a9348f-32a3-41b9-897c-6362e53d0233','0BB089DB-319F-4AF8-8710-3F60F9CBF3D3.jpg'),
('48960340-6122-4494-8654-90227afb4f86','0BC23A03-1D05-42F2-8DE7-D14F4008588F.jpg'),
('f38c904d-5c31-4173-970a-fe6a36872b65','0D10F9D8-CAA0-4620-9547-6491CD74FEB8.jpg'),
('21e8e3ae-3023-4ca1-a1b9-6f9550fe909b','0D7FF604-1F1D-4AEE-B967-3FEE6F6E02F3.jpg'),
('59ba6c47-93b6-4206-b50f-d192a2d3e12c','0EDC8436-9A0F-49E4-92FF-3D5B759A6621.jpg'),
('fc5bd0a0-cc7e-4421-8418-ecd8d58b91fa','1646424C-D532-4453-A536-4C55C57FE7C0.jpg'),
('8f9d3f5d-36b7-4268-afb5-edb1bbb5e092','17BF5D83-CD66-48F0-839D-14E23ADB04DB.jpg'),
('83b852a4-bfb1-46ab-a0fc-556d8d9421c0','186A5FC8-2539-462F-910D-65276989ACEA.jpg'),
('d813c3d6-8ca8-45e4-afe8-4af86ec82cc3','1DC00FC7-185F-424F-8396-F76E1FD981E0.jpg'),
('0c02d78e-b108-4c60-8050-62ffa75521d7','22B66665-8AB7-4E56-9711-F377E216CD7D.png'),
('2451dd38-f426-442a-ba7d-245dd6c7f716','25F3D8C5-A269-4BCA-AA4D-085224AE8CB4.jpg'),
('483bbd62-16ea-4421-a1ba-7431d951fea4','263256DB-A1E9-4119-86B0-2079AEA40098.jpg'),
('ca7ac1fd-f10a-42d0-bcc5-3f530b335a8c','28E836A6-27EB-47C1-95FF-F03F431B84A3.jpg'),
('b25c563c-05e9-4971-80d1-50268d83a0f3','2A99619C-82EF-46C6-AF58-D7A0E10F4C80.jpg'),
('86743a46-ce57-4f21-8395-6195a81c30cd','2E2EEEE5-719D-40AB-B6A9-FDD18CF33441.jpg'),
('03b3f911-74c6-4918-8a65-bc2e6eadac16','30B28E84-6666-42B5-ADB4-7C93ACA04DB4.jpg'),
('1768429e-af60-414f-995a-9dd2803fefc1','3CCB45B1-0F31-4411-93C6-70B49590F5B6.jpg'),
('a82f7b34-4eb3-480c-a81a-edd3d5f4a4a7','4027686D-D7B8-4974-B31F-669FFB5C113E.jpg'),
('b774871d-dfc9-4417-97cf-ff16ca69fc95','44F3B5F6-954F-4DB4-9AFA-BB6F37BC78EB.jpg'),
('a4718fd9-7631-4298-b4af-c18ab46c0e58','47E2CC02-FD29-4615-A31B-CD66214B262D.jpg'),
('d5db6f51-cca1-4f64-9821-9d3f0cdf1d00','4880FD89-9003-46C5-9E6C-F9B1BAC4429E.jpg'),
('c2ba1db2-638e-4f86-a88f-804f65ee1a28','48A362E1-3E1B-4C53-9495-B17B9CF78922.jpg'),
('a5841bf1-55f5-4d23-b7fe-2b3a1cdd389f','49BF6A14-79F4-423B-8765-6D83BF4EFF05.jpg'),
('ae7b64c6-6f21-4f50-b98a-e68ef2af7f79','4ABF2727-13B1-489D-9D65-BF4AC06C580F.jpg'),
('fdadf72e-1e41-49b4-94a2-739da9dd3c0e','4CCD6AD5-EA2E-4838-8661-E5573820A0F4.jpg'),
('17c6db99-8532-44e4-8368-378b3d20d1b4','4CF7FB71-AC2A-4E13-B6AC-661039B2C7EE.jpg'),
('ac130890-7f80-42e1-8fcb-e7fc7b54a32f','4FDD9D09-B577-42E4-AD40-DA885E72E19D.jpg'),
('e65b4a7e-79d9-4f68-bb3d-70d2f7f2bbba','4FF266B1-C967-4426-B734-5C47B459D46E.jpg'),
('a36db2c4-2f67-47a9-9d87-54dc9b2e1a90','5655DE4C-76C3-4930-8325-062A65F39DDF.jpg'),
('d0f7c1b2-3b89-4e96-9f0f-9d3f8e91fcfa','59696F0A-06EE-4909-8130-AA1AE6A3A730.jpg'),
('75837c5e-3b7d-4513-b8f0-8c2f7364c071','64347406-FC43-4B32-AA8B-A13772AB8C28.jpg'),
('ef305b4b-7c9f-41d9-880e-dfb4121dfd09','647ED86D-4C91-4D9C-8930-E83E9C9BB870.jpg'),
('ba3c49b7-6ca1-4999-b520-fcfbf3d14807','68AA1B00-3D4B-49E3-851A-F3CA05435B53.jpg'),
('06ab32cb-f1f3-4c2d-bb65-2cb91f4f2fb3','6AB2629F-177D-4C57-97BD-E0A037F152CD.jpg'),
('8b420d23-d928-44d4-b0c8-7af518fc10a7','6FEB0B55-C201-42A0-88A7-9FB279A7338D.jpg'),
('f0081e91-91e3-47a2-b03f-c0d1e321f027','706159FD-080B-40A4-AD14-4C157A8D8E71.jpg'),
('bfe6fe64-87e7-47a2-9867-249c5c0c9a28','77262A27-8EDD-4869-A390-28C52E8B9266.jpg'),
('2d81a542-bcf3-41b4-b1cb-1739ab308c95','77A51675-371C-4310-B7CF-A69FC026DF4D.jpg'),
('e25c2848-88ad-445b-8038-8fbe7435a409','78475959-4FD1-4047-9DC1-29817C5EE43D.jpg'),
('b6c7a3d6-bb9e-46b5-9f8a-71b02c2739d2','7932165A-F947-4259-B017-CA2AAE458FB1.jpg'),
('fabe32f4-cc6f-4fbf-8160-9738041d5442','7B4F1353-5B58-4E8A-9AC3-6D31E9F93323.jpg'),
('fe0b6b24-02b9-4baf-a8b0-bc59550d0874','7B57CA22-AF11-4D76-8C6D-BF9BD9654B4A.png'),
('64075c6e-fd6f-43da-9aa7-73ed48a877e3','7BAF5212-D074-44C9-ABC5-78B900EE1023.jpg'),
('6cdb23f1-7f23-42c0-8303-e3686108dd7b','7BF288A4-D2C8-4802-B12B-4EFED210033C.jpg'),
('1ab616d3-4bfb-4cf6-b79a-63cb1b27f5e1','7EA99A19-81A1-4BDD-96D3-723A3C230F9B.jpg'),
('07d95ca0-51d8-4345-b80f-86eced43fb53','7EB068CE-C48F-4003-8F61-22E5D87F0BF3.jpg'),
('6e764589-c110-46bc-b119-58b4d2c70a2c','7F988E61-ED20-4CB0-A64B-52D9B082C5DB.jpg'),
('c5910b7b-d627-46b1-b84c-0a2672d57b74','81DE00C1-9ABB-4956-BFE9-973B5C5BFE80.jpg'),
('f62fae0b-95d1-4e2b-bfef-3bfe23f9bb65','8444C215-1D89-4117-B986-D3CED6E158D4.jpg'),
('bb4c55d7-bb78-4cf6-b25e-ec80f1240f11','87A3EB79-BADA-4C4C-B77B-C5344024AA94.jpg'),
('e3529f6f-660a-44b2-9822-c656d56d2c35','8BACD1D2-20AF-4CFB-A154-4D375A64785A.jpg'),
('7f8353ff-b9b2-4937-a3f7-54847ed81ac7','8C8E74B2-99AE-42A1-B814-E4A5DF1FDAA0.jpg'),
('123912d8-e472-4c8e-9dc1-07b3a7bc880b','9062B43F-9BF8-40EA-8BED-D2A1ED997918.jpg'),
('27a3fdac-983e-46ed-a982-2b2326c0b49e','9131F825-33B8-4B06-821C-0EBA3C52D058.jpg'),
('7e1b5c78-6097-4932-8151-51b8265bbfea','9147182C-988B-49BA-BA49-830433128FAA.jpg'),
('0297cf6e-e339-48f7-912a-1174e51ccbe3','914C4146-A60D-4333-A2B3-EBCBD9B14000.jpg'),
('2ef2c561-dbe6-42ca-8a9e-4c3761651c62','9C0AACA9-21AE-476E-9DE4-AFECD04DCAE4.jpg'),
('5edfe9b2-5120-4b21-89ba-1db4ab926818','9D9B2592-C093-43DE-98CF-412F08A6D56C.jpg'),
('b2d8ccf4-7170-4a0f-a7f1-b57e7dd8f379','9FAC1071-6B47-4C06-AE79-4533A627F408.jpg'),
('f8b72a74-2045-4bff-8dbe-0e2ac681ae18','A22303F7-4361-4FC8-B665-F034936AFB72.png'),
('f0a871ef-f621-4b5e-84d5-d1421c3d8b3d','A35F70F6-EF65-47CA-AE9F-B310FE9EC48A.jpg'),
('2ddc617a-8594-45bb-b94c-52e02487f8fa','A79F0DFE-26F2-46AB-8B6D-8DC30FBC1A5E.png'),
('9c4172ff-d4d8-4f10-bf37-d7d8f6b38d32','A7D10311-B417-4BC7-96C1-5745C1DBBB40.jpg'),
('c2457204-18f6-4652-b2c5-d15c0f87e4fb','A7EBA79D-D68F-419E-A31C-AEE063D406E6.jpg'),
('b09c1e4a-7dc4-4db1-b76a-55d48b891f69','A8DDCA4F-3CE9-4A6E-8993-7FD810180E43.jpg'),
('5bf2ef91-b7f0-42c4-97b4-6e8c909e6789','ABBBD9D2-D62E-4B3F-AEEF-35D6FFBA77AD.jpg'),
('f79cba33-495d-4af3-9db6-1a983c6f60b5','AC43B24B-7C61-4C7A-80C1-940DF022A199.jpg'),
('d504fb1f-1763-47f1-93b1-63f71cb7d9d3','AC96D11E-3F9F-40AF-89D8-87BB991BA03E.jpg'),
('d582c6d6-9d35-4d38-bb37-9e31e1bcd8ef','ACC9C141-E8EA-4AE2-A363-01E606DD48DB.jpg'),
('44a19755-99b3-4c97-a0d4-99459e9e6c63','B320A5B5-4B66-4822-AA72-4D57B5C314F6.jpg'),
('64f848ff-ff21-4dc3-b500-8051f160c5cb','B55C08F0-CFE3-4524-9020-E93F69A1FE76.jpg'),
('a10f03f4-1f38-48f1-bb61-907e223ff90e','B55D5ADD-A13C-4E2F-9C92-2A79C413E1C6.jpg'),
('d48a9d64-72b6-4c7d-b4b1-f8fd59d37835','B6D53B2D-6AE8-434B-9405-B5E7F64F8616.png'),
('88a47822-4452-4d10-8064-2bca8c8e0805','B8108BBF-C649-40CF-A584-696A34F19F91.jpg'),
('541f2446-8359-478a-a8a6-bf8e7d61453d','B9BDFE82-B49B-4EED-8E4A-2E1AA06B55FD.jpg'),
('91382f3e-e5c5-4c2d-b8b1-d57b245e7c27','BB714895-6F39-464B-8DFB-4FF1CC49EE8D.jpg'),
('8b6f99fd-7981-4fd6-9ec1-8f939b2f45a1','BE71DA07-A49C-4460-AD43-880D8BF8C099.jpg'),
('1b49721d-5c68-4b76-86ed-7cbce306a413','C4D6B732-D132-42DC-B4A2-AD1DA98DD3A2.jpg'),
('8f1d672a-13d6-45fb-b46f-e74ff65fc7cf','C5F0C4B3-96BF-46B5-983C-2FC1031329CA.jpg'),
('d9f66e15-38f2-4627-b30b-593c33171e23','CA8C6262-B6AE-45A2-8645-59A4583B367E.jpg'),
('cd2c02ab-5fbe-4bde-89f0-d46e3d07f76f','CDB30DDB-9104-4ACF-B3BF-49A1FB92FEAA.jpg'),
('66c53b19-92b4-4636-835d-579cba5da87b','D0F9D984-6889-4E29-86D7-992CAFEEED98.jpg'),
('1f77f36e-79d5-4a8c-9f63-3c2e5701a57b','D19E164D-DDA4-4181-8770-EE254A5DF3CD.jpg'),
('cc426c58-2e91-4b5d-9103-61df8f191ce1','D3C3C3FE-5FF6-4FA3-9AA7-A826367BE31B.jpg'),
('05f93d8e-b63c-4c9e-80c5-2bc26bde2496','D7A89331-41DC-459F-8FE8-36A90C38982B.jpg'),
('e875e08c-42ef-4f5d-85c6-3b1e93c71bb1','D984E503-629D-4AAB-8F4B-380D3228C9CE.jpg'),
('d6e057f4-3314-4b5d-bb9d-0c86a5e6e35f','DAA40A0B-96E8-46EE-9A4E-DAE072B9116C.jpg'),
('893c1845-1df3-4d6f-b5b1-0df28c93f580','DB3AD2BC-5419-4085-A287-DC661E1E5943.jpg'),
('8edc4aa7-9d4a-44c6-bb92-b60cb5f1839f','DF3F374F-023A-4B7E-BBAA-775D910EC42E.png'),
('6d8f2da0-cbe5-4ae3-8aeb-89cb53179c42','E3198851-B562-4242-BD1A-9942A2A71C35.jpg'),
('3ae5d9f5-8a86-4aa4-bc92-6cf8a29e0454','E50256BE-075D-45A2-A205-D3B20021A75A.jpg'),
('ed12b736-4c83-42eb-bc74-ecb803f44ef9','E53F9046-628F-4121-941A-3CE59E6E973A.jpg'),
('88a005ae-c11f-4c45-8414-ff8a8f7cd0c7','E7956182-71B4-409F-90A6-7885BC1BD470.jpg'),
('ff2d1c9c-1e5b-4678-bbe5-112d39a1e324','E7DA3ACE-6D11-455C-9BD7-132D9ACAB0AE.jpg'),
('a82f7b34-4eb3-480c-a81a-edd3d5f4a4a7','E9B9A59B-0EEA-4032-A8CA-035E39700B68.jpg'),
('8b6f99fd-7981-4fd6-9ec1-8f939b2f45a1','ECE3EFCA-78A3-4DAE-9264-FA581A3D5462.jpg'),
('e3529f6f-660a-44b2-9822-c656d56d2c35','F09E413E-CB61-4724-9AB0-1C9BC42B9AAF.jpg'),
('bfe6fe64-87e7-47a2-9867-249c5c0c9a28','F413C6A3-BE06-4171-A36C-3095D85DEBE3.jpg'),
('8f9d3f5d-36b7-4268-afb5-edb1bbb5e092','F870FEFA-F4E2-4AEA-A2AC-23A726E79E79.jpg'),
('c8a9348f-32a3-41b9-897c-6362e53d0233','F971B51C-A64D-43C7-B5A0-AB470DC9FCDE.jpg'),
('483bbd62-16ea-4421-a1ba-7431d951fea4','F9AEC30D-1FE8-4E70-A143-9543743BB73E.jpg'),
('d48a9d64-72b6-4c7d-b4b1-f8fd59d37835','FD817ABC-7581-4C9D-BEB6-FFE2E8178AC5.jpg'),
('6cdb23f1-7f23-42c0-8303-e3686108dd7b','FDE1A53A-F46F-4C41-95EF-084E23B456D2.jpg');
