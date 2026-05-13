<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Helper\ApiResponse;
use App\Http\Requests\StoreTodoRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function __construct(protected TodoService $todoService) {}

    public function index()
    {
        try {
            $todos = $this->todoService->getAllTodos();
            return ApiResponse::success(self::SUCCESS_MESSAGE, $todos);
        } catch (Exception $e) {
            Log::error('Error Fetching Todos: ' . $e->getMessage());
            return ApiResponse::error(self::EXCEPTION_MESSAGE, [], 500);
        }
    }

    public function store(StoreTodoRequest $request)
    {
        try {
            $todo = $this->todoService->storeTodo($request);
            return ApiResponse::success(self::SUCCESS_MESSAGE, $todo, 201);
        } catch (Exception $e) {
            Log::error('Error Storing Todo: ' . $e->getMessage());
            return ApiResponse::error(self::EXCEPTION_MESSAGE, [], 500);
        }
    }

    public function show($id)
    {
        try {
            $todo = $this->todoService->getTodoById($id);
            return ApiResponse::success(self::SUCCESS_MESSAGE, $todo);
        } catch (Exception $e) {
            return ApiResponse::error('Todo not found', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $todo = $this->todoService->updateTodo($id, $request);
            return ApiResponse::success('Todo updated successfully', $todo);
        } catch (Exception $e) {
            return ApiResponse::error('Update failed: ' . $e->getMessage(), [], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->todoService->deleteTodo($id);
            return ApiResponse::success('Todo deleted successfully');
        } catch (Exception $e) {
            return ApiResponse::error('Deletion failed', [], 400);
        }
    }
}