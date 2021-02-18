<?php
require 'validation.php';
$countries = require 'data/countries.php';
ksort($countries);

$data = [];
$requestedCountryName = '';

if (isset($_GET['country'])) {
    $data = validated();
    $requestedCountryName = array_keys($data)[0];
}


?>
<!-- Template d’affichage -->

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>C’est quoi la capitale ?</title>
</head>
<body>
<main class="container">
    <h1>Choisis un pays, je te donnerai sa capitale</h1>
    <form action="index.php">
        <div class="form-group">
            <label for="countries">Les pays disponibles : </label>
            <select class="form-control" name="country" id="countries">
                <?php foreach ($countries as $countryName => $countryInfos): ?>
                    <option value="<?= urlencode($countryName); ?>"
                        <?= $requestedCountryName === $countryName ? ' selected' : '' ?>
                    ><?= mb_strtoupper($countryName) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2">Donne moi sa capitale</button>
        </div>
    </form>
    <?php if (isset($data['error'])): ?>
        <!-- En cas d’erreur -->
        <section class="alert alert-danger" role="alert">
            <h2 class="text-center mb-4">⚠️ Attention&nbsp;! ⚠️</h2>
            <p>Ce pays ne fait pas partie de nos listes. 🥺</p>
            <p>Merci d’en choisir un à l’aide du menu de sélection ci-dessus ☝🏼</p>
        </section>
    <?php elseif (count($data)): ?>
        <!-- En cas de requête correcte -->
        <section class="media">
            <img src="images/<?= $data[$requestedCountryName]['flag-file'] ?>"
                 class="mr-3"
                 alt="Drapeau de <?= ucwords($requestedCountryName) ?>">
            <div class="media-body">
                <h2><?= ucwords($requestedCountryName) ?></h2>
                <p>Sa capitale est <?= ucwords($data[$requestedCountryName]['capital-name']) ?></p>
            </div>
        </section>
    <?php endif; ?>
</main>
</body>
</html>

