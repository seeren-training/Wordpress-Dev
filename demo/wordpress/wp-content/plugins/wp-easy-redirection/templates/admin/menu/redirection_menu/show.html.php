<div class="wrap">
    <h1><?= $title ?></h1>
    <p>Ajouter, modifier et supprimer vos redirections.</p>
    <section>
        <?php settings_errors('wporg_messages') ?>
        <form action="options.php" method="post">
            <?php
            settings_fields($title);
            do_settings_sections($title);
            submit_button('Sauvegarder les redirections');
            ?>
        </form>
    </section>
</div>