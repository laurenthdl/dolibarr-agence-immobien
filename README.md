# Immobilier - Biens

Gestion des biens immobiliers pour Dolibarr ERP.

## Numéro de module
`700001`

## Dépendances
immocore, societe

## Installation

1. Copier le dossier dans `dolibarr/htdocs/custom/immobien/`
2. Activer le module depuis **Configuration > Modules/Applications**
3. Les tables seront créées automatiquement

## Tests

```bash
php test/phpunit/ImmoBienTest.php
```

## Structure

```
immobien/
├── core/modules/       → Fichier d'activation module
├── class/              → Classes métier
├── sql/                → Schémas de base de données
├── langs/              → Fichiers de traduction
├── test/phpunit/       → Tests automatisés
├── css/                → Feuilles de style
└── js/                 → Scripts JavaScript
```

## License

GPLv3
