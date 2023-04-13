<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\IRepository;

abstract class Repository implements IRepository {
    protected Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function all() {
        return $this->model->all();
    }

    public function find(int $id) {
        return $this->model->find($id);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(int $id, array $data) {
        return $this->model->whereId($id)->update($data);
    }

    public function destroy(int $id) {
        return $this->model->destroy($id);
    }
}
