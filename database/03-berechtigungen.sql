-- Der Anwendungsnutzer darf nur auf die Pizzaservice-Datenbank zugreifen
GRANT SELECT, INSERT, UPDATE, DELETE ON pizzaservice.* TO 'public'@'%';
