<div class="redirection-list">
    <?php foreach ($redirectionList as $key => $redirection) : ?>

        <div class="wrap">
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
    console.log(jQuery);
    document.querySelectorAll('.redirection-remove').forEach((button) => button.addEventListener('click', () => button.parentNode.parentNode.removeChild(button.parentNode)));
    document.querySelector('.redirection-add').addEventListener('click', () => {
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
    });
</script>