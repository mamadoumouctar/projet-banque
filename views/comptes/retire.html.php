<?php template('base') ?>

<?php section('title', "Tm Banque - Comptes Retrait") ?>

<?php section('content') ?>
<div class="card" style="background-color: #FAEBD7;">
  <div class="card-header" style="height: 56px;">
    <h2>Retrait depuis le compte <?= $data['id'] ?></h2>
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
            <tr>
                <th>Solde</th>
                <td><?= number_format ((float)$data['solde'], 2, '.', ' ') ?> FCFA</td>
            </tr>
        </tbody>
    </table>
  	<form method="post">
  		<div class="form-group">
  			<label for="montant">Somme à créditer(en FCFA)</label>
  			<input autofocus type="float" placeholder="Montant" class="form-control" name="montant" id="montant" value="<?= $post['montant'] ?? '' ?>"></input>
  		</div>
  		<div class="form-group">
  			<label for="code">Somme à créditer(en FCFA)</label>
  			<input type="password" placeholder="Code" class="form-control" name="code" id="code" value="<?= $post['code'] ?? '' ?>"></input>
  		</div>
  		<button class="btn btn-primary" type="submit">Retirer depuis le compte</button>
  	</form>
  </div>
</div>

<?php endSection() ?>