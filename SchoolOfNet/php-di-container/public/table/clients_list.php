<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>

    </tr>

    <?php foreach($list as $client_array){?>
        <tr>
            <td><?= $client_array['id']; ?></td>
            <td><?= $client_array['name']; ?></td>
            <td><?= $client_array['email']; ?></td>
        </tr>

    <?php }?>
</table>
