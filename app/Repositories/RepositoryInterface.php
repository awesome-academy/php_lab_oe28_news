<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function findOrFail($id);

    public function create($attributes = []);

    public function update($id, $attributes = []);

    public function delete($id);

    public function findByAttributesGetOne($attributes = []);

    public function findByAttributes($attributes = []);

    public function deleteByAttributes($attributes = []);
}
