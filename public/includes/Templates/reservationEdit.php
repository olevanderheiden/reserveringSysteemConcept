<?php if (isset($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<h1>Wijzig reservering</h1>
<?php if (isset($reservation) and $orders != null)
    {

    ?>

<table>
    <thead>
    <tr>
        <th>
            Product naam
        </th>
        <th>
            productPrijs
        </th>
        <th>
            Aantal
        </th>
        <th>
            Totaal Prijs
        </th>
        <th>
            Verwijder
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
foreach ($orders as $order)
{
    ?>
    <tr>
        <td><?= $order->name; ?></td>
        <td>€<?= $order->price; ?></td>
        <td><?= $order->getAmount(); ?></td>
        <td>€<?= $order->price*$order->getAmount(); ?></td>
        <td><a href="<?= BASE_PATH; ?>deleteOrder?id=<?= $order->getId(); ?>">Delete</a></td>
    </tr>

    <?php
}
 ?>
    </tbody>
</table>

<?php }
else
{
?>
    <p> Deze reservering heeft geen orders. ga terug naar het hoofd menu en voeg producten toe.</p>
<?php
}
?>

<div>
    <a href="<?= BASE_PATH; ?>productlist">Ga terug naar lijst</a>
</div>