<?php

namespace App\Repositories;

interface SetoranRepositoryInterface
{
    public function all();

    public function show($setoran);

    public function store($data);

    public function update($data);

    public function destroy($setoran);
}
