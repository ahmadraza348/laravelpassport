<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Helper\ApiResponse;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{

    public function __construct(protected TodoService $todoService) {}



    public function index()
    {
        try {
            $todos = $this->todoService->getAllTodos();
              return ApiResponse::success(
                self::SUCCESS_MESSAGE,
                $todos,
                201
            );

        } catch (Exception $e) {
            Log::error('Error on Fetching Todos: ' . $e->getMessage());
            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
         try {
            $this->todoService->storeTodo($request);
              return ApiResponse::success(
                self::SUCCESS_MESSAGE,
                201
            );

        } catch (Exception $e) {
            Log::error('Error on Storing Todos: ' . $e->getMessage());
            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(todo $todo)
    {
        //
    }
}
