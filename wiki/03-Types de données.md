# Types de données

* 🔖 **Custom post type**
* 🔖 **Taxonomie**
* 🔖 **Metaboxes**
* 🔖 **Template tags**
* 🔖 **Marqueurs conditionnels**
* 🔖 **Boucle principale**
* 🔖 **Boucle personnalisée**
* 🔖 **PDO**

___

## 📑 Custom post type

> Par défaut il existe deux types de post, article et page.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/post-type.jpg)

Il est possible de créer des types de post personnalisés. En utilisant les types de publication personnalisés, vous pouvez enregistrer votre propre type de publication. Une fois qu'un type de publication personnalisé est enregistré, il obtient un nouvel écran administratif de niveau supérieur qui peut être utilisé pour gérer et créer des publications de ce type.

### 🏷️ **Déclaration**

La fonction `register_post_type` permet d'ajouter un type.

```php
add_action('init', 'create_product_post_type');
function create_product_post_type()
{
    register_post_type(
        'product',
        [
            'labels' => [
                'name'          => 'Products',
                'singular_name' => 'Product',
            ],
            'public'      => true,
            'has_archive' => true,
        ]
    );
}
```

[Register post type](https://developer.wordpress.org/reference/functions/register_post_type/)

### 🏷️ **Affichage**

Il est possible d'utiliser hierarchie wordpress pour créer un fichier de template personnalisé afin de ne pas utiliser celui des articles et des pages qui serait `archive.php`. Il suffit de créer un fichier qui possède le nom de type.

> Il est évidement possible de personnaliser l'extraction d'un type particulier.

[Working this custom post type](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/)

Attention, à la mise en place vous devez exécuter la fonction suivante une fois. Inscrivez la en haut du fichier `functions.php` pour suprimez la.

```php
flush_rewrite_rules();
```
___

👨🏻‍💻 Manipulation

Créez un type personnalisé

___

## 📑 Taxonomie

Par défaut, WordPress inclut deux types de taxonomies ouvertes au public :

* Catégories
* Étiquettes

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/category.png)

### 🏷️ **Déclaration**

Il est possible de créer de novuelles taxonomies! Pour ce faire il faut ajouter du code php dans le fichier functions.php.

```php
add_action('init', 'create_color_taxonomies');

function create_color_taxonomies()
{
    register_taxonomy('color', ['product'], [
        'hierarchical'      => true,
        'labels'            => [
            'name'              => 'Colors',
            'singular_name'     => 'Color',
            'search_items'      => 'Search Colors',
            'all_items'         => 'All Colors',
            'parent_item'       => 'Parent Color',
            'parent_item_colon' => 'Parent Color',
            'edit_item'         => 'Edit Color',
            'update_item'       => 'Update Color',
            'add_new_item'      => 'Add New Color',
            'new_item_name'     => 'New Color Name',
            'menu_name'         => 'Color',
        ],
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'genre'],
    ]);
}
```

[Register taxonomy](https://developer.wordpress.org/reference/functions/register_taxonomy/)

Le second argument de `register_taxonomy` correspond à un tableau des types auxquels seront appliqués cette taxonomie.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/taxonomy.png)

### 🏷️ **Affichage**

Il existe plusieurs fonctions pour afficher ou récupérer les valeurs d'une taxonomie personnalisée.

La fonction get_the_term_list permet l'affichage avec un séparateur des taxonomies en fonction de l'identifiant d'un post. Il faut être dans le contexte de la boucle pour avoir à disposition l'identifiant du post.

```php
<?php the_terms(get_the_ID(), 'color', '', ', ') ?>
```

___

👨🏻‍💻 Manipulation

Créez une nouvelle taxonomie dans votre thème enfant pour le type personnalisé créé précédemment

___

## 📑 Metaboxes

Les metabox (ou boîtes à meta information) sont des données enregistrées pour un contenu spécifique (page ou article donné) et qui permettent par exemple de facilement modifier l’affichage du contenu selon les informations saisies.

En fait, vous les utilisez à chaque fois sans que vous le sachiez vraiment. Les catégories, tags, format etc… sont autant de metaboxes.

### 🏷️ **Déclaration**

Il est possible de créer ses propres méta boxes grace à des plugins ainsi qu'en modifiant le fichier function.php.

La fonction `create_meta_box` déclare une nouvelle box.

```php
add_action('add_meta_boxes', 'create_meta_box');

function create_meta_box()
{
    add_meta_box(
        'some_wporg_box_id',
        'Custom Meta Box Title',
        'create_meta_box_html',
        'post'
    );
}
```

Il faut spécifier le contenu HTML de cette box.

```html
function create_meta_box_html($post)
{
    $value = get_post_meta($post->ID, 'some_wporg_box_id', true);
?>
    <label for="some_wporg_field">Description for this field</label>
    <select name="some_wporg_field" id="some_wporg_field" class="postbox">
        <option value="something-else" <?php selected($value, 'something-else') ?>>Select something...</option>
        <option value="something"<?php selected($value, 'something') ?>>Something</option>
        <option value="else"<?php selected($value, 'else') ?>>Else</option>
    </select>
<?php
}
```

Il faut enregistrer la valeur de la box si le type est mis à jour.

```php
add_action('save_post', 'create_meta_box_save');

function create_meta_box_save($post_id)
{
    if (array_key_exists('some_wporg_field', $_POST)) {
        update_post_meta(
            $post_id,
            'some_wporg_box_id',
            $_POST['some_wporg_field']
        );
    }
}
```

C'est un peu technique mais comme nous pouvons l'observer ce sont les fonctions PHP de wordpress qui permettent sa customisation.

### 🏷️ **Affichage**

Nous pouvons récupérer facilement le contenu d'une box dans un template, dans le contexte de la boucle comme observé pour la taxonomie. La fonction get_post_meta permet de récupérer la valeur d'une box.

```php
<h1>
<?php echo get_post_meta(get_the_ID(), 'some_wporg_box_id', true) ?>
</h1>
```

___

👨🏻‍💻 Manipulation

Créez une nouvelle meta box dans votre thème enfant pour le type personnalisé créé précédemment

__

## 📑 Template tags

A l'intérieur d'un fichier qui afficha un post, article ou autre type de données vous pouvez utiliser des fonctions pour récupérer ses différentes informations. Ce sont les template tags.

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/wordpress-loop.jpg)

[Template tags](https://codex.wordpress.org/Template_Tags)

> L'identification des fonctions par catégorie permet de reprendre la main sur le contenu affiché par le thème.

Ces fonctions doivent être étudiées pour les exécuter en respectant leur signature, à savoir la liste des arguments attendus et en analysant la valeur de retour ou le comportement de la fonction.

Par exemple `the_title` affiche le titre et ne s'utilise pas avec echo.

```php
<?php the_title() >
```

___

👨🏻‍💻 Manipulation

Observons les différentes fonctions proposées

___

## 📑 Marqueurs conditionnels

Les Marqueurs Conditionnels peuvent être utilisés dans vos Thèmes pour décider du contenu à afficher sur une page spécifique ou comment ce contenu doit être affiché en fonction de conditions que remplit cette page. Par exemple, si vous voulez insérer un texte particulier au-dessus d'une série d'Articles, mais seulement sur la page principale de votre blog, avec le Marqueur Conditionnel `is_home`(), cela devient facile.

[Conditionnal tags](https://codex.wordpress.org/fr:Marqueurs_conditionnels)

Ils sont à utiliser avec la structure conditionnelle du langage php.

```php
<?php 
if (is_home()) {

echo "<h1>Vous êtes sur la page d'accueil.</h1>";

}
?>
```

Observons les variantes, le tag php peut entourer uniquement le code php.

```html
<?php if (is_home()) { ?>

<h1>Vous êtes sur la page d'accueil.</h1>

<?php } ?>
```

La condition peut utiliser une syntaxe plus lisible

```html
<?php if (is_home()): ?>

<h1>Vous êtes sur la page d'accueil.</h1>

<?php endif ?>
```

___

## 📑 Boucle principale

Par défaut, wordpress extrait tous les posts en rapport avec l'url en cours pour afficher ses informations. C'est la boucle `while` qui est utilisée avec la fonction `have_post`.

```php
while ( have_posts() ) :
	the_post();

 // Content inside the loop.

endwhile;
```

A l'intérieur de la obucle vous pouvez obtenir toutes les inforamtions sur le post via les fonctions observés précédements comme `the_content`.

___

## 📑 Boucle personnalisée

> Il est possible que vous souhaitiez procéder à une extraction personnalisée du contenu.

### 🏷️ **Déclaration**

Certains objets wordpress comme `WP_Query` permettent de formuler des requêtes personnalisées. Il suffit de se documenter pou renseigner les paramètres souhaités.

[Wp Query](https://developer.wordpress.org/reference/classes/wp_query/#parameters)

```php
$query = new WP_Query([
    'post_type' => 'product',
]);
```

### 🏷️ **Affichage**

Pour exploiter cette requête personnalisée il suffit de légèrement modifier la boucle par défaut.

```php
while ($query->have_posts() ) :
	$query->the_post();

    // Content inside the loop.
endwhile;
```

L'ensemble des templates tags fonctionnerons en utilisant la méthode `the_post` de la requête personnalisée.

___

👨🏻‍💻 Manipulation

Créez une page qui affiche l'ensemble des posts de votre custom post type créé au chapitre précédent.

___

Avec la variable globale $wpdb il est possible d'exécuter des requêtes en SQL natif.

[wpdb](https://developer.wordpress.org/reference/classes/wpdb/)

```php
$results = $wpdb->get_results($wpdb->prepare('SELECT * from wp_posts'));
```