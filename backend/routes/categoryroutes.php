<?php
require_once __DIR__ . '/../services/CategoryService.php';
/**
 * @OA\Get(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Get all categories",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all categories"
 *     )
 * )
 */
Flight::route('GET /categories', function() {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new CategoryService();
    Flight::json($service->getAllCategories());
});
/**
 * @OA\Get(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Get category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the category with the given ID"
 *     )
 * )
 */
Flight::route('GET /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new CategoryService();
    Flight::json($service->getCategoryById($id));
});
/**
 * @OA\Post(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Create a new category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Workshop"),
 *             @OA\Property(property="description", type="string", example="Interactive hands-on sessions")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category created"
 *     )
 * )
 */
Flight::route('POST /categories', function() {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $data = Flight::request()->data->getData();
    $service = new CategoryService();
    Flight::json($service->createCategory($data));
});
/**
 * @OA\Put(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Update an existing category",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Workshop"),
 *             @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category updated"
 *     )
 * )
 */
Flight::route('PUT /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $data = Flight::request()->data->getData();
    $service = new CategoryService();
    Flight::json($service->updateCategory($id, $data));
});
/**
 * @OA\Delete(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Delete a category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category deleted"
 *     )
 * )
 */
Flight::route('DELETE /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::USER);
    $location = Flight::request()->query['location'] ?? null;
    $service = new CategoryService();
    Flight::json($service->deleteCategory($id));
});