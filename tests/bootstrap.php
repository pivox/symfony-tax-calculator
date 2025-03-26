<?php

use Symfony\Component\Dotenv\Dotenv;

// Charge l'autoloader de Composer
require dirname(__DIR__) . '/vendor/autoload.php';

// Chemin vers le fichier .env (ajuste si besoin)
$envFile = dirname(__DIR__) . '/.env';

// Charge les variables d’environnement via Symfony Dotenv
if (file_exists($envFile)) {
    (new Dotenv())
        ->usePutenv(true)        // autorise getenv() / putenv()
        ->loadEnv($envFile);

    // Assure que $_ENV et $_SERVER contiennent bien les variables attendues
    if (!isset($_ENV['DATABASE_URL'])) {
        $_ENV['DATABASE_URL'] = getenv('DATABASE_URL');
    }

    if (!isset($_SERVER['DATABASE_URL'])) {
        $_SERVER['DATABASE_URL'] = getenv('DATABASE_URL');
    }
}

echo "✅ tests/bootstrap.php loaded\n";
