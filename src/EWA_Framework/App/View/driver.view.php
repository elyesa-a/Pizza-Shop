<?php
// views/ordersView.php
require_once __DIR__ . '/partials/header.php';
?>

<form action="https://echo.hofmann-thomas.de" method="post">
    <section>
        <h2>Auszuliefernde Bestellungen</h2>

        <?php foreach ($orders as $order): ?>
            <article>
                <h3><?php echo htmlspecialchars($order['name']); ?></h3>
                <p><strong>Adresse:</strong> <?php echo htmlspecialchars($order['adresse']); ?></p>
                <p><strong>Pizzen:</strong> <?php echo htmlspecialchars($order['pizzen']); ?></p>
                <p><strong>Preis:</strong> <?php echo htmlspecialchars($order['preis']); ?></p>

                <p>
                    <label for="status<?php echo $order['id']; ?>">Lieferstatus:</label>
                    <select id="status<?php echo $order['id']; ?>" name="status[]">
                        <option value="fertig">fertig</option>
                        <option value="unterwegs">unterwegs</option>
                        <option value="geliefert">geliefert</option>
                    </select>
                </p>

                <input type="hidden" name="bestellung[]" value="<?php echo htmlspecialchars($order['name']); ?>">
                <input type="hidden" name="adresse[]" value="<?php echo htmlspecialchars($order['adresse']); ?>">
            </article>
        <?php endforeach; ?>

    </section>

    <p>
        <button type="submit">Status absenden</button>
    </p>
</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>