<?php if (!empty($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($success !== false) { ?>
    <p class="success"><?= $success; ?></p>
<?php } ?>

<?php if ($product !== false): ?>
    <h1>Edit "<?= $product->name; ?>"</h1>
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <label for="name">Naam</label>
            <input id="name" type="text" name="name" value="<?= htmlentities($product->name); ?>"/>
        </div>
        <div class="data-field">
            <label for="description">description</label>
            <input id="description" type="text" name="description" value="
            <?= htmlentities($product->description); ?>"/>
        </div>
        <div class="data-field">
            <label for="price">Prijs</label>
            <input id="price" type="text" name="price" value="<?= htmlentities($product->price); ?>"/>
        </div>
<!--        <div class="data-field">-->
<!--            <label for="image">Image</label>-->
<!--            <input type="file" name="image" id="image"/>-->
<!--        </div>-->
        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>
<?php endif; ?>
<div>
    <a href="<?= BASE_PATH; ?>productlist">Ga terug naar de product lijst</a>
</div>