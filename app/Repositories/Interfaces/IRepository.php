<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface IRepository {

    public function all();
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function destroy(int $id);

}
