<div class="redirection-list">
    <?php foreach ($redirection_list as $key => $redirection) : ?>

        <div class="wrap wrap-<?= $key ?>" data-field="<?= $key ?>">
            <label for="slug-<?= $key ?>">Slug</label>
            <input type="text" id="slug-<?= $key ?>" name="<?= $setting_id ?>[<?= $key ?>][slug]" value="<?= isset($redirection["slug"]) ? esc_attr($redirection["slug"]) : ''; ?>">
            <label for="redirection-<?= $key ?>">Redirection</label>
            <input type="text" id="redirection-<?= $key ?>" name="<?= $setting_id ?>[<?= $key ?>][redirection]" value="<?= isset($redirection["redirection"]) ? esc_attr($redirection["redirection"]) : ''; ?>">
            <a class="button button-action redirection-remove">Remove</a>
        </div>

    <?php endforeach ?>
</div>

<br>
<a class="button button-action redirection-add">Add</a>

<script>
    const addField = () => {
        const redirectionLength = document.querySelectorAll('.redirection-remove').length;
        document.querySelector('.redirection-list').innerHTML += `
        <div class="wrap">
        <label for="slug-${ redirectionLength }">Slug</label>
        <input type="text" id="slug-${ redirectionLength }" name="<?= $setting_id ?>[${ redirectionLength }][slug]" value="">
        <label for="redirection-${ redirectionLength }">Redirection</label>
        <input type="text" id="redirection-${ redirectionLength }" name="<?= $setting_id ?>[${ redirectionLength }][redirection]" value="">
        <a class="button button-action redirection-remove">Remove</a>
        </div>
        `;
    };

    const removeField = (id) => {
        const wrap = document.querySelector(`.wrap-${id}`);
        disabledField(id);
        jQuery.post('<?= $ajax_url ?>', {
            action: 'redirection_update',
            _ajax_nonce: '<?= $nonce ?>',
            redirection_id: id
        }).then(() => {
            enableField(id);
            wrap.parentNode.removeChild(wrap);
        });
    };

    const disabledField = (id) => {
        const wrap = document.querySelector(`.wrap-${id}`);
        document.querySelector('.redirection-add').setAttribute('disabled', 'disabled');
        wrap.querySelectorAll('input').forEach((input) => {
            input.disabled = true;
        })
    };

    const enableField = (id) => {
        const wrap = document.querySelector(`.wrap-${id}`);
        document.querySelector('.redirection-add').removeAttribute('disabled');
        wrap.querySelectorAll('input').forEach((input) => {
            input.disabled = false;
        })
    };

    document.querySelector('.redirection-add').addEventListener(
        'click',
        (e) => !e.target.getAttribute('disabled') ? addField() : null
    );

    document.querySelectorAll('.redirection-remove').forEach((button) => button.addEventListener(
        'click',
        (e) => !e.target.getAttribute('disabled') ? removeField(button.parentNode.getAttribute("data-field")) : null
    ));

</script>