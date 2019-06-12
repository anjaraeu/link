## Laranjara

Ce jeu de mot en carton cache une version modifiée du dépôt laravel/laravel (aucune modification du framework, juste celui du template de départ).

### Modifications

- Bootstrap est remplacé par Semantic UI, c'est une préférence personelle des membres d'Anjara.
- L'intégration Sentry avec Vue et le framework est intégrée (tout en restant optionelle).
- Gestion du mode nuit/jour (jour, nuit, jour, nuit, jour, nuit !)
- Utilisation d'écrans d'erreur personalisés
- Intégration de traductions françaises pour les messages par défaut.
- Interface i18n disponible à l'intérieur des composants Vue

### Utilisation

Il n'y a aucun problème, utilisez ce modèle comme bon vous semble. Il est publié sous licence [MIT](LICENSE).

**Attention !** Si vous souhaitez intégrer le système d'authentification Laravel, merci d'utiliser `php artisan laranjara:auth` à la place de `php artisan make:auth`.
