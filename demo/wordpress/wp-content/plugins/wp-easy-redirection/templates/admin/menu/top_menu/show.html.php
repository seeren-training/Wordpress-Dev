<div class="wrap">
    <h1><?= $title ?></h1>
    <p><?= __('When you decide to change the slug of an article or a page then the links to the old slugs will fall on a 404 page', 'wp-easy-redirection') ?>.</p>
    <div class="card">
        <h2>Redirections</h2>
        <p>Créez des redirections de vos anciennes pages ou articles vers les nouvelles!</p>
        <a class="button button-primary" href="?page=<?= $redirection_slug ?>">Gérez vos redirections</a>
    </div>
</div>