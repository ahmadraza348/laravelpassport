<?php

namespace App\Services;
use App\Repository\TodoRepository;
use App\Services\AuthService;

class TodoService
{

public function __Construct(
    protected TodoRepository $todoRepository,
    protected AuthService $authService
){}

public function getAllTodos()
{
    $authUser = $this->authService->getAuthUser();
    return $this->todoRepository->getAllTodos($authUser);
}  

public function storeTodo($todoRequest)
{
    $authUser = $this->authService->getAuthUser();
    return $this->todoRepository->storeTodo($authUser, $todoRequest);

}
}