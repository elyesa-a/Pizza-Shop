document.addEventListener("DOMContentLoaded", () => { // DOMContentLoaded-Eventlistener, um sicherzustellen, dass das Skript erst ausgeführt wird, wenn das DOM vollständig geladen ist
    const pizzaImages = document.querySelectorAll(".pizza-image");
    const cart = document.getElementById("cart");
    const address = document.getElementById("adresse");
    const removeSelected = document.getElementById("remove-selected");
    const clearCart = document.getElementById("clear-cart");

    // Pizza per Bildklick in den Warenkorb legen
    pizzaImages.forEach((image) => {
        image.addEventListener("click", () => {
            const option = document.createElement("option");
            option.value = image.dataset.articleId;
            option.dataset.price = image.dataset.price;
            option.textContent = `${image.dataset.name} – ${Number(image.dataset.price).toFixed(2)} €`;
            cart.appendChild(option);

            updateTotalPrice();
            checkOrder();
        });
    });

    // Button 1: nur die markierten Einträge löschen
    if (removeSelected) {
        removeSelected.addEventListener("click", () => {
            Array.from(cart.selectedOptions).forEach((option) => option.remove());
            updateTotalPrice();
            checkOrder();
        });
    }

    // Button 2: den ganzen Warenkorb leeren
    if (clearCart) {
        clearCart.addEventListener("click", () => {
            cart.innerHTML = "";
            updateTotalPrice();
            checkOrder();
        });
    }

    // Adresseingabe -> Bestellknopf prüfen
    if (address) {
        address.addEventListener("input", checkOrder);
    }
    // Punkt 6: vor dem Abschicken ALLE Optionen selektieren,
    // damit der gesamte Warenkorb übertragen wird (nicht nur markierte)
    const form = document.getElementById("order-form");
    if (form) {
        form.addEventListener("submit", () => {
            for (const option of cart.options) {
                option.selected = true;
            }
        });
    }
    // Auto-Submit für Bäcker-/Fahrerseite (unverändert)
    const autoSubmits = document.querySelectorAll(".auto-submit");
    autoSubmits.forEach((element) => {
        element.addEventListener("change", () => {
            element.form.submit();
        });
    });

    updateTotalPrice();
    checkOrder();
});

function updateTotalPrice() {
    const cart = document.getElementById("cart");
    const totalPriceElement = document.getElementById("total-price");

    if (!cart) {
        return;
    }

    let total = 0;
    for (const option of cart.options) {
        total += Number(option.dataset.price);
    }

    if (totalPriceElement) {
        totalPriceElement.textContent = total.toFixed(2);
    }
}

function checkOrder() {
    const address = document.getElementById("adresse");
    const button = document.getElementById("submit-order");
    const cart = document.getElementById("cart");

    if (!address || !button || !cart) {
        return;
    }

    button.disabled = address.value.trim() === "" || cart.options.length === 0;
}