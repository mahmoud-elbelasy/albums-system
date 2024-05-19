<?php

namespace App\Repositories\Classes;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\{Collection, Model};

use Illuminate\Database\Eloquent\{Builder};



abstract class BasicRepository
{
    

    /**
     * @var Model
     */
    protected $model;

    /**
     * Configure the Model
     *
     * @return string
     */

    abstract public function model();

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make Model instance
     *
     * @return Model
     * @throws \Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

      /**
     * Display a listing of the resource.
     * column is array with we select it from table
     */

    public function all(array $filters = [], array $relations = [], $perPage = 10)
    {
         $query = $this->model->newQuery()->with($relations);
 
         foreach ($filters as $column => $value) {
             if (is_array($value)) {
                 $query->whereIn($column, $value);
             } else {
                 $query->where($column, $value);
             }
         }
 
         return $query->paginate($perPage);
    }
 




    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    abstract public function getFieldsRelationShipSearchable();

    abstract public function translationKey();


  

    public function find($id, $column = ['*'], $withRelations = [])
    {
        $query = $this->model->newQuery();
        if (!empty($withRelations)) {
            $query->with($withRelations);
            //            $query = $this->with($query, $withRelations);
        }
        return $query->find($id, $column);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->model->create($request);
    }

    /**
     * @param      $request
     * @param null $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function save($request, $id = null) : Model|Collection|Builder|array|null
    {
        $data = $this->find($id);
        $data->update($request);
        return $this->find($id);
    }

    

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id) : mixed
    {
        $data = $this->find($id, ['*'], [], true);
        return $data ? $data->delete() : false;
    }
}
