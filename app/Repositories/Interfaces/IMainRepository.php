<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IMainRepository
{
    public function findBy(Request $request);
    public function store($data);
    public function list();
    public function show($id);
    public function save($request, $id);
    public function destroy($id);
}
