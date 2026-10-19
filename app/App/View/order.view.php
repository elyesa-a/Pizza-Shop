<?php
$pageScripts = ['assets/js/script.js'];
require_once __DIR__ . '/partials/header.php';
?>

<form action="<?= htmlspecialchars(Router::generateUrl('order')) ?>" method="post" id="order-form">

    <div class="order-layout">

        <section class="menu-section">
            <h2>Speisekarte</h2>

            <div class="pizza-grid">
                <?php foreach ($data['articles'] as $article): ?>
                    <article class="pizza-card">
                        <h3><?= htmlspecialchars($article['name']) ?></h3> <!-- Hier wird der Name der Pizza angezeigt, wobei htmlspecialchars verwendet wird, um XSS-Angriffe zu verhindern. -->

                        <?php if (!empty($article['picture'])): ?>
                            <img
                                src="<?= htmlspecialchars(Router::generateUrl('assets/images/' . $article['picture'])) ?>"
                                alt="Pizza <?= htmlspecialchars($article['name']) ?>"
                                width="200"
                                height="200"
                                class="pizza-image"
                                data-article-id="<?= htmlspecialchars((string)$article['article_id']) ?>"
                                data-name="<?= htmlspecialchars($article['name']) ?>"
                                data-price="<?= htmlspecialchars((string)$article['price']) ?>"
                            >
                        <?php endif; ?>

                        <p>Preis: <?= htmlspecialchars((string)$article['price']) ?> €</p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <aside class="cart-section">
            <h2><i class="fa-solid fa-cart-shopping" aria-hidden="true"></i> Warenkorb</h2>

            <select multiple id="cart" name="warenkorb[]" size="8"></select>

            <p>
                <strong>Gesamtpreis:</strong>
                <span id="total-price">0.00</span> €
            </p>

            <p class="cart-actions">
                <button type="button" id="remove-selected"><i class="fa-solid fa-trash" aria-hidden="true"></i> Markierte löschen</button>
                <button type="button" id="clear-cart"><i class="fa-solid fa-trash-can" aria-hidden="true"></i> Alle löschen</button>
            </p>

            <p>
                <label for="adresse"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Lieferadresse:</label>
                <br>
                <input type="text" id="adresse" name="adresse" required>
            </p>

            <button type="submit" id="submit-order">
                <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                Bestellung abschicken
            </button>
        </aside>

    </div>

</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>