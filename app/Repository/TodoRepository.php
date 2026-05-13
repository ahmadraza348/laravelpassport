<?php

namespace App\Repository;

use App\Models\Todo;

class TodoRepository
{
    public function getAllTodos($authUser)
    {
        return Todo::where('user_id', $authUser->id)->get();
    }

    public function storeTodo($authUser, array $data)
    {
        // Merge the auth user ID into the data array
        $data['user_id'] = $authUser->id;
        return Todo::create($data);
    }

    public function findById($authUser, $id)
    {
        return Todo::where('user_id', $authUser->id)->findOrFail($id);
    }

    public function updateTodo($todo, array $data)
    {
        $todo->update($data);
        return $todo;
    }

    public function deleteTodo($todo)
    {
        return $todo->delete();
    }
}