<?php
// App/View/baker.view.php
require_once __DIR__ . '/partials/header.php';
?>

<form action="https://echo.hofmann-thomas.de" method="post">

    <section>
        <h3>Bestellte Pizzen</h3>

        <?php foreach ($data as $pizza): ?>
            <article>
                <h4><?php echo htmlspecialchars($pizza['name']); ?></h4>

                <input type="radio" 
                       id="<?php echo $pizza['id']; ?>_bestellt" 
                       name="<?php echo $pizza['id']; ?>_status" 
                       value="bestellt" 
                       <?php echo ($pizza['status'] === 'bestellt') ? 'checked' : ''; ?>>
                <label for="<?php echo $pizza['id']; ?>_bestellt">bestellt</label>

                <input type="radio" 
                       id="<?php echo $pizza['id']; ?>_ofen" 
                       name="<?php echo $pizza['id']; ?>_status" 
                       value="im Ofen" 
                       <?php echo ($pizza['status'] === 'im Ofen') ? 'checked' : ''; ?>>
                <label for="<?php echo $pizza['id']; ?>_ofen">im Ofen</label>

                <input type="radio" 
                       id="<?php echo $pizza['id']; ?>_fertig" 
                       name="<?php echo $pizza['id']; ?>_status" 
                       value="fertig" 
                       <?php echo ($pizza['status'] === 'fertig') ? 'checked' : ''; ?>>
                <label for="<?php echo $pizza['id']; ?>_fertig">fertig</label>
            </article>
        <?php endforeach; ?>
        
    </section>

    <p>
        <button type="submit">Status aktualisieren</button>
    </p>

</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>