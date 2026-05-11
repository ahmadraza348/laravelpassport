<?php

namespace App\Repository;
use App\Models\Todo;


class TodoRepository
{
public function getAllTodos($authUser)
{
   return Todo::where('user_id', $authUser->id)->get();
}

public function createTodos($authUser)
{
    return Todo::where('user_id', $authUser)->paginate(10);
}

public function storeTodo($todoRequest)
{
    return Todo::create($todoRequest);
}
}