<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - Pizzaservice' : 'Pizzaservice'; ?></title>

<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/variables.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/fonts.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/base.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/navigation.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/layout.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/buttons.css')) ?>">
<link rel="stylesheet" href="<?= htmlspecialchars(Router::generateUrl('assets/css/responsive.css')) ?>">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> <!-- Font Awesome für Icons -->
    <?php if (!empty($pageScripts)): ?> <!-- Dies sorgt dafür, dass jede Seite nur das vom JS hochlädt was es auch wirklich benötitgt und nicht jede Seite direkt alles hochlädt -->
        <?php foreach ($pageScripts as $script): ?>
            <script src="<?= htmlspecialchars(Router::generateUrl($script)) ?>" defer></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>

    <header>
        <h1><?php echo htmlspecialchars($pageTitle ?? 'Pizzaservice'); ?></h1>

        <nav class="main-nav">
            <ul>
                <li><a href="<?= htmlspecialchars(Router::generateUrl('order')) ?>"><i class="fa-solid fa-pizza-slice" aria-hidden="true"></i> Bestellung</a></li>
                <li><a href="<?= htmlspecialchars(Router::generateUrl('baker')) ?>"><i class="fa-solid fa-kitchen-set" aria-hidden="true"></i> Bäcker</a></li>
                <li><a href="<?= htmlspecialchars(Router::generateUrl('customer')) ?>"><i class="fa-solid fa-user" aria-hidden="true"></i> Kunde</a></li>
                <li><a href="<?= htmlspecialchars(Router::generateUrl('driver')) ?>"><i class="fa-solid fa-truck" aria-hidden="true"></i> Fahrer</a></li>
            </ul>
        </nav>
    </header>
    <hr>