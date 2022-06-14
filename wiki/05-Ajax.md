# Ajax

* 🔖 **jQuery**
* 🔖 **Hook**
* 🔖 **Admin**

___

## 📑 jQuery

Votre script jQuery s'exécute sur le navigateur de l'utilisateur après la réception de votre page Web WordPress. Une instruction jQuery de base comporte deux parties : un sélecteur qui détermine les éléments HTML auxquels le code s'applique, et une action ou un événement, qui détermine ce que fait le code ou ce à quoi il réagit. L'instruction d'événement de base ressemble à ceci :

```js
jQuery.(selector).click(() => console.log('Clicked'));
```

Nous allons devoir utiliser jQuery ou JavaScript natif. jQuery est déjà intégré à Wordpress

___

## 📑 Hook

Il y a plusieurs étapes pour pouvoir enregistrer un endpoint.

### 🏷️ **Enqueue Scripts**

La premirèe étape consiste à ajouter un script en file d'attente.

```php
add_action('admin_enqueue_scripts', function () use ($nonceId) {
    $scriptId = 'my_field_ajax';
    wp_enqueue_script(
        $scriptId,
        plugins_url('assets/js/my_field/ajax.js', PLUGIN_FILE_CONST),
        array('jquery')
    );

});
```

### 🏷️ **Localize Script**

Toujours dans le même hook vous devez générer un token pour donner le droit à ce script de réagir à une requête HTTP.

```php
$nonceId = 'arbitrary_string';
$nonce = wp_create_nonce($nonceId);
wp_localize_script(
    $scriptId,
    'js_global_variable',
    [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => $nonce,
    ]
);
```

Wordpress peuple le script d'une variable globale dont l'identifiant est determiné en second argument.


### 🏷️ **Jquery**

Vous pouvez alors firmuler unerequête qui n'a pas encore de endpoint fonctionnel.

```js
jQuery.ajax({
    url: js_global_variable.ajax_url,
    data:{
        action: 'some_controller_action',
        _ajax_nonce: js_global_variable.nonce
    },
    success: () => {
        console.log('success');
    },
    error: () => {
        console.log('error');
    },
});
```

La prochaine étape est de proposer une fonction pour l'action renseignée.

___

## 📑 Admin

Côté admin vous devez utiliser le hook `wp_ajax_nom_de_l_action`, alors qu'en dehors de l'espace d'administration vous devez utiliser `wp_ajax_nopriv_nom_de_l_action`

### 🏷️ **Ajax**

Dans ce hook vous pouvez rattacher un script qui intercepte la requête et renvoie une réponse. Vous devez posséder la valeur utilisée pour le nonce afin de la vérifier au début.
```js
add_action('wp_ajax_some_controller_action', function () use ($nonceId) {
    check_ajax_referer($nonceId);
    // do stuff
    wp_die();
});
```
