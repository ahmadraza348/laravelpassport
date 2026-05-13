<?php

namespace App\Services;

use App\Repository\TodoRepository;

class TodoService
{
    public function __construct(
        protected TodoRepository $todoRepository,
        protected AuthService $authService
    ) {}

    public function getAllTodos()
    {
        $authUser = $this->authService->getAuthUser();
        return $this->todoRepository->getAllTodos($authUser);
    }

    public function storeTodo($request)
    {
        $authUser = $this->authService->getAuthUser();
        // Pass only validated data to the repository
        return $this->todoRepository->storeTodo($authUser, $request->validated());
    }

    public function getTodoById($id)
    {
        $authUser = $this->authService->getAuthUser();
        return $this->todoRepository->findById($authUser, $id);
    }

    public function updateTodo($id, $request)
    {
        $todo = $this->getTodoById($id);
        return $this->todoRepository->updateTodo($todo, $request->all());
    }

    public function deleteTodo($id)
    {
        $todo = $this->getTodoById($id);
        return $this->todoRepository->deleteTodo($todo);
    }
}