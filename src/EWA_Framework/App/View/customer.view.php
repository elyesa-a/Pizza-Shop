<?php
require_once __DIR__ . '/partials/header.php';
?>

<form action="https://echo.hofmann-thomas.de" method="post">
    <section>
        <h2>Aktueller Bestellstatus</h2>

        <article>
            <h3>Bestellung 1</h3>
            <p><strong>Pizzen:</strong> Salami, Margherita</p>
            <p><strong>Status:</strong> im Ofen</p>

            <input type="hidden" name="bestellung[]" value="Bestellung 1">
            <input type="hidden" name="pizza[]" value="Salami, Margherita">
            <input type="hidden" name="status[]" value="im Ofen">
        </article>

        <article>
            <h3>Bestellung 2</h3>
            <p><strong>Pizzen:</strong> Tonno</p>
            <p><strong>Status:</strong> unterwegs</p>

            <input type="hidden" name="bestellung[]" value="Bestellung 2">
            <input type="hidden" name="pizza[]" value="Tonno">
            <input type="hidden" name="status[]" value="unterwegs">
        </article>
    </section>

    <p>
        <button type="submit" name="aktualisieren" value="1">Status aktualisieren</button>
    </p>
</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>