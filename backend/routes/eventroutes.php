<?php
require_once __DIR__ . '/../services/EventService.php';
/**
* @OA\Get(
*     path="/events",
*     tags={"events"},
*     summary="Get all events",
*     @OA\Response(
*         response=200,
*         description="Array of all events"
*     )
* )
*/
Flight::route('GET /events', function() {
    $service = new EventService();
    Flight::json($service->getAllEvents());
});
/**
 * @OA\Get(
 *     path="/events/{id}",
 *     tags={"events"},
 *     summary="Get event by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the event with the given ID"
 *     )
 * )
 */
Flight::route('GET /events/@id', function($id) {
    $service = new EventService();
    Flight::json($service->getEventById($id));
});
/**
 * @OA\Post(
 *     path="/events",
 *     tags={"events"},
 *     summary="Create a new event",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "start_time", "venue_id"},
 *             @OA\Property(property="title", type="string", example="Annual Tech Meetup"),
 *             @OA\Property(property="description", type="string", example="A gathering for tech enthusiasts."),
 *             @OA\Property(property="start_time", type="string", format="date-time", example="2025-06-01T18:00:00"),
 *             @OA\Property(property="end_time", type="string", format="date-time", example="2025-06-01T21:00:00"),
 *             @OA\Property(property="venue_id", type="integer", example=2),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="image", type="string", example="event.jpg"),
 *             @OA\Property(property="category_id", type="integer", example=3)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New event created"
 *     )
 * )
 */
Flight::route('POST /events', function() {
    $data = Flight::request()->data->getData();
    $service = new EventService();
    Flight::json($service->createEvent($data));
});
/**
 * @OA\Put(
 *     path="/events/{id}",
 *     tags={"events"},
 *     summary="Update an existing event",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated Tech Meetup"),
 *             @OA\Property(property="description", type="string", example="Updated event description"),
 *             @OA\Property(property="start_time", type="string", format="date-time", example="2025-06-01T19:00:00"),
 *             @OA\Property(property="end_time", type="string", format="date-time", example="2025-06-01T22:00:00"),
 *             @OA\Property(property="venue_id", type="integer", example=2),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="image", type="string", example="updated_event.jpg"),
 *             @OA\Property(property="category_id", type="integer", example=3)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event updated"
 *     )
 * )
 */
Flight::route('PUT /events/@id', function ($id) {
    $data = Flight::request()->data->getData();
    $service = new EventService();
    Flight::json($service->updateEvent($id, $data));
});
/**
 * @OA\Delete(
 *     path="/events/{id}",
 *     tags={"events"},
 *     summary="Delete an event by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event deleted"
 *     )
 * )
 */
Flight::route('DELETE /events/@id', function($id) {
    $service = new EventService();
    Flight::json($service->deleteEvent($id));
});