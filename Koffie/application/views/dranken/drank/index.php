<table id="tabel" class="display">
        <thead>
            <tr>
                <th><strong>Drinknaam</strong></th>
                <th><strong>Beschrijving</strong></th>
                
            </tr>
        </thead>

        <?php foreach ($dranken as $drinknaam): ?>

            <tr>
                <td><?php echo $drinknaampje['Drinknaam']; ?></td>
                <td><?php echo $drinknaampje['Beschrijving']; ?></td>
                <td> <a href="<?php echo site_url('../dranken/'.$drinknaam['Beschrijving']); ?>">View</a> | 
                <a href="<?php echo site_url('../dranken/edit/edit/'.$drinknaam['dranken_id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('../dranken/delete/delete/'.$drinknaam['dranken_id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>