<?php template('base') ?>

<?php section('title', "Tm Banque - Comptes n° ".$data['id']) ?>

<?php section('content') ?>
<div class="card" style="background-color: #FAEBD7;">
  <div class="card-header" style="height: 56px;">
    <h2>Information sur le compte <?= $data['id'] ?></h2>
  </div>
  <div class="card-body">
     <a href="<?= generate('comptes.index') ?>" class="btn btn-primary">Aller à la liste</a>
     <a href="<?= generate('comptes.credit', ['id' => $id]) ?>" class="btn btn-secondary">Crediter</a>
     <a href="<?= generate('comptes.retire', ['id' => $id]) ?>" class="btn btn-warning">Retirer</a>
    <div class="row mt-3">
    	<div class="col-md-6">
		    <h3>Propietaire</h3>
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
    	</div>
    	<div class="col-md-6">
		    <h3>Compte</h3>
		    <table class="table mt-3">
		        <tbody>
		            <tr class="text-xl">
		                <th>Solde</th>
		                <td><?= number_format ((float)$data['solde'], 2, '.', ' ') ?> FCFA</td>
		            </tr>
		            <tr>
		                <th>Date inscription</th>
		                <td><?= (new DateTime($data['createdAt']))->format('d F Y e') ?></td>
		            </tr>
		        </tbody>
		    </table>
    	</div>
    </div>
    <hr>
    <h2>Opperation sur le compte</h2>
    <?php if(!empty($opperations)): ?>
    	<table class="table" style="width: 40%;">
    		<thead>
    			<tr>
    				<th>Id</th>
    				<th>Date</th>
    				<th>Montant</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php foreach($opperations as $op): ?>
    			<tr class="<?= $op['type'] == 'dep' ? 'text-success':'text-danger' ?>">
    				<td><?= $op['id'] ?></td>
    				<td><?= $op['created_at'] ?></td>
    				<td><?= $op['type'] == 'dep' ? '+':'-' ?><?= $op['montant'] ?> FCFA</td>
    			</tr>
    		<?php endforeach ?>
    		</tbody>
    	</table>
    <?php else : ?>
    	<h5 class="text-muted">Cet compte n'a pas encore d'opperation.</h5>
    <?php endif ?>
  </div>
</div>
<div class="mb-3" style="height:54px;"></div>
<?php endSection() ?>