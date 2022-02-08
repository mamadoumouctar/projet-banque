<?php template('base') ?>

<?php section('title', "Tm Banque - Comptes") ?>

<?php section('content') ?>
<div style="display: flex; justify-content: space-between; align-content: center; align-items: center;">
	<h2>Affichage de tout les comptes de la Banque</h2>
    <form method="post" action="<?= generate('comptes.create.clients') ?>" class="form-inline">
        <input class="form-control" type="text" name="telephone" placeholder="Entrer le numero du client pour ajouter un compte">
        <button class="btn btn-primary mr-1">Ajouter</button>
    </form>
</div>
<table class="table mt-3" style="min-width: 575px; background-color: #FAEBD7; padding: 5px; border-radius: 5px solid blue;">
        <thead>
            <tr>
                <th>Id Compte</th>
                <th>Nom Client</th>
                <th>Prenom Client</th>
                <th>Telephone Client</th>
                <th>Solde</th>
                <th>Date creation Compte</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value) : ?>
            <tr>
                <td style="display: flex; align-items: center; justify-content: center;"><?= $value['id'] ?></td>
                <td><?= $value['nom'] ?></td>
                <td><?= $value['prenom'] ?></td>
                <td><?= $value['telephone'] ?></td>
                <td><?= number_format ((float)$value['solde'], 2, '.', ' ') ?> FCFA</td>
                <td><?= (new DateTime($value['created_at']))->format('d F Y e') ?></td>
                <td>
                    <a class="btn btn-info m-1" href="<?= generate('comptes.show', ['id' => $value['id']]) ?>">Afficher</a>
                    <a class="btn btn-secondary m-1" href="<?= generate('comptes.credit', ['id' => $value['id']]) ?>">Crediter</a>
                    <a class="btn btn-warning m-1" href="<?= generate('comptes.retire', ['id' => $value['id']]) ?>">Retirer</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endSection() ?>