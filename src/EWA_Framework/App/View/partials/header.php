<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - Pizzaservice' : 'Pizzaservice'; ?></title>
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($pageTitle ?? 'Pizzaservice'); ?></h1>

    <nav>
        <ul>
            <li><a href="order.php">Bestellung</a></li>
            <li><a href="baker.php">Bäcker</a></li>
            <li><a href="customer.php">Kunde</a></li>
            <li><a href="driver.php">Fahrer</a></li>
        </ul>
    </nav>
</header>
<hr> ```
