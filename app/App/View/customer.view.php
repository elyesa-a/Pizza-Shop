<?php
$pageScripts = ['assets/js/customer.js'];
require_once __DIR__ . '/partials/header.php';
?>
<section>
    <h2>Aktueller Bestellstatus</h2>
    <div id="order-status">
<?php if (empty($data['pizzas'])): ?>
        <p>Keine Bestellungen gefunden.</p>
    <?php else: ?>
        <article>

            <h3>
                Bestellung #<?= htmlspecialchars((string)$data['pizzas'][0]['ordering_id']) ?>
            </h3>

            <p>
                <strong>Adresse:</strong>
                <?= htmlspecialchars($data['pizzas'][0]['address']) ?>
            </p>
            <h4>Pizzen:</h4>
            <ul>
                <?php foreach ($data['pizzas'] as $pizza): ?>
                    <li>
                    <strong>Pizza: <?= htmlspecialchars($pizza['name']) ?></strong>
                    
                - Status:

                <?php
                switch ($pizza['status']) {
                    case 0: echo '<i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> bestellt'; break;
                    case 1: echo '<i class="fa-solid fa-fire" aria-hidden="true"></i> im Ofen'; break;
                    case 2: echo '<i class="fa-solid fa-check" aria-hidden="true"></i> fertig'; break;
                    case 3: echo '<i class="fa-solid fa-truck-fast" aria-hidden="true"></i> unterwegs'; break;
                }
                ?>
            </li>
            <?php endforeach; ?>
            </ul>
            </article>
    <?php endif; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/partials/footer.php';
?>