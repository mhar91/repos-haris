<?php
header("Location: /frontend/index.html");
exit();

require 'vendor/autoload.php';

require_once __DIR__ . '/config/Config.php';

require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/EventService.php';
require_once __DIR__ . '/services/VenueService.php';
require_once __DIR__ . '/services/CategoryService.php';
require_once __DIR__ . '/services/RegistrationService.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::register('authService', 'AuthService');
Flight::register('userService', 'UserService');
Flight::register('eventService', 'EventService');
Flight::register('venueService', 'VenueService');
Flight::register('categoryService', 'CategoryService');
Flight::register('registrationService', 'RegistrationService');
Flight::register('authMiddleware', 'AuthMiddleWare');

Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(Flight::auth_middleware()->verifyToken($token))
               return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});


require_once __DIR__ . '/routes/AuthRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/EventRoutes.php';
require_once __DIR__ . '/routes/VenueRoutes.php';
require_once __DIR__ . '/routes/CategoryRoutes.php';
require_once __DIR__ . '/routes/RegistrationRoutes.php';

Flight::start();
