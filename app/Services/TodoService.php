<?php

namespace App\Services;

use App\Models\Todo;
use App\Repository\TodoRepository;

class TodoService
{
    public function __construct(
        protected TodoRepository $todoRepository,
        protected AuthService $authService
    ) {}

    private function user()
    {
        return $this->authService->getAuthUser();
    }

    public function getCurrentUserId()
    {
        $user = $this->user();
        return $user ? $user->id : null;
    }

    public function getAllTodos()
    {
        return $this->todoRepository->getAllTodos(
            $this->user()
        );
    }

    public function storeTodo(array $data)
    {
        return $this->todoRepository->storeTodo(
            $this->user(),
            $data
        );
    }

    public function updateTodo(Todo $todo, array $data)
    {
        return $this->todoRepository->updateTodo(
            $todo,
            $data
        );
    }

    public function deleteTodo(Todo $todo)
    {
        return $this->todoRepository->deleteTodo($todo);
    }
}