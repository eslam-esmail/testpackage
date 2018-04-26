<?php

namespace OlaHub\Repositories;



class OlaHubAdminRepository {

    protected $query;
    protected $mutation;
    protected $columnsValue;
    private $filterCount = 0;
    protected $manyToManyData = [];
    private $model;

    public function __construct($modelName)
    {
        $this->model = $modelName;
        $this->mutation = new $modelName;
    }

    public function getRequestValidationRules() {
        return $this->mutation->getValidationsRules();
    }

    public function setManyToManyData() {
        $this->manyToManyData = $this->mutation->getManyToManyFilters();
    }

    public function findAll($select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }
        return $this->query->get($select);
    }

    public function findAllPaginate($select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }
        return $this->query->paginate(env('PAGINATION_COUNT'), $select);
    }

    public function findPaginateBy(array $criteria, $select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }

        if(count($criteria)){
            if($this->setFilterData($criteria)){
                return $this->query->paginate(env('PAGINATION_COUNT'), $select);
            }else{
                return false;
            }
        }

        //return $this->query->paginate(env('PAGINATION_COUNT'), $select);


//        dd(\DB::getQueryLog());
    }

    public function findBy(array $criteria, $select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }
        $this->setFilterData($criteria);
        return $this->query->get($select);
    }

    public function findOneID($id, $select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }
        return $this->query->findOrFail((int) $id, $select);
    }

    public function findOneBy(array $criteria, $select = ['*'], $trashed = false) {
        $this->query = (new $this->model)->newQuery();
        if ($trashed) {
            $this->query->onlyTrashed();
        }
        $this->setFilterData($criteria);
        return $this->query->firstOrFail($select);
    }

    public function createNewData(array $data) {
        $this->query = (new $this->model)->newQuery();
        $this->setColumnsDataValues($data);
        $saved = false;
        try {
            \DB::connection()->beginTransaction();
            $saved = $this->query->create($this->columnsValue);
            if ($saved) {
                $newData = $this->findOneID((int) $saved->id);
            }
            \DB::connection()->commit();

            $this->mutation->additionalQueriesFired(['model' => $newData, 'type' => 'create', 'count' => 'one']);

            return $newData;
        } catch (\PDOException $e) {
            \DB::connection()->rollBack();
            return ['error' => '1', 'msg' => $e->getMessage()];
        }
    }

    public function updateDataByID($id, array $data) {
        $item = $this->findOneID((int) $id);
        $this->query = (new $this->model)->newQuery();
        if (!$item) {
            return 'no_data';
        }
        $update = false;
        try {
            \DB::connection()->beginTransaction();
            $this->setColumnsDataValues($data);
            $update = $this->query->where($this->mutation->getKeyName(), (int) $id)->update($this->columnsValue);
            if ($update) {
                $updatedData = $this->findOneID((int) $id);
                $this->mutation->additionalQueriesFired(['model' => $updatedData, 'type' => 'update', 'count' => 'one']);
            }
            \DB::connection()->commit();
            return $updatedData;
        } catch (\PDOException $e) {
            \DB::connection()->rollBack();
            return ['error' => '1', 'msg' => $e->getMessage()];
        }
    }

    public function updateDataByFilter(array $criteria, array $data) {
        $item = $this->findBy($criteria);
        $this->query = (new $this->model)->newQuery();
        if (!$item) {
            return 'no_data';
        }
        $update = false;
        try {
            \DB::connection()->beginTransaction();
            $this->setColumnsDataValues($data);
            if ($this->setFilterData($criteria)) {
                $update = $this->query->update($this->columnsValue);
                if ($update) {
                    $updatedData = $this->findBy($criteria);
                    $this->mutation->additionalQueriesFired(['model' => $updatedData, 'type' => 'update', 'count' => 'many']);
                    \DB::connection()->commit();
                    return $updatedData;
                }
            }
            \DB::connection()->rollBack();
            return ['error' => '1', 'msg' => 'No data found'];
        } catch (\PDOException $e) {
            \DB::connection()->rollBack();
            return ['error' => '1', 'msg' => $e->getMessage()];
        }
    }

    public function deleteDataByFilter(array $criteria, $trash) {
        $item = $this->findBy($criteria, ['*'], $trash);
        $this->query = (new $this->model)->newQuery();
        if ($item->count() <= 0) {
            return 'no_data';
        }
        if ($this->setFilterData($criteria)) {
            if ($trash) {
                $deleted = $this->query->forceDelete();
            } else {
                $deleted = $this->query->delete();
            }
            if ($deleted) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function deleteDataByID($id, $trash) {
        $item = $this->findOneID((int) $id, ['*'], $trash);
        $this->query = (new $this->model)->newQuery();
        if (!$item) {
            return 'no_data';
        }
        if ($trash) {
            $deleted = $this->query->where($this->mutation->getKeyName(), (int) $id)->forceDelete();
        } else {
            $deleted = $this->query->where($this->mutation->getKeyName(), (int) $id)->delete();
        }

        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }

    public function restoreDataByFilter(array $criteria) {
        $item = $this->findBy($criteria, ['*'], true);
        $this->query = (new $this->model)->newQuery();
        if (!$item) {
            return 'no_data';
        }
        $this->query->withTrashed();
        if ($this->setFilterData($criteria)) {
            $restored = $this->query->restore();
            if ($restored) {
                return $this->findBy($criteria);
            } else {
                return false;
            }
        }
        return false;
    }

    public function restoreDataByID($id) {
        $item = $this->findOneID((int) $id, ['*'], true);
        $this->query = (new $this->model)->newQuery();
        if (!$item) {
            return 'no_data';
        }
        $this->query->withTrashed();
        $restored = $this->query->where($this->mutation->getKeyName(), (int) $id)->restore();
        if ($restored) {
            return $this->findOneID((int) $id);
        } else {
            return false;
        }
    }

    //helper functions All are private

    private function setFilterData($criteria) {
        if (count($criteria) > 0) {
            $this->setManyToManyData();
            foreach ($criteria as $columnName => $filterValue) {
                if(array_key_exists($columnName, $this->manyToManyData)){
                    $this->handlingRelationFilterTypesMaping($columnName, $filterValue, $this->manyToManyData[$columnName]);
                }else{
                    $this->handlingFilterTypesMaping($columnName, $filterValue);
                }
            }
        }
        if ($this->filterCount) {
            return true;
        }
        return FALSE;
    }

    private function handlingRelationFilterTypesMaping($columnName, $filterValue, $functionName) {
        foreach ($filterValue as $type => $value) {


                switch ($type) {
                    case 'is':
                        if (is_array($value)) {
                            $this->mutation->$functionName()->wherePivotIn($columnName, $value)->get();
                            $this->filterCount += 1;
                        } else {
                            //$this->mutation->$functionName()->wherePivot($columnName, $value)->get();
                            $m = $this->mutation->$functionName()->first();
                            dd($m);
                            //$this->filterCount += 1;
                        }
                        break;
                    case 'not_is':
                        if (is_array($value)) {
                            $this->query->whereNotIn($columnName, $value);
                            $this->filterCount += 1;
                        } else {
                            $this->query->where($columnName, '!=', $value);
                            $this->filterCount += 1;
                        }
                        break;
                    case 'match':
                        if(is_string($value))
                        {
                            $this->query->where($columnName, 'like', "%$value%");
                            $this->filterCount += 1;
                        }
                        break;
                    case 'from':
                        $this->query->where($columnName, '>=', $value);
                        $this->filterCount += 1;
                        break;
                    case 'to':
                        $this->query->where($columnName, '<=', $value);
                        $this->filterCount += 1;
                        break;
                    case 'ordring':
                        $this->query->orderBy($columnName, $value);
                        $this->filterCount += 1;
                        break;
                    case 'grouping':
                        $this->query->groupBy($columnName, $value);
                        $this->filterCount += 1;
                        break;
                }


        }
    }

    private function handlingFilterTypesMaping($columnName, $filterValue) {
        foreach ($filterValue as $type => $value) {
            switch ($type) {
                case 'is':
                    if (is_array($value)) {
                        $this->query->whereIn($columnName, $value);
                        $this->filterCount += 1;
                    } else {
                        $this->query->where($columnName, $value);
                        $this->filterCount += 1;
                    }
                    break;
                case 'not_is':
                    if (is_array($value)) {
                        $this->query->whereNotIn($columnName, $value);
                        $this->filterCount += 1;
                    } else {
                        $this->query->where($columnName, '!=', $value);
                        $this->filterCount += 1;
                    }
                    break;
                case 'match':
                    if(is_string($value)){
                        $this->query->where($columnName, 'like', "%$value%");
                        $this->filterCount += 1;
                    }
                    break;
                case 'from':
                    $this->query->where($columnName, '>=', $value);
                    $this->filterCount += 1;
                    break;
                case 'to':
                    $this->query->where($columnName, '<=', $value);
                    $this->filterCount += 1;
                    break;
                case 'ordring':
                    $this->query->orderBy($columnName, $value);
                    $this->filterCount += 1;
                    break;
                case 'grouping':
                    $this->query->groupBy($columnName, $value);
                    $this->filterCount += 1;
                    break;
            }
        }
    }

    private function setColumnsDataValues($data) {
        $this->columnsValue = $data;
    }

}
