<table id="tabel" class="display">
        <thead>
            <tr>
                <th><strong>Drinknaam</strong></th>
                <th><strong>Beschrijving</strong></th>
                
            </tr>
        </thead>

        <?php foreach ($dranken as $drinknaam): ?>

            <tr>
                <td><?php echo $drinknaam['Drinknaam']; ?></td>
                <td><?php echo $drinknaam['Beschrijving']; ?></td>
            
            </tr>
        <?php endforeach; ?>
    </table>