<?php
require_once __DIR__ . '/partials/header.php';
?>

<form action="https://echo.hofmann-thomas.de" method="post">

    <section>
        <h2>Speisekarte</h2>

        <article>
            <h3>Pizza Margherita</h3>
            <img src="img/margherita.jpg" alt="Pizza Margherita" width="200">
            <p>Preis: 8,85 €</p>
        </article>

        <article>
            <h3>Pizza Salami</h3>
            <img src="img/salami.jpg" alt="Pizza Salami" width="200">
            <p>Preis: 9,85 €</p>
        </article>

        <article>
            <h3>Pizza Prosciutto</h3>
            <img src="img/prosciutto.jpg" alt="Pizza Prosciutto" width="200">
            <p>Preis: 10,35 €</p>
        </article>

    </section>

    <h2>Warenkorb</h2>

    <label for="warenkorb">Ausgewählte Pizzen:</label>
    <br>
    <p>
    <label for="margherita">Pizza Margherita:</label>

    <select id="margherita" name="pizza[margherita]">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</p>

<p>
    <label for="salami">Pizza Salami:</label>

    <select id="salami" name="pizza[salami]">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</p>

<p>
    <label for="prosciutto">Pizza Prosciutto:</label>

    <select id="prosciutto" name="pizza[prosciutto]">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</p>
    <p>
        <label for="adresse">Lieferadresse:</label>
        <br>
        <input type="text" id="adresse" name="adresse" required>
    </p>

    <button type="reset">Alle löschen</button>
    <button type="submit">Bestellung abschicken</button>

</form>

<?php
require_once __DIR__ . '/partials/footer.php';
?>