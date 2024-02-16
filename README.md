# testTechnique-Nicomak

Bonjour,

Pour le test technique j'ai utilisé MySQL pour ma base de données et créé des fixtures pour les données.
Pour la base de données il faudra mettre un utilisateur et un mot de passe dans le fichier .env ligne 27.
Le projet s'installe avec composer et les commandes suivantes:

```sh
    composer install
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    php bin/console doctrine:fixtures:load
```

Il m'a fallu environ 2h30 de temps effectif pour réaliser ce test technique.