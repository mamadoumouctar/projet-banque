<?php template('base') ?>

<?php section('title', "Tm Banque - Not Found") ?>

<?php section('content') ?>
<h1 class="text-xl text-danger">404 Not Found</h1>
<h2>La ressource démandé n'a pas été trouvée.</h2>
<p><?= $msg ?></p>
<?php endSection() ?>