<?php
require_once __DIR__ . '/../services/venueservice.php';
/**
 * @OA\Get(
 *     path="/venues",
 *     tags={"venues"},
 *     summary="Get all venues",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all venues"
 *     )
 * )
 */
Flight::route('GET /venues', function() {
    $service = new VenueService();
    Flight::json($service->getAllVenues());
});
/**
 * @OA\Get(
 *     path="/venues/{id}",
 *     tags={"venues"},
 *     summary="Get venue by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Venue ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the venue with the given ID"
 *     )
 * )
 */
Flight::route('GET /venues/@id', function($id) {
    $service = new VenueService();
    Flight::json($service->getVenueById($id));
});

/**
 * @OA\Post(
 *     path="/venues",
 *     tags={"venues"},
 *     summary="Create a new venue",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "location"},
 *             @OA\Property(property="name", type="string", example="City Hall"),
 *             @OA\Property(property="location", type="string", example="Downtown"),
 *             @OA\Property(property="capacity", type="integer", example=300)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Venue created"
 *     )
 * )
 */
Flight::route('POST /venues', function() {
    $data = Flight::request()->data->getData();
    $service = new VenueService();
    Flight::json($service->createVenue($data));
});
/**
 * @OA\Put(
 *     path="/venues/{id}",
 *     tags={"venues"},
 *     summary="Update a venue",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Venue ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Hall"),
 *             @OA\Property(property="location", type="string", example="New Downtown"),
 *             @OA\Property(property="capacity", type="integer", example=500)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Venue updated"
 *     )
 * )
 */
Flight::route('PUT /venues/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new VenueService();
    Flight::json($service->updateVenue($id, $data));
});
/**
 * @OA\Delete(
 *     path="/venues/{id}",
 *     tags={"venues"},
 *     summary="Delete a venue by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Venue ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Venue deleted"
 *     )
 * )
 */
Flight::route('DELETE /venues/@id', function($id) {
    $service = new VenueService();
    Flight::json($service->deleteVenue($id));
});