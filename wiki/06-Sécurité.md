# Sécurité

* 🔖 **Maintenance**
* 🔖 **Protection**
* 🔖 **Intrusion et robots**
* 🔖 **Htaccess**
* 🔖 **Les extensions**

___

## 📑 Maintenance

Il existe quatre typologies de mises à jour et de mises à jour automatiques WordPress :

* Mises à jour du noyau
* Mises à jour des extensions
* Mises à jour des thèmes
* Mises à jour des fichiers de traduction

Quand vous lancer une mise à jour, les visiteurs navigants auront un message de site en maintenance. Il est conseillé de mettre une par une les mise à jour en exécution.

Dans le fichier wp-config.php vous pouvez demander l'activation des updates automatiques.

```php
define( 'AUTOMATIC_UPDATER_DISABLED', false);
```

___

## 📑 Protection

Afin de protéger votre base de données contre des failles de sécurité et notamment les injections SQL il est une bonne pratique que votre structure de données ne soit pas prédictible.

* Il faut choisir un préfixe de table non prédictible.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/prefix.png)

___

## 📑 Intrusion et robots

Les robots et autres crawler connaissent les adresses d'administration et de login. Une bonne pratique correspond à modifier ces adresses.

[Protect WP Admin](https://fr.wordpress.org/plugins/protect-wp-admin/)

Nous pouvons utiliser un plugin pour modifier les adresses sensibles.

___

## 📑 Htaccess

Le fichier htaccess est un fichier caché contenant les directives du serveur apache. Il est possible d'interdire l'accès à certains fichiers ou encore procéder à des réécritures d'url.

> Attention, un autre serveur qu'apache ne sera pas sensible à ces directives.

[Guide htaccess](https://wpmarmite.com/htaccess-wordpress)

Prenons un exemple utile, empêcher un utilisateur d'accéder à un fichier spécifique.

```apache
<files wp-config.php>
    order allow,deny
    deny from all
</files>
```

___

## 📑 Les extensions

> Concernant la sécurité il existe de nombreuses extensions.

Il faut régulièrement observer la liste des meilleurs extension car le classement évolue en fonction de l'apparition de nouvelles failles et les extensions qui les prennent en compte

[Protect WP Admin](https://fr.wordpress.org/plugins/protect-wp-admin/)

[I Theme Security](https://wordpress.org/plugins/better-wp-security/)

___

## 📑 Les failles

Pour nous sensibiliser aux différentes failles comme les injections SQL, XSS, CSRF, étudions le guide OWASP.

[OWASP](https://owasp.org/)