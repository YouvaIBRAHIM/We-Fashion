# We Fashion

Bienvenue sur le projet We Fashion, une plateforme de e-commerce pour la vente de vêtements de créateurs. Ce projet a pour but d'être multicanal et permettre aux utilisateurs d'acheter des produits en ligne, en VR, sur mobile ou via un agent conversationnel.

## Prérequis
- PHP >= 8.1
- Composer
- MySQL
- Serveur Web (Apache, Nginx, etc.)

## Installation
1. Clonez le projet : `git clone https://github.com/YouvaIBRAHIM/We-Fashion`
2. Naviguez dans le dossier du projet : `cd We-Fashion`
3. Installez les dépendances : `composer install`
4. Installez les dépendances JS : `npm install`
5. Générer une version de production avec `npm run build` ou lancez la version de développement avec `npm run dev`
6. Créez une copie du fichier `.env.example` en `.env` : `cp .env.example .env`
7. Configurez les informations de votre base de données dans le fichier `.env`
8. Lancez votre serveur avec MySQL
9. Générez une clé d'application : `php artisan key:generate`
10. Lancez les migrations : `php artisan migrate`
11. Remplissez la base de données avec les données de test : `php artisan db:seed`
12. Établir un raccourci du répertoire `storage` dans le répertoire `public` : `php artisan storage:link`
13. Lancez le serveur : `php artisan serve`
14. Pour que les catégories soient accéssibles sur toutes les pages de la navigation, il faudra décommenter le code de la méthode `boot` dans le fichier `\app\Providers\AppServiceProvider.php` (lignes 27 et 28)

![Diagramme de la base de données](/images/AppServiceProvider.jpeg)

15. Ouvrez votre navigateur web et accédez à l'adresse `http://localhost:8000`


Félicitations, le projet We Fashion est maintenant lancé sur votre machine !

## Accès à la partie admin
- URL : `http://localhost:8000/admin`
- Identifiants : email `edouard@example.com`, mot de passe `admin123`

## Corbeille
Un système de corbeille a été ajouté pour les produits. Dans la corbeille, il est possible de supprimer définitivement les produits ou de les restaurer.

### Voici le schéma de la base de données utilisée dans le projet :

![Diagramme de la base de données](/images/wefashion_db_diagram.jpeg)