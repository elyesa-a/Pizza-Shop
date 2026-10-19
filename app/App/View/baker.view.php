<?php
$pageScripts = ['assets/js/script.js'];
require_once __DIR__ . '/partials/header.php';
?>

<form action="<?= htmlspecialchars(Router::generateUrl('baker')) ?>" method="post"> <!-- Hier wird das Formular an die Route "baker" gesendet, die in der Router-Klasse definiert ist, Pfade werden zentral über den Router erzeugt, nicht hardkodiert -->

    <section>
        <h2>Bestellte Pizzen</h2>

        <?php foreach ($data['pizzas'] as $pizza): ?>
            <article>
                <h3>
                    Bestellung #<?= htmlspecialchars((string)$pizza['ordering_id']) ?> —
                    <?= htmlspecialchars($pizza['name']) ?>
                </h3>

                <input
                    type="radio"
                    class="auto-submit"
                    id="pizza-<?= $pizza['ordered_article_id'] ?>-bestellt"
                    name="status[<?= $pizza['ordered_article_id'] ?>]"
                    value="0"
                    <?= ((int)$pizza['status'] === 0) ? 'checked' : '' ?>
                >
                <label for="pizza-<?= $pizza['ordered_article_id'] ?>-bestellt"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> bestellt</label>

                <input
                    type="radio"
                    class="auto-submit"
                    id="pizza-<?= $pizza['ordered_article_id'] ?>-ofen"
                    name="status[<?= $pizza['ordered_article_id'] ?>]"
                    value="1"
                    <?= ((int)$pizza['status'] === 1) ? 'checked' : '' ?>
                >
                <label for="pizza-<?= $pizza['ordered_article_id'] ?>-ofen"><i class="fa-solid fa-fire" aria-hidden="true"></i> im Ofen</label>

                <input
                    type="radio"
                    class="auto-submit"
                    id="pizza-<?= $pizza['ordered_article_id'] ?>-fertig"
                    name="status[<?= $pizza['ordered_article_id'] ?>]"
                    value="2"
                    <?= ((int)$pizza['status'] === 2) ? 'checked' : '' ?>
                >
                <label for="pizza-<?= $pizza['ordered_article_id'] ?>-fertig"><i class="fa-solid fa-check" aria-hidden="true"></i> fertig</label>
            </article>
        <?php endforeach; ?>

    </section>

</form>

<?php
require_once __DIR__ . '/partials/footer.php';
