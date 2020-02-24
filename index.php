<?php
$countries = [
    'belgique' =>
        [
            'capital' => 'bruxelles',
            'flag' => 'images/belgium-flag-icon-256.png',
        ],
    'allemagne' =>
        [
            'capital' => 'berlin',
            'flag' => 'images/germany-flag-icon-256.png',
        ],
    'corée du nord' =>
        [
            'capital' => 'pyongyang',
            'flag' => 'images/north-korea-flag-icon-256.png',
        ],
    'afrique du sud' =>
        [
            'capital' => 'johannesbourg',
            'flag' => 'images/south-africa-flag-icon-256.png',
        ]
];

$requestedCountry = '';
$countryInfos = [];
$errors = [];

if (isset($_GET['country'])) {
    $requestedCountry = urldecode($_GET['country']);
    if (array_key_exists($requestedCountry, $countries)) {
        $countryInfos = $countries[$requestedCountry];
    } else {
        $errors['inexistent-country'] = 'Ce pays ne fait pas partie de nos listes. 🥺';
    }

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
                <?php foreach ($countries as $countryName => $infos): ?>
                    <option value="<?= urlencode($countryName) ?>" <?= $requestedCountry === $countryName ? 'selected' : '' ?>><?= mb_strtoupper($countryName) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2">Donne moi sa capitale</button>
        </div>
    </form>
    <?php if ($countryInfos): ?>
        <section class="media">
            <img src="<?= $countryInfos['flag'] ?>" class="mr-3" alt="Drapeau de <?= ucwords($requestedCountry) ?>">
            <div class="media-body">
                <h2><?= ucwords($requestedCountry) ?></h2>
                <p>Sa capitale est <?= ucwords($countryInfos['capital']) ?></p>
            </div>
        </section>
    <?php endif; ?>
    <?php if (isset($errors['inexistent-country'])): ?>
        <section class="alert alert-danger" role="alert">
            <h2 class="text-center mb-4">⚠️ Attention&nbsp;! ⚠️</h2>
            <p><?= $errors['inexistent-country'] ?></p>
            <p>Merci d’en choisir un à l’aide du menu de sélection ci-dessus ☝🏼</p>
        </section>
    <?php endif; ?>
</main>
</body>
</html>
