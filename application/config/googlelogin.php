<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
| Google OAuth2 settings read from environment variables (via Dotenv)
| We prefer $_ENV first, then getenv() as fallback.
*/

$google_client_id     = $_ENV['GOOGLE_CLIENT_ID'] ?? getenv('GOOGLE_CLIENT_ID');
$google_client_secret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? getenv('GOOGLE_CLIENT_SECRET');
$google_redirect_uri  = $_ENV['GOOGLE_REDIRECT_URI'] ?? getenv('GOOGLE_REDIRECT_URI');

if (!$google_client_id || !$google_client_secret || !$google_redirect_uri) {
    // Opcional: lanzar warning en logs si falta algo
    // log_message('error', 'Google login config incomplete. Check .env variables.');
}

$config['google_client_id']     = $google_client_id;
$config['google_client_secret'] = $google_client_secret;
$config['google_redirect_uri']  = $google_redirect_uri;

// Scopes por defecto
$config['google_scopes'] = [
    'openid',
    'profile',
    'email',
];
