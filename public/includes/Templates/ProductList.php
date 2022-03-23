<h1>Producten lijst</h1>
<?php if (isset($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php
//If logged in, show function
if ($this->session->keyExists('user')) {
?>
    <a href="<?= BASE_PATH; ?>add">Product toevoegen</a>
    <a href="<?= BASE_PATH; ?>logout">Uitloggen</a>
<?php
}
if (isset($_SESSION['reservation']))
{
    ?>
    <a href="<?= BASE_PATH; ?>reservationEdit?code=<?= $code; ?>">Bekijk reservering</a>
<?php
}
?>
<?php if (isset($products) and $totalProducts != 0 ){ ?>
    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>prijs</th>
            <th>Details</th>
            <th>Reserveren</th>
            <?php
            //If logged in, show function
            if ($this->session->keyExists('user')) {
            ?>
            <th>Edit</th>
            <th>Delete</th>
            <?php
            }
            ?>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="10">Totaal aantal producten: <?= $totalProducts; ?> </td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->name; ?></td>
                <td><?= $product->price; ?></td>
                <td><a href="<?= BASE_PATH; ?>detail?id=<?= $product->id; ?>">Details</a></td>
                <td><a href="<?= BASE_PATH; ?>reservation?id=<?= $product->id; ?>">Toevoegen</a></td>
                <?php
                //If logged in, show function
                if ($this->session->keyExists('user')) {
                ?>
                <td><a href="<?= BASE_PATH; ?>edit?id=<?= $product->id; ?>">Edit</a></td>
                <td><a href="<?= BASE_PATH; ?>delete?id=<?= $product->id; ?>">Delete</a></td>
                    <?php
                }
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }

elseif ($totalProducts == 0)
    {
      ?>
        <p> Er zijn momenteel geen producten in de data base. Maak deze eerst aan door op de plus knop bovenin het shcemr te drukken</p>
<?php
    } ?>
