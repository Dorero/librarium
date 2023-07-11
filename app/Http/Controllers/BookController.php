<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Http\Request;


/**
 * @group Book
 *
 * APIs for book entity
 * 
 */
class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display books collection.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Get(
     *     path="/api/books",
     *     operationId="displayBooks",
     *     tags={"Book"},
     *     summary="Return books collection",
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
     *         description="Return books collection successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(@OA\Schema(ref="#/schemas/Book")), example={{
     *                  "id": "3",
     *                  "title": "fugiat",
     *                  "description": "Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi.",
     *                  "price": "2300.00",
     *                  "created_at": "2023-07-11T15:26:43.000000Z",
     *                  "updated_at": "2023-07-11T15:26:43.000000Z",
     *                },})       
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
        return $this->bookRepository->all($request->input('limit'));

    }

    /**
     * Store book.
     * 
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *     path="/api/books",
     *     operationId="createBook",
     *     tags={"Book"},
     *     summary="Create a new book",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="voluptatem"),
     *             @OA\Property(property="description", type="string", example="Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi."),
     *             @OA\Property(property="price", type="string", example="1500.00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Book"), example={
     *                  "id": "3",
     *                  "title": "voluptatem",
     *                  "description": "Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi.",
     *                  "price": "1500.00",
     *                 
     *                })
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function store(StoreBookRequest $request)
    {
        return $this->bookRepository->create($request->validated());
    }

    /**
     * Display book.
     * 
     *     
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Get(
     *     path="/api/books/{id}",
     *     operationId="displayBook",
     *     tags={"Book"},
     *     summary="Show book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Display book successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Book"), example={
     *                  "id": "3",
     *                  "title": "voluptatem",
     *                  "description": "Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi.",
     *                  "price": "1500.00",
     *                })
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function show(Book $book)
    {
        return $this->bookRepository->find($book->id);
    }

    /**
     * Update book.
     *      
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Put(
     *     path="/api/books/{id}",
     *     operationId="updateBook",
     *     tags={"Book"},
     *     summary="Update book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="voluptatem"),
     *             @OA\Property(property="description", type="string", example="Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi."),
     *             @OA\Property(property="price", type="string", example="1500.00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated successfully",
     *         @OA\JsonContent(@OA\Schema(ref="#/schemas/Book"), example={
     *                  "id": "3",
     *                  "title": "voluptatem",
     *                  "description": "Tenetur est error aperiam esse. Vel et quia aut nisi debitis rerum culpa. Tempora dolores totam asperiores accusantium eos ut animi.",
     *                  "price": "1500.00",
     *                 
     *                })
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        return $this->bookRepository->update($book->id, $request->validated());
    }

    /**
     * Remove book.
     *           
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     operationId="deleteBook",
     *     tags={"Book"},
     *     summary="Delete book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the book",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=3
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Delete successfully",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function destroy(Book $book)
    {
        return $this->bookRepository->delete($book->id);
    }
}