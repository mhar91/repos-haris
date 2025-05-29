<?php
require_once __DIR__ . '/../services/RegistrationService.php';/**
* @OA\Get(
*     path="/registrations",
*     tags={"registrations"},
*     summary="Get all registrations",
*     @OA\Response(
*         response=200,
*         description="Array of all registrations"
*     )
* )
*/
Flight::route('GET /registrations', function() {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new RegistrationService();
    Flight::json($service->getAllRegistrations());
});
/**
 * @OA\Get(
 *     path="/registrations/{id}",
 *     tags={"registrations"},
 *     summary="Get registration by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Registration ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the registration with the given ID"
 *     )
 * )
 */
Flight::route('GET /registrations/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new RegistrationService();
    Flight::json($service->getRegistrationById($id));
});
/**
 * @OA\Post(
 *     path="/registrations",
 *     tags={"registrations"},
 *     summary="Create a new registration",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "event_id"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="event_id", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New registration created"
 *     )
 * )
 */
Flight::route('POST /registrations', function() {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $data = Flight::request()->data->getData();
    $service = new RegistrationService();
    Flight::json($service->createRegistration($data));
});
/**
 * @OA\Put(
 *     path="/registrations/{id}",
 *     tags={"registrations"},
 *     summary="Update an existing registration",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Registration ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="event_id", type="integer", example=10)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registration updated"
 *     )
 * )
 */
Flight::route('PUT /registrations/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $data = Flight::request()->data->getData();
    $service = new RegistrationService();
    Flight::json($service->updateRegistration($id, $data));
});
/**
 * @OA\Delete(
 *     path="/registrations/{id}",
 *     tags={"registrations"},
 *     summary="Delete a registration by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Registration ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registration deleted"
 *     )
 * )
 */
Flight::route('DELETE /registrations/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new RegistrationService();
    Flight::json($service->deleteRegistration($id));
});