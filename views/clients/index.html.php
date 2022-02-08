<?php template('base') ?>

<?php section('title', "Tm Banque - Clients") ?>

<?php section('content') ?>
<div style="display: flex; justify-content: space-between; align-content: center; align-items: center;">
    <h2>Affichage de tout les cients de la Banque</h2>
    <a class="btn btn-primary m-2" href="<?= generate('clients.create') ?>">Ajouter un client</a>
</div>
<table class="table" style="background-color: #FAEBD7;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value) : ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['nom'] ?></td>
                <td><?= $value['prenom'] ?></td>
                <td><?= $value['telephone'] ?></td>
                <td><?= $value['address'] ?></td>
                <td>
                    <a class="btn btn-info mb-1" href="<?= generate('clients.show', ['id' => $value['id']]) ?>">Afficher</a>
                    <a class="btn btn-secondary" href="<?= generate('clients.edit', ['id' => $value['id']]) ?>">Modifier</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endSection() ?>
