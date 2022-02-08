<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wipe('title', 'Tm Banque') ?></title>
	<link rel="icon" type="image/jpg" href="/img/logo.jpg">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css?v=3">
</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Tm Banque</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?= generate('home') ?>">Acceuil</a>
        <a class="p-2 text-dark" href="<?= generate('comptes.index') ?>">Gestion des comptes</a>
        <a class="p-2 text-dark" href="<?= generate('clients.index') ?>">Gestion des clients</a>
      </nav>
    </div>
	
	<div class="container">	
 	<?= wipe('content') ?>
	</div>
	<div style="margin: 50px;"></div>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/notify.min.js"></script>
	<?php if(hasFlashes()): ?>
		<script type="text/javascript">
			<?php if(hasFlashes('success')): ?>
			<?php foreach (getFlashes('success') as $value): ?>
				$.notify("<?= $value ?>", "success")
			<?php endforeach ?>
		<?php endif ?>
		<?php if(hasFlashes('info')): ?>
			<?php foreach (getFlashes('info') as $value): ?>
				$.notify("<?= $value ?>", "info")
			<?php endforeach ?>
		<?php endif ?>
		<?php if(hasFlashes('error')): ?>
			<?php foreach (getFlashes('error') as $value): ?>
				$.notify("<?= $value ?>", "error")
			<?php endforeach ?>
		<?php endif ?>
		</script>
	<?php endif ?>
</body>
</html>