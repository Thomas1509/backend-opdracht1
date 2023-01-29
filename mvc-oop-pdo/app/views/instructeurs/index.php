<h3><?= $data['title']; ?></h3>
<h3>Aantal instructeurs: <?= $data['aantal']; ?></h3>


<table border="1">
    <thead>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Mobiel</th>
        <th>Datum In Dienst</th>
        <th>Aantalsterren</th>
        <th>Voertuigen</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>

</table>

<br>