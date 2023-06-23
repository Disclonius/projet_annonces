<div>
    <h1>Annonces</h1>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>E-mail</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $m) { ?>
                <tr>
                    <td><?= $m->getUsername() ?></td>
                    <td><?= $m->getEmail() ?></td>
                    <td><?= date('d/m/Y', strtotime($m->getRegistration_date())) ?></td>
                    <td><button onclick= "window.location.href = '?p=edit_member&id=<?=$m->getId()?>'">Modifier</button></td>
                    <td><button onclick= "window.location.href = '?p=delete_member&id=<?=$m->getId()?>'">Supprimer</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>