<?php template('base') ?>

<?php section('title', "Tm Banque - Clients Create") ?>

<?php section('content') ?>

<div class="card" style="background-color: #FAEBD7;">
  <div class="card-header" style="height: 56px;">
    <h2>Modification de l'utilisateur </h2>
  </div>
  <div class="card-body">
  	<form method="post">
  		<?php if(is_array($errors) && !empty($_POST)): ?>
  			<div class="text-danger">
  			<ul>
  				<?php foreach($errors as $error): ?>
  					<li><?= $error ?></li>
  				<?php endforeach ?>
  			</ul>
  		</div>
  		<?php endif ?>
  		<div class="form-group">
  			<label for="nom">Nom</label>
  			<input class="form-control" name="nom" id="nom" value="<?= $data['nom'] ?>"></input>
  		</div>
  		<div class="form-group">
  			<label for="prenom">Prenom</label>
  			<input class="form-control" name="prenom" id="prenom" value="<?= $data['prenom'] ?>"></input>
  		</div>
  		<div class="form-group">
  			<label for="telephone">telephone</label>
  			<input class="form-control" name="telephone" id="telephone" value="<?= $data['telephone'] ?>"></input>
  		</div>
  		<div class="form-group">
  			<label for="address">Address</label>
  			<input class="form-control" name="address" id="address" value="<?= $data['address'] ?>"></input>
  		</div>
  		<button class="btn btn-primary mt-3" type="submit">Modifier le client</button>
  	</form>
  </div>
</div>
<?php endSection() ?>