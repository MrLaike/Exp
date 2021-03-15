<?php

namespace App\Models;

use Kernel\Model;

class Client extends Model
{
    public function index()
    {
        return $this->get();
    }

    public function store($request)
    {
        return $this->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
    }

    public function deleteBy($id)
    {
        return $this->delete($id);
    }

}