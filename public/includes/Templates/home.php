<h1>Mannus Foods</h1>
<?php if (isset($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<nav>
    <ul>
        <a href="<?= BASE_PATH; ?>productList">Producten</a>
    </ul>
</nav>
<p>Hallo op Mannus foods. Hier kunt u de menu kaart bekijken en éen reservering plaatsen. Druk op de producten knop om de kaart te bekijken.</p>