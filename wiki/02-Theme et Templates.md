# Theme et Templates

* 🔖 **Theme enfant**
* 🔖 **HTML, CSS et hiérarchie**
* 🔖 **Header,Footer, Sidebar**
* 🔖 **Les modèles**

___

## 📑 Theme enfant

> Un thème WordPress enfant, c’est un thème qui va hériter des fonctionnalités, du design et de la mise en page d’un thème installé sur un site (qui devient le thème parent) et permettre de le personnaliser en profondeur.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/child-theme.jpg)

Il existe quelques raisons qui pourraient vous donner envie d'utiliser un thème enfant :
* Si vous modifiez un thème existant et qu'il est mis à jour, vos modifications seront perdues.
* Utiliser un thème enfant vous assure que vos modifications seront préservées.
*  Utiliser un thème enfant accélère le temps de développement.  
* Utiliser un thème enfant est une excellente façon de commencer pour apprendre comment développer un thème WordPress.

Un thème enfant est composé d'au moins un répertoire (le répertoire du thème enfant) et deux fichiers obligatoires. 

### 🏷️ **Le répertoire**

Par convention il faut créer un répertoire qui possède comme préfixe le nom du thème parent puis le `-` comme séparateur suivit de child. Exemple twentyfifteen-child.

### 🏷️ **Le CSS**

Le fichier `style.css` est une obligation. Il doit posséder l'entête suivante:

```css
/*
 Theme Name:   Twenty Fifteen Child
 Theme URI:    http://example.com/twenty-fifteen-child/
 Description:  Twenty Fifteen Child Theme
 Author:       John Doe
 Author URI:   http://example.com
 Template:     twentyfifteen
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  twenty-fifteen-child
*/
```

[Theme Stylesheet](https://codex.wordpress.org/Theme_Development#Theme_Stylesheet)

La ligne Template correspond au nom du répertoire du thème parent. Le thème parent dans notre exemple est le thème Twenty Fifteen, de sorte que le Template soit twentyfifteen. Vous pouvez travailler avec un thème différent, donc adapter en conséquence.

### 🏷️ **La screenshot**

Pour avoir une image d'aperçu pour votre thème vous devez avoir un fichier screenshot à la racine du répertoire du thème.

### 🏷️ **Le PHP**

Le seul fichier requis pour un thème enfant est style.css, mais functions.php est nécessaire pour mettre en file d'attente correctement les styles (voir ci-dessous).

La première ligne de functions.php de votre thème enfant sera une balise d'ouverture de PHP ( <?php ), après quoi vous pourrez mettre en file d'attente les feuilles de style du parent et du thème enfant.

Pour ajouter un style du parent:

```php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_parent_styles' );
function theme_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/some-file.css' );

}
```

Pour ajouter un style de l'enfant:

```php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/some-file.css' );

}
```

### 🏷️ **Surcharge**

Si vous voulez changer plus que le style, le thème de votre enfant peut écraser n'importe quel fichier dans le thème parent : il suffit simplement d'inclure un fichier du même nom dans le répertoire du thème enfant, et il va écraser le fichier équivalent dans le répertoire du thème parent au chargement du site. Par exemple, si vous souhaitez modifier le code PHP pour modifier l'en-tête du site, vous pouvez inclure un header.php dans le répertoire du thème de votre enfant, et ce fichier sera utilisé à la place du fichier header.php du thème parent.

Vous pouvez également inclure des fichiers dans le thème enfant qui ne sont pas présents dans le thème parent. Par exemple, vous pouvez créer un modèle plus spécifique que ceux que l'on trouve dans le thème de votre parent, comme un modèle pour une page spécifique ou une catégorie archive. Voir la hiérarchie de modèle pour plus d'informations sur la façon dont WordPress décide du modèle à utiliser. 

> Contrairement au fichier style.css, le fichier functions.php du thème enfant n'écrase pas son homologue du parent. Au lieu de cela, il est chargé en plus du fichier functions.php du parent.

___

👨🏻‍💻 Manipulation

Créez un thème enfant à partir du theme twenty twenty one

___

## 📑 HTML, CSS et hiérarchie

Lorsque vous choisissez un thème, vous décider d'utiliser des fichiers qui sont situés dans **wp-content/themes/**.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/theme.png)

Chaque thème possède un dossier qui porte son nom, décrivons son contenu.

### 🏷️ **HTML**

Les fichiers html possèdent l'extension `.php` qui permettent leur dynamisme. Le PHP est un langage permettant d'interpréter des instructions qui sont à l'intérieur du tag php.

```php
<h1>
    <?php echo 'Some PHP' ?>
</h1>
```

 Il faut considérer que PHP calcul le contenu de vos balises grace à son vocabulaire et vous avez la possibilité d'éditer l'HTML des templates. Concernant le PHP, soyez sur de ce que vous faites!

### 🏷️ **CSS**

Chaque template possède obligatoirement le fichier `style.css`.

Ce fichier permet de déclarer le thème grace aux commentaires en haut de fichier, puis il contient l'ensemble du CSS du template.

```css
/*   
Theme Name: Rose
Theme URI: Homepage du thème
Description: Une courte description
Author: votre nom
Author URI: votre URL
Template: Utiliser cette ligne si vous utilisez un thème parent
Version: numéro de version optionnel
.
Commentaires généraux / Information de licences si applicable.
.
*/
```

[CSS File Header](https://codex.wordpress.org/File_Header)

### SCSS

Il est possible que le thème possède des fichiers `.scss`. Le scss est un langage de type préprocesseur permettant de dynamiser le CSS. Vous ne pouvez pas les relier à votre thème et ils sont utilisés pour générer le fichier `.css` tout en permettant de travailler dans de multiples fichiers à la syntaxe plus puissante. Pour effectuer cette opération il faut les outils adéquates comme `webpack`, `node-sass`, `compass` ou un plugin de votre `ide`.

### 🏷️ **Hiérarchie**

WordPress utilise l'URL pointant sur votre site pour décider quel modèle, ou ensemble de modèles, utiliser pour l'affichage de la page en question.

En premier lieu, WordPress compare chaque URL aux différents types de requête — afin de repérer quel type de page (une page de recherche, une page de catégorie, la page d'accueil, etc.) doit être affiché.

> Les fichiers modèles sont alors sélectionnés — et le contenu de la page est généré — selon la hiérarchie des modèles de WordPress présentée ici, en fonction de leur présence ou non dans le thème WordPress utilisé. 

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/Template_Hierarchy.png)

À l'exception du fichier modèle de base `index.php` qui doit être présent dans tout thème, les développeurs de thème sont libres de choisir s'ils veulent ou non implémenter ou non tel ou tel fichier modèle. Si WordPress ne trouve pas le premier fichier attendu pour le type de page dans la liste, il passe au fichier suivant de la hiérarchie. En dernier lieu, si aucun fichier n'a été trouvé, c'est le fichier index.php qui sera utilisé. 

[Template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

___

👨🏻‍💻 Manipulation

Créez des fichiers distincts pour les pages, articles, auteurs et accueil.

___

## 📑 Header, Footer, Sidebar

Si votre thème le permet, vous pouvez personnaliser l'en-tête de votre site en mettant une image en ligne, et en la configurant.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/header.png)

### 🏷️ **Header**

L'entête se personnalise en modifiant le fichier `header.php` et les fichiers reliés.

[Add theme header](https://codex.wordpress.org/Custom_Headers)

```html
<header id="masthead" class="site-header" role="banner">

    <?php get_template_part( 'template-parts/header/header', 'image' ); ?>

    <?php if ( has_nav_menu( 'top' ) ) : ?>
        <div class="navigation-top">
            <div class="wrap">
                <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
            </div><!-- .wrap -->
        </div><!-- .navigation-top -->
    <?php endif; ?>

</header><!-- #masthead -->
```

L'on se rend compte qu'il y a des expressions qui utilisent des fichiers externes. La fonction `get_template_part` permet d'inclure des fichiers se trouvant dans le thème. Il faudra les modifier pour personnaliser des parties précises de votre thème.

Il est possible que les différentes parties soient incluses en utilisant d'autres fonctions disponibles et qu’il soit difficile d'identifier le fichier contenant l'HTML du header.

La fonction `get_header` est responsable de charger le fichier `header.php`

```php
<?php get_header(); ?>
```

Cette fonction prend un argument optionnel qui chargera une déclinaison du header.

```php
<?php get_header( 'primary' ); ?>
```

Utilisera le fichier header-primary.php.

### 🏷️ **Sidebar**

La sidebar est la zone permettant l'affichage des widgets. 


![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/sidebar.png)

Un thème peut posséder plusieurs sidebar. Pour ajouter une sidebar il faut l'enregistrer en PHP afin de pouvoir demander son affichage avec une fonction spécifique.

Les sidebar sont enregistrées en utilisant la fonction `register_sidebar` généralement dans le fichier `functions.php`. Il permet de spécifier le conteneurs HTML, le titre et la description de la sidebar.

```php
register_sidebar(
    array(
        'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    )
);
```

[Enregistrer une sidebar](https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar)

Chaque sidebar peut s'afficher à des endroit différents en demandant l'appel de la fonction `dynamic_sidebar`.

```html
<aside class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
```

Une autre solution est de demander à wordpress une sidebar spécifique avec la fonction `get_sidebar`. Wordpress chargera alors le fichier sidebar.php. Vous pouvez avoir plusieurs sidebar avec un identifiant spécifique, et il est alors possible de dynamiser le nom du fichier sidebar.

```php
<?php get_sidebar( 'primary' ); ?>
```

Utilisera le fichier sidebar-primary.php.

### 🏷️ **Footer**

> La logique du footer est la même que celle du header.

La fonction `get_footer` charge le fichier `footer.php`.

```php
<?php get_footer(); ?>
```

Cette fonction prend un argument optionnel qui chargera une déclinaison du footer.

```php
<?php get_footer( 'primary' ); ?>
```

Utilisera le fichier footer-primary.php.

___

👨🏻‍💻 Manipulation

Utilisez les notions précédentes pour que les pages uniquements affichent les widgets.


___

## 📑 Les modèles


> Les modèles de page sont un type spécifique de fichier modèle qui peut être appliqué à une page spécifique ou à des groupes de pages.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/page-article.png)

Les modèles de page sont utilisés pour modifier l'apparence d'une page.

* Un modèle de page peut être appliqué à une seule page, une section de page ou une classe de pages.
* Les modèles de page ont généralement un niveau élevé de spécificité, ciblant une page individuelle ou un groupe de pages. Par exemple, un modèle de page nommé page-about.php est plus spécifique que les fichiers de modèle page.php ou index.php car il n'affectera qu'une page avec le slug « about ».
* Si un modèle de page a un nom de modèle, les utilisateurs de WordPress qui modifient la page ont le contrôle sur le modèle qui sera utilisé pour afficher la page.

[Page template](https://developer.wordpress.org/themes/template-files-section/page-template-files/)

### 🏷️ **Template**

Il faut créer un fichier qui ne pose pas de probème avec le nommage utilisé par wordpress et sa hiérarchie, en utilisant des _ à la place des - par exemple.

* template_portfolio.php

Le fichier doit comporter un commentaire permettant à wordpress de le détecter comme modèle de page.

```php
<?php 

/* Template Name: Portfolio Template */

?>
```

Suite à cette déclaration nous pouvez observer sur lors de l'édition d'une page que nous pouvons selectionner un modèle spécifique, celui créé précédemment.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/model.png)

Il reste alors à utiliser les différentes fonctions de wordpress pour construire la page.

___

👨🏻‍💻 Manipulation

Créez un modèle de page à appliquer sur une page au choix et reconstituez son contenu.

___

Par défaut, un modèle de page personnalisé sera disponible pour le type de publication « page ».

### 🏷️ **Types**

Pour créer un modèle de page pour des types de publication spécifiques, ajoutez une ligne sous le nom du modèle avec les types de publication que vous souhaitez que le modèle prenne en charge.

```php
<?php
/*
Template Name: Portfolio Template
Template Post Type: post, page, event
*/
?>
```

Si vous créez un type de post spécifique vous pouvez les ajouter dans la liste des types ou le template est applicable.


### 🏷️ **Page statique**

Il est possible de choisir pour la page d'accueil une page statique.

Par défaut, WordPress affiche une liste de publications sur la page d'accueil de votre site. Cette liste d'articles est automatiquement mise à jour dès que de nouveaux articles sont publiés, ce n'est donc pas statique. De plus, il n'est pas nécessaire de créer de page pour que WordPress affiche cette liste de publications.

> Une page d'accueil statique est une page spécifique utilisée comme page d'accueil du site.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/static.png)

Vous pouvez choisir une page ou un article et allez actionner le fichier `page.php` ou `archive.php`.

Vous pouvez tout de même avoir un fichier spécifique pour la page d'accueil en créant le fichier `home.php` ou `front-page.php`. Si vous créez le fichier `front-page.php`, il sera utilisé si ce réglage est activé quelque soit le choix précédent.

[Front Page](https://bom.ciens.ucv.ve/dataset/data/20140924151121/#Creating_a_Static_Front_Page)
