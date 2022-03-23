<?php if (isset($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (isset($product)): ?>
    <h1><?= $product->name; ?></h1>

    <ul>
        <li>Description <?= $product->description; ?></li>
        <li>Prijs: €<?= $product->price; ?></li>
    </ul>
<?php endif; ?>

<div>
    <a href="<?= BASE_PATH; ?>productlist">Ga terug naar lijst</a>
</div>