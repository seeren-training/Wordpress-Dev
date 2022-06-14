# Extensions et widget

* 🔖 **Les hooks**
* 🔖 **Installation, Activation et Désactivation**
* 🔖 **Option et administration**
* 🔖 **Setting**
* 🔖 **Transients**
* 🔖 **Internationalisation**

___

## 📑 Les hooks

Les Hooks sont des fonctions déclarées par le développeur de thème ou d’extension qui permettent d’interagir avec le coeur de WordPress, d’autres thèmes ou extensions et lancés à des moments clés de leur exécution. 

![image](https://raw.githubusercontent.com/seeren-training/Wordpress-Perfectionnement/master/wiki/resources/hook.png)

Par exemple, on peut intercepter le moment où WordPress enregistre un article dans la base, afin d’y apporter des modifications. Il existe 2 types de Hooks : les `actions`, un moment clé pour lancer ses propres fonctions, et les `filtres`, pour intercepter une valeur à un moment donné et la modifier.

### 🏷️ **Action et filtre**

La principale différence entre une action et un filtre peut se résumer ainsi :

* Une action prend les informations qu'elle reçoit, en fait quelque chose et ne renvoie rien. En d'autres termes : il agit sur quelque chose puis sort, ne renvoyant rien au crochet appelant.
* Un filtre prend les informations qu'il reçoit, les modifie d'une manière ou d'une autre et les renvoie. En d'autres termes : il filtre quelque chose et le renvoie au crochet pour une utilisation ultérieure.

Dit autrement :

* Une action interrompt le flux de code pour faire quelque chose, puis revient au flux normal sans rien modifier ;
* Un filtre est utilisé pour modifier quelque chose d'une manière spécifique afin que la modification soit ensuite utilisée par le code plus tard.

[Hooks](https://developer.wordpress.org/plugins/hooks/)

### 🏷️ **Action**

Les actions sont l'un des deux types de Hooks. Ils fournissent un moyen d'exécuter une fonction à un moment spécifique de l'exécution de WordPress Core, des plugins et des thèmes. Les fonctions de rappel d'une action ne renvoient rien au hook d'action appelant. Ils sont la contrepartie des filtres. Voici un rappel de la différence entre les actions et les filtres.

[List des actions](https://codex.wordpress.org/Plugin_API/Action_Reference)

Nous avons déjà enregistré des actions pour par exemple ajouter un type de post personnalisé. Nous avons utilisé la fonction `add_action`.

___

👨🏻‍💻 Manipulation

Observons les différentes actions proposées

___

La fonction `add_action` prend en premier argument le nom d'un hook d'action et en second argument le nom d'une fonction de rappel.

```php
add_action(
    'init', 
    'create_product_post_type'
);
```

### 🏷️ **Filtre**

Les filtres sont l'un des deux types de Hooks. Ils permettent aux fonctions de modifier les données lors de l'exécution de WordPress Core, des plugins et des thèmes. Ils sont la contrepartie des Actions. Contrairement aux actions, les filtres sont destinés à fonctionner de manière isolée et ne devraient jamais avoir d'effets secondaires tels qu'affecter les variables globales et la sortie. Les filtres s'attendent à ce que quelque chose leur soit renvoyé.

[Les des filtres](https://codex.wordpress.org/Plugin_API/Filter_Reference)

Vous utiliserez la fonction `add_filter` en passant au moins deux paramètres :

La fonction add_action prend en premier argument le nom d'un hook d'action et en second argument le nom d'une fonction de rappel.

> Par exemple pour modifier l'ensemble des titres des posts.

```php
function filter_title_custom( $title ) {
    return 'The ' . $title . ' was filtered';
}
add_filter( 'the_title', 'filter_title_custom' );
```

L'avantage est de pouvoir centraliser et automatiser l'ensemble des vues sans avoir à les modifier unitairement.

___

👨🏻‍💻 Manipulation

Observons les différents filtres proposées

___

## 📑 Installation, Activation et Désactivation

Le développement de plugin est documenté sur le codex.

[Plugins](https://developer.wordpress.org/plugins/)

### 🏷️ **Déclaration**

Votre plugin doit se trouver dans wp-content/plugins. Il doit posséder un nom de dossier qui contient un fichier au nom identique et en kebab-case.

[Création de fichier](https://developer.wordpress.org/plugins/plugin-basics/)

Le point d'entré du plugin doit contenir une entête.

### 🏷️ **Header**

L'entête minimum contient uniquement le nom accessible du plugin.

[Header](https://developer.wordpress.org/plugins/plugin-basics/header-requirements/)

```php
/**
 * Plugin Name: Your plugin name
 * 
 * Requires PHP: 8.1
 * Version: 0.0.1
 * Text Domain: your-plugin-name
 * License: MIT
 */
```

Il est possible que le plugin offre de nouveaux onglets à l'espace d'administration ainsi que de nouveaux types de post ou de taxonomie. A l'activation et à la désactivation il est consiller de vider le cache des URL de wordpress.

### 🏷️ **Activation**

Pour réagir programmatiquement à l'activation nous pouvons utiliser le hook `register_activation_hook`.

[Activation](https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/#activation)

```php
function pluginprefix_activate() { }

register_activation_hook(__FILE__, 'pluginprefix_activate');
```

Dans un approche objet la syntaxe pour un appel static est la suivante:

```php
register_activation_hook(__FILE__, [SomeController::class, 'activate']);
```

Dans un approche objet la syntaxe pour un appel dynamique est la suivante:

```php
register_activation_hook(__FILE__, [$this, 'activate']);
```

### 🏷️ **Désactivation**

Pour réagir programmatiquement à la désactivation nous pouvons utiliser le hook `register_deactivation_hook`.

[Désactivation](https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/#deactivation)


### 🏷️ **Erreurs**

Vous pouvez intérompre le processus en tuant le programme avec wp_dien ou alors vous pouvez afficher des notices en utiisant le hook admin_notices

```php
add_action( 'admin_notices', 'my_notices' );

function my_notices () {
    echo 'Error you did not meet the WP minimum version';
}
```

___

👨🏻‍💻 Manipulation

Créez un plugin, à l'installation affichez un message d'erreur si la version de php est inférieure à la 8.

___

## 📑 Option et administration

Généralement un plugin possède un menu dédié à sa gestion, observons comment les déclarer.

### 🏷️ **Menu**

La déclaration minimale est la suivante:

```php
add_action( 'admin_menu', 'wporg_options_page' );
function wporg_options_page() {
    add_menu_page(
        'Page Title',
        'Menu Title',
        'manage_options',
        'some_slug',
        function () {
            echo 'HTML Display';
        }
    );
}
```

[TopMenu](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

### 🏷️ **Submenu**

Le sous menu a besoin du slug du top menu.

```php
function wporg_options_page()
{
    add_submenu_page(
        'parent_slug',
        'Page Title',
        'Menu Title',
        'manage_options',
        'some_slug',
        function () {
            echo 'HTML Display';
        }
    );
}
add_action('admin_menu', 'wporg_options_page');
```

[SubMenu](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

___

👨🏻‍💻 Manipulation

Créez un menu et un sous menu avec des objectifs fonctionnels

___

## 📑 Setting

L'API Settings, ajoutée dans WordPress 2.7, permet de gérer de manière semi-automatique les pages d'administration contenant des formulaires de paramètres.

Néanmoins leur implémentation peu sembler complexe si vous ne respectez pas les étapes.

### 🏷️ **Register setting**

Dans un premier temps vous devez enregistrer un setting.

```php
add_action('admin_init', function () {
    register_setting('reading', 'wporg_setting_name');
};
```

[Register setting](https://developer.wordpress.org/reference/functions/register_setting/)

### 🏷️ **Settings section**

Le setting doit être rataché à une section.

```php
add_action('admin_init', function () {
    add_settings_section(
        'wporg_settings_section',
        'WPOrg Settings Section', 
        function () {
            echo '<p>WPOrg Section Introduction.</p>'
        },
        'reading'
    );
};
```
[Add setting section](https://developer.wordpress.org/reference/functions/add_settings_section/)

### 🏷️ **Section fields**

Enfin des champs peuvent être ajoutés à la section.

```php
add_settings_field(
    'wporg_settings_field',
    'WPOrg Setting', 
    function () {
        $setting = get_option('wporg_setting_name');
        ?>
            <input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
        <?php
    },
    'reading',
    'wporg_settings_section'
);
```

[Add setting field](https://developer.wordpress.org/reference/functions/add_settings_field/)

Pour stocker des tableaux il vous faudra boucler sur les résultats et utiliser la notation my_name[] dans l'attribut name des champs.

Pour récupérer la valeur d'un réglage vous utilisez la option API avec `get_option` dans le cas présent.

[Option API](https://developer.wordpress.org/plugins/settings/options-api/)

### 🏷️ **Affichage**

Pour terminer vous pouvez afficher vos sections dans les pages concernées.

```php
<form action="options.php" method="post">
    <?php
    settings_fields( $title );
    do_settings_sections( $title );
    submit_button( 'Save Settings' );
    ?>
</form>
```

___

👨🏻‍💻 Manipulation

Implémentez un réglage

___

## 📑 Transients

La transients API permet de stocker en cache dans la base de données, ses fonctions sont simples.

[Transients](https://developer.wordpress.org/apis/handbook/transients/)

```php
set_transient( 'special_query_results', $special_query_results, 60*60*12 );
```

```php
$data = get_transient( 'special_query_results' );
```

___

👨🏻‍💻 Manipulation

Enregistrez l'heure de la dernière modification du setting et affichez la.

___

## 📑 Internationalisation

Pour internationaliser il faut commencer à sa déclaration à fourni un text domain et un domain path, cela correspond à l'identifiant utilisé comme clef de traduction et à l'emplacement des fichiers de traduction.

```php
* Text Domain: wp-easy-redirection
* Domain Path: /languages
```

### 🏷️ **File**

Il vous faut créer un fichier .po. Il contient les clefs valeur pour chaque langue, vous pouvez utilsier des services en ligne:

[Poeditor](https://localise.biz/free/poeditor)

Une fois vos couples créés, vous devez compiler votre fichier pour obtenir un fichier .mo. Vous pouvez utiliser des extensions ou le logiel POEdit.

[Poedit](https://poedit.net/)

### 🏷️ **Path**

Une fois que vous possédez vos fichiers vous devez les daplacer dans le dossier renseigné dans la déclaration du plugin.

Si le plugin n'est pas officiel, vous devez vous même déplacer les fichiers à l'activation.

```php
        foreach (['mo', 'po'] as $extension) {
            $source = 'pathtoplugin/languages/wp-easy-redirection-fr_FR.' . $extension;
            $destination = 'pathtowp-content/languages/plugins/wp-easy-redirection-fr_FR.'  . $extension;
            copy($source, $destination);
        }
```

___

👨🏻‍💻 Manipulation

Traduisez une expression du plugin

___