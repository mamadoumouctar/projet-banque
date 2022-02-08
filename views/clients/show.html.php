<?php template('base') ?>

<?php section('title', "Tm Banque - Client n° ".$data['id']) ?>

<?php section('content') ?>
<div class="card" style="background-color: #FAEBD7;">
  <div class="card-header" style="height: 56px;">
    <h2>Information sur l'utilisateur <?= $data['id'] ?></h2>
  </div>
  <div class="card-body">
     <a href="<?= generate('clients.index') ?>" class="btn btn-primary">Aller à la liste</a>
     <a href="<?= generate('clients.edit', ['id' => $data['id']]) ?>" class="btn btn-secondary">Modifier</a>
     <a href="<?= generate('clients.delate', ['id' => $data['id']]) ?>" onClick="return confirm('Vous ête sûre de bien vouloir supprimer cet utilisateur ?');" class="btn btn-danger">Supprimer</a>
     <a href="<?= generate('comptes.create', ['id' => $data['id']]) ?>" class="btn btn-info">Ajouter un compte</a>

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
    <hr>
    <h2>Compte de l'utilisateur</h2>
    <table class="table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Solde</th>
                <th scope="col">Date creation Compte</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['comptes'] as $value) : ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['solde'] ?> FCFA</td>
                <td><?= (new DateTime($value['created_at']))->format('d F Y e') ?></td>
                <td>
                    <a class="btn btn-info" href="<?= generate('comptes.show', ['id' => $value['id']]) ?>">Afficher</a>
                    <a class="btn btn-secondary" href="<?= generate('comptes.credit', ['id' => $value['id']]) ?>">Crediter</a>
                    <a class="btn btn-warning" href="<?= generate('comptes.retire', ['id' => $value['id']]) ?>">Retirer</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
  </div>
</div>
<?php endSection() ?>