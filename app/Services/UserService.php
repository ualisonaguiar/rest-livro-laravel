<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $data): User
    {
        $userEmail = User::where('ds_email', $data['ds_email']);

        if ($userEmail->exists()) {
            throw new \Exception('O e-mail informado já existe');
        }

        return User::create($data);
    }

    public function update(string $id, array $data): User
    {
        $user = User::find($id);
        $user->ds_nome = $data['ds_nome'];
        $user->ds_email = $data['ds_email'];

        $user->save();

        return $user;
    }

    public function delete(string $id): User
    {
        $user = User::find($id);
        $user->delete();
        
        return $user;
    }
}
