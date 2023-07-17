<div>
    <h1>Membres</h1>
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
                    <td><button onclick= "window.location.href = '?p=modify_member.php&id=<?=$m->getId()?>'">Modifier</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>