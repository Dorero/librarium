<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Request;


/**
 * @group Author
 *
 * APIs for author entity
 * 
 */
class AuthorController extends Controller
{

    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Get(
     *     path="/api/authors",
     *     operationId="displayAuthors",
     *     tags={"Author"},
     *     summary="Return authors collection",
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of records to retrieve",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=15
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Return authors collection successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(@OA\Schema(ref="#/schemas/Author")), example={
     *                  "id": "3",
     *                  "firstName": "Bob",
     *                  "lastName": "Fanger",
     *                  "bio": "Est aperiam optio dolor id et earum. Quasi rem nobis quibusdam doloremque illo. Exercitationem explicabo temporibus quibusdam ut.",
     *                 
     *                },)       
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function index(Request $request)
    {
        return $this->authorRepository->all($request->input('limit'));
    }

    /**
     * Store author
     * 
     * @param StoreAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *     path="/api/authors",
     *     operationId="storeAuthor",
     *     tags={"Author"},
     *     summary="Create new author",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string", example="Mike"),
     *             @OA\Property(property="last_name", type="string", example="Fireman"),
     *             @OA\Property(property="bio", type="string", example="Est aperiam optio dolor id et earum..."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Author"), example={
     *                  "id": "3",
     *                  "firstName": "Bob",
     *                  "lastName": "Fanger",
     *                  "bio": "Est aperiam optio dolor id et earum. Quasi rem nobis quibusdam doloremque illo. Exercitationem explicabo temporibus quibusdam ut.",
     *                 
     *                })
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function store(StoreAuthorRequest $request)
    {

        return $this->authorRepository->create($request->validated());
    }

    /**
     * Display author
     * 
     * 
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Get(
     *     path="/api/authors/{id}",
     *     operationId="showAuthor",
     *     tags={"Author"},
     *     summary="Show author",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the author",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Return author successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Author"), example={
     *                  "id": "3",
     *                  "firstName": "Bob",
     *                  "lastName": "Fanger",
     *                  "bio": "Est aperiam optio dolor id et earum. Quasi rem nobis quibusdam doloremque illo. Exercitationem explicabo temporibus quibusdam ut.",
     *                 
     *                })
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function show(Author $author)
    {
        return $this->authorRepository->find($author->id);
    }

    /**
     * Update the specified resource in storage.
     * 
     * 
     * @param UpdateAuthorRequest $request
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Put(
     *     path="/api/authors/{id}",
     *     operationId="updateAuthor",
     *     tags={"Author"},
     *     summary="Update author",
     *     @OA\Parameter(
     *         parameter="update",
     *         name="id",
     *         in="path",
     *         description="ID of the author",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\RequestBody(
     *         request="update",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string", example="Mike"),
     *             @OA\Property(property="last_name", type="string", example="Fireman"),
     *             @OA\Property(property="bio", type="string", example="Est aperiam optio dolor id et earum..."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Author"), example={
     *                  "id": "3",
     *                  "firstName": "Bob",
     *                  "lastName": "Fanger",
     *                  "bio": "Est aperiam optio dolor id et earum. Quasi rem nobis quibusdam doloremque illo. Exercitationem explicabo temporibus quibusdam ut.",
     *                 
     *                }),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        return $this->authorRepository->update($author->id, $request->validated());
    }

    /**
     * Remove author.
     * 
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Delete(
     *     path="/api/authors/{id}",
     *     operationId="deleteAuthor",
     *     tags={"Author"},
     *     summary="Delete author",
     *     @OA\Parameter(
     *         parameter="delete",
     *         name="id",
     *         in="path",
     *         description="ID of the author",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function destroy(Author $author)
    {
        return $this->authorRepository->delete($author->id);
    }
}