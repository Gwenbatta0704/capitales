<?php

function validated(): array
{
    $countries = require 'data/countries.php';
    $requestedCountry = urldecode($_GET['country']);
    if (array_key_exists($requestedCountry, $countries)) {
        // For Instance : ['belgium' => ['flag-file'=>'..', 'capital-name'=>'..']]
        return [$requestedCountry => $countries[$requestedCountry]];
    } else {
        return ['error' => 'Ce pays ne fait pas partie de nos listes.'];
    }
}