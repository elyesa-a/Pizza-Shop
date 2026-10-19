document.addEventListener("DOMContentLoaded", () => {
    requestData();
    setInterval(requestData, 2000); // dann alle 2 Sekunden
});
async function requestData() { // Funktion, die die Daten vom Server anfordert
    try {
        const response = await fetch("api"); // Hier wird die URL "api" aufgerufen, um die Daten vom Server zu erhalten

        if (!response.ok) {
            throw new Error(`Fehler: ${response.status}`); // Wenn die Antwort nicht erfolgreich ist, wird ein Fehler ausgelöst
        }

        const data = await response.json(); // Die Antwort wird als JSON geparst und in der Variable "data" gespeichert
       
        process(data); // Die Funktion "process" wird aufgerufen, um die erhaltenen Daten zu verarbeiten und anzuzeigen
    } catch (error) {
        console.error("Übertragung fehlgeschlagen:", error); // Wenn ein Fehler auftritt, wird dieser in der Konsole ausgegeben
    }
}
function process(data) { // Funktion, die die erhaltenen Daten verarbeitet und anzeigt
    const container = document.getElementById("order-status"); // Hier wird das HTML-Element mit der ID "order-status" ausgewählt, in dem die Bestellinformationen angezeigt werden sollen
    const orders = data.orders; // Die Bestellungen werden aus den erhaltenen Daten extrahiert

    if (!orders || orders.length === 0) { // Wenn keine Bestellungen vorhanden sind, wird eine entsprechende Nachricht angezeigt
        container.innerHTML = "<p>Keine Bestellungen gefunden.</p>";
        return;
    }

    const statusText = { // Ein Objekt, das die Statuscodes den entsprechenden Texten zuordnet
        0: "bestellt",
        1: "im Ofen",
        2: "fertig",
        3: "unterwegs"
    };

    let html = ""; // Hier wird der HTML-Code für die Anzeige der Bestellinformationen erstellt
    html += `<h3>Bestellung #${orders[0].ordering_id}</h3>`; // Die Bestellnummer wird angezeigt
    html += `<p><strong>Adresse:</strong> ${orders[0].address}</p>`; // Die Adresse der Bestellung wird angezeigt
    html += `<h4>Pizzen:</h4><ul>`; // Eine Liste der Pizzen in der Bestellung wird erstellt

    orders.forEach((pizza) => { // Für jede Pizza in der Bestellung wird ein Listeneintrag erstellt, der den Namen und den Status der Pizza anzeigt
        html += `<li><strong>Pizza: ${pizza.name}</strong> – Status: ${statusText[pizza.status]}</li>`; // Der Status der Pizza wird anhand des statusText-Objekts angezeigt
    });

    html += `</ul>`; // Die Liste der Pizzen wird abgeschlossen

    container.innerHTML = html; // Der erstellte HTML-Code wird in das ausgewählte HTML-Element eingefügt, um die Bestellinformationen anzuzeigen
}