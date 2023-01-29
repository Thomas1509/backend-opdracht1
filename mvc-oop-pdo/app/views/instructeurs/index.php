<h3><?= $data['instructorName']; ?></h3>


<table border="1">
    <thead>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Mobiel</th>
        <th>Aantalsterren</th>
        <th>Voertuigen</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>

</table>