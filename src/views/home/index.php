<?php require_once __DIR__ . '/../include/header.php'; ?>


<form action="/" method="POST" enctype="multipart/form-data">

    <?php require_once __DIR__ . '/../../forms/transportForm.php'; ?>

    <label class="input-group-text">Informacje poszczególnych ładunków</label>

    <?php
    $i = 0;
    do {
        require __DIR__ . '/../../forms/cargoForm.php';
    } while ($i < $cargoNumber);

    echo('<div class="btn-group" role="group" aria-label="buttons">');

    echo '<a href="?cargo_number=' . $cargoNumber + 1 . '" class="btn btn-outline-primary">Dodaj kolejny ładunek</a>';
    if ($cargoNumber > 1)
        echo '<a href="?cargo_number=' . $cargoNumber - 1 . '" class="btn btn-outline-primary">Usuń ostatni ładunek</a>';

    ?>

    <button type="submit" class="btn btn-outline-primary">Wyślij</button>
    </div>
</form>

<?php require_once __DIR__ . '/../include/footer.php'; ?>
