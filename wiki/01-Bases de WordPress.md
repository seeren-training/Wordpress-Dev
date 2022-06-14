# Bases de WordPress

* 🔖 **Prérequis**
* 🔖 **Installation**
* 🔖 **Définition de contenu**
* 🔖 **Interface d'administration**
* 🔖 **Dependances**

___

## 📑 Prérequis

`Wordpress` est un `CMS` utilisant le langage `PHP`. De ce fait les prérequis correspondent à l'environnement de ce langage.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/prerequist.jpg)

### 🏷️ **PHP**

Pour installer PHP vous avez plusieurs solutions:

* Xampp, Wampp, Mampp et autres distributions
* PHP official distribution
* PHP avec le package manager de votre OS

[PHP](https://www.php.net/)

### 🏷️ **MySQL**

Pour installer MySQL vous avez plusieurs solutions:

* Xampp, Wampp, Mampp et autres distributions
* MySQL official distribution
* MySQL avec le package manager de votre OS

[MariaDB](https://mariadb.org/)

### 🏷️ **Composer**

Composer est le package manager de PHP. Il sert à initialiser, installer les librairies d'un projet et bien d'autre.

[Composer](https://getcomposer.org/)

### 🏷️ **NPM**

Npm est le package manager de HTML/CSS/JavaScript. Il sert à initialiser, installer les librairies d'un projet et bien d'autre. Il est compris à l'installation de node.js

[Node](https://nodejs.org/en/)

### 🏷️ **IDE**

Il faudra également pouvoir naviguer dans l'arborescence du projet et éditer du code. L'IDE adapté à PHP est PHPStorm de part son onglet de gestion de base de données intégré, il est également possible d'utiliser VSCode avec des plugins ou autre IDE préférentiel.

[VSCode](https://code.visualstudio.com/)

___

👨🏻‍💻 Manipulation

Installez les prérequis des l’environnement HTML/CSS/Javascriot/PHP

___

## 📑 Installation

`Composer` peut être utile pour initialiser un projet wordpress via un terminal.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/composer.png)

### 🏷️ **Composer**

Pour vérifier que composer est bien installé, vérifiez sa présence via la commande suivante.

```bash
composer
```

Pour créer un projet il suffit de demander la création via le dépôt officiel de wordpress.

[Wordpress Packagist](https://packagist.org/packages/johnpbloch/wordpress)

```bash
composer create-project johnpbloch/wordpress name-to-customize
```

___

👨🏻‍💻 Manipulation

Installez un projet wordpress à l'emplacement de votre choix

___

Vous pouvez alors simplement exécuter votre projet depuis votre terminal.

```bash
php -S localhost:8000 -t name-to-customize/wordpress
```

Vous pouvez également déplacer le dossier généré dans le dossier `www` ou `htdocs` de votre serveur web local et le démarrer.

### 🏷️ **Download**

Il est aussi possible d'installer wordpress en téléchargeant le packet depuis le site officiel.

[Download](https://fr.wordpress.org/download/)
___

👨🏻‍💻 Manipulation

Lancez votre projet dans le navigateur en exécutant votre serveur web ou en utilisant PHP.

___

> Nous remarquons qu'avec `PHP` et le package manager `Composer` il est possible de lancer un projet wordpress en deux instructions. Autour de cet écosystème il existe de nombreux outils permettant de gérer les thèmes et plugins du projet en utilisant composer.

___

## 📑 Définition de contenu

Concernant ce rappel retournons vers le programme wordpress initiation.

[Edition](https://github.com/seeren-training/Wordpress/wiki/03)

___

## 📑 Interface d'administration

Concernant ce rappel retournons vers le programme wordpress initiation.

[Présentation](https://github.com/seeren-training/Wordpress/wiki/01#-pr%C3%A9sentation)

___

## 📑 Dépendances

En utilisant composer vous pouvez cartographier vos dépendances avec Wordpress Packagist.

### 🏷️ **Wpackagist**

Dans le fichier composer.json situé en dehors du projet vous pouvez le modifier pour ajouter les instructions suivantes.

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://wpackagist.org",
        "only": [
        "wpackagist-plugin/*",
        "wpackagist-theme/*"
        ]
    }
],
```

Cela indique qu'en cas d'utilisation de composer les packets doivent être récupérés chez wpackagist.org.

Vous pouvez spécifier l'emplacement de l'installation.

```json
"extra": {
    "installer-paths": {
        "wordpress/wp-content/themes/{$name}/": [
        "type:wordpress-theme"
        ],
        "wordpress/wp-content/plugins/{$name}/": [
        "type:wordpress-plugin"
        ]
    }
},
```

### 🏷️ **Composer**

Maintenant vous pouvez installer et cartographier vos dépendances en ligne de commande.

```bach
composer require wpackagist-theme/hello-elementor:2.5
```

Quand vous partagez le prohet avec un collaborateur il peut récupérer l'ensemble du projet et des dépendances avec composer

```bach
composer install
```