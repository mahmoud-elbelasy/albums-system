<?php

namespace App\Repositories\Classes;

use App\Models\Album;

use App\Repositories\Interfaces\{IMainRepository};
use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use Illuminate\Http\Request;

class AlbumRepository extends BasicRepository implements IMainRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'id', 'name'
    ];

    /**
     * configure the model
     */
    public function model() : string
    {
        return Album::class;
    }

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip ?? '';
    }

    public function translationKey()
    {
        return $this->model->translationKey();
    }

    public function findBy(Request $request)
    {
        return $this->all();
    }

    public function store($data)
    {
        $this->create($data);
    }

    public function update($request, $id = null) : Model|Collection|Builder|array|null
    {
        return $this->save($request, $id);
    }
    
    public function list()
    {
        return $this->all();
    }

    public function show($id) : Model|Collection|Builder|array|null
    {
        return $this->find($id);
    }

    public function destroy($id)
    {
        return $this->delete($id);

    }

    
}
