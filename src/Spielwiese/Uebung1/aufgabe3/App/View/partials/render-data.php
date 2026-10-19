<section>
    <h2>Items</h2>
    <?php foreach ($data as $item): ?>
        <p><?= htmlspecialchars($item['name']) ?></p>
    <?php endforeach; ?>
</section>