<?php template('base') ?>

<?php section('title', "Tm Banque - Comptes Create") ?>

<?php section('content') ?>
<div class="card" style="background-color: #FAEBD7;">
  <div class="card-header" style="height: 56px;">
    <h2>Création d'un nouveau compte </h2>
  </div>
  <div class="card-body">
    <table class="table mt-3">
        <tbody>
            <tr>
                <th>Nom</th>
                <td><?= $data['nom'] ?></td>
            </tr>
            <tr>
                <th>Prenom</th>
                <td><?= $data['prenom'] ?></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td><?= $data['telephone'] ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= $data['address'] ?></td>
            </tr>
            <tr>
                <th>Date inscription</th>
                <td><?= (new DateTime($data['created_at']))->format('d F Y e') ?></td>
            </tr>
        </tbody>
    </table>
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
  			<label for="code">Code</label>
  			<input autofocus type="password" class="form-control" name="code" id="code" value="<?= $post['code'] ?? '' ?>"></input>
  		</div>
  		<button class="btn btn-primary mt-3" type="submit">Enregistré le compte au client</button>
  	</form>
  </div>
</div>

<?php endSection() ?>