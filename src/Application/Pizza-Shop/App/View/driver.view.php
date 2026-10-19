<?php
/** @var array $data */
$pageScripts = ['assets/js/script.js'];
require_once __DIR__ . '/partials/header.php';
?>

<form action="<?= htmlspecialchars(Router::generateUrl('driver')) ?>" method="post">

    <section>
        <h2>Auslieferung</h2>

        <?php if (empty($data['orders'])): ?>
            <p>Aktuell sind keine Bestellungen zur Auslieferung bereit.</p>
        <?php endif; ?>

        <?php foreach ($data['orders'] as $order): ?>
            <article>
                <h3>
                    Bestellung #<?= htmlspecialchars((string)$order['ordering_id']) ?>
                </h3>

                <p>
                    <strong>Lieferadresse:</strong>
                    <?= htmlspecialchars($order['address']) ?>
                </p>

                <p>
                    <strong>Gesamtpreis:</strong>
                    <?= htmlspecialchars(number_format((float)$order['total_price'], 2, ',', '.')) ?> €
                </p>

                <input
                    type="radio"
                    class="auto-submit"
                    id="order-<?= $order['ordering_id'] ?>-fertig"
                    name="status[<?= $order['ordering_id'] ?>]"
                    value="2"
                    <?= ((int)$order['status'] === 2) ? 'checked' : '' ?>
                >
                <label for="order-<?= $order['ordering_id'] ?>-fertig"><i class="fa-solid fa-check" aria-hidden="true"></i> fertig</label>

                <input
                    type="radio"
                    class="auto-submit"
                    id="order-<?= $order['ordering_id'] ?>-unterwegs"
                    name="status[<?= $order['ordering_id'] ?>]"
                    value="3"
                    <?= ((int)$order['status'] === 3) ? 'checked' : '' ?>
                >
                <label for="order-<?= $order['ordering_id'] ?>-unterwegs"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i> unterwegs</label>

                <input
                    type="radio"
                    class="auto-submit"
                    id="order-<?= $order['ordering_id'] ?>-geliefert"
                    name="status[<?= $order['ordering_id'] ?>]"
                    value="4"
                >
                <label for="order-<?= $order['ordering_id'] ?>-geliefert"><i class="fa-solid fa-box-archive" aria-hidden="true"></i> ausgeliefert/löschen</label>
            </article>
        <?php endforeach; ?>

    </section>
</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>
