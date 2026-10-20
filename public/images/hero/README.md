# Images Hero Section

## Instructions pour ajouter l'image de Freepik

1. **Téléchargez l'image depuis Freepik** :
   - Allez sur : https://fr.freepik.com/photos-gratuite/equipe-travail-equipe-affaires-cabinet-ordinateur-portable_1203364.htm
   - Cliquez sur "Télécharger" et choisissez une résolution élevée (recommandé : 1920x1080 ou plus)

2. **Renommez l'image** :
   - Renommez le fichier téléchargé en : `consulting-team.jpg`
   - Si l'image est au format PNG, renommez-la en `consulting-team.png` et mettez à jour le chemin dans `home.blade.php`

3. **Placez l'image dans ce dossier** :
   - Copiez l'image dans : `public/images/hero/consulting-team.jpg`

4. **Format recommandé** :
   - Format : JPG ou PNG
   - Dimensions : 1920x1080 pixels minimum (ratio 16:9)
   - Poids : < 500 KB pour de meilleures performances
   - Qualité : Haute résolution pour un rendu optimal

5. **Optimisation (optionnel)** :
   - Utilisez un outil comme TinyPNG ou ImageOptim pour compresser l'image
   - Assurez-vous que l'image reste nette après compression

## Notes
- L'image sera automatiquement appliquée avec l'effet Ken Burns (zoom lent)
- Un gradient rouge sera superposé pour maintenir la lisibilité du texte
- Si l'image n'est pas trouvée, un SVG de fallback sera affiché

