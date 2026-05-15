<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponse;
use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Services\TodoService;
use Exception;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function __construct(
        protected TodoService $todoService
    ) {}

    public function index()
    {
        try {
            $todos = $this->todoService->getAllTodos();

            return ApiResponse::success(
                'Todos fetched successfully',
                $todos
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }

    public function store(StoreTodoRequest $request)
    {
        try {
            $todo = $this->todoService->storeTodo($request->validated());

            return ApiResponse::success(
                'Todo created successfully',
                $todo,
                201
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }

    public function show(Todo $todo)
    {
        try {
            if ($todo->user_id !== $this->todoService->getCurrentUserId()) {
                return ApiResponse::error(
                    'Unauthorized',
                    [],
                    403
                );
            }

            return ApiResponse::success(
                'Todo fetched successfully',
                $todo
            );
        } catch (Exception $e) {
            return ApiResponse::error(
                'Todo not found',
                [],
                404
            );
        }
    }

    public function update(StoreTodoRequest $request, Todo $todo)
    {
        try {
            if ($todo->user_id !== $this->todoService->getCurrentUserId()) {
                return ApiResponse::error(
                    'Unauthorized',
                    [],
                    403
                );
            }

            $updatedTodo = $this->todoService->updateTodo(
                $todo,
                $request->validated()
            );

            return ApiResponse::success(
                'Todo updated successfully',
                $updatedTodo
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                400
            );
        }
    }

    public function destroy(Todo $todo)
    {
        try {
            if ($todo->user_id !== auth()->id()) {
                return ApiResponse::error(
                    'Unauthorized',
                    [],
                    403
                );
            }

            $this->todoService->deleteTodo($todo);

            return ApiResponse::success(
                'Todo deleted successfully'
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                400
            );
        }
    }
}