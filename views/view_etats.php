<div>
    <h1>Etats</h1>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>Libéllé</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etats as $e) { ?>
                <tr>
                    <td><?= $e->getName() ?></td>
                    <td><?= $e->getDescription() ?></td>
                    <td><button onclick= "window.location.href = '?p=edit_etat&id=<?=$e->getId()?>'">Modifier</button></td>
                    <td><button onclick= "window.location.href = '?p=delete_member&id=<?=$e->getId()?>'">Supprimer</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button onclick= "window.location.href = '?p=new_etat'">Ajouter un état</button>
</div>