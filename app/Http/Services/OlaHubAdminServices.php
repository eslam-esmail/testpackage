<?php

namespace OlaHub\Services;

use Validator;
use \League\Fractal\Manager;
use \League\Fractal\Resource\Collection as FractalCollection;
use \League\Fractal\Resource\Item as FractalItem;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

abstract class OlaHubAdminServices {

    protected $repo;
    protected $select;
    protected $requestData;
    protected $requestFilter;
    protected $columnsValues;
    protected $requestValidator;
    protected $criteria;
    protected $responseHandler;
    protected $requestIgnoredDataKeys;
    protected $requestIgnoredFilterKeys;
    protected $filterValidator;
    protected $modelName;
    public $trash;

    public function __construct() {
        $this->select = ['*'];
        $this->columnsValues = [];
        $this->criteria = [];
        $this->requestIgnoredDataKeys = ['_method', 'id', 'updater','created','creator','last_update','country'];
        $this->requestIgnoredFilterKeys = ['page'];
        $this->filterValidator = [];
        $this->trash = FALSE;
    }

    function getAll() {
        $data = $this->repo->findAll($this->select, $this->trash);
        if (!$data || $data->count() <= 0) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollection($data);
    }

    function getPagination() {
        
        $data = $this->repo->findAllPaginate($this->select, $this->trash);
        if (!$data || $data->count() <= 0) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollectionPginate($data);
    }

    function getAllCeriatria() {
        $this->handlingRequestFilter();
        $data = $this->repo->findBy($this->criteria, $this->select, $this->trash);
        if (!$data || $data->count() <= 0) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollection($data);
    }

    function getPaginationCeriatria() {
        $this->handlingRequestFilter();
        $data = $this->repo->findPaginateBy($this->criteria, $this->select, $this->trash);
        if (!$data || $data->count() <= 0) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollectionPginate($data);
    }

    function getOneByID($id) {
        $data = $this->repo->findOneID($id, $this->select, $this->trash);
        if (!$data) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseItem($data);
    }

    function getOneByFilter() {
        $this->handlingRequestFilter();
        $data = $this->repo->findOneBy($this->criteria, $this->select, $this->trash);
        if (!$data) {
            return ['error' => 404, 'msg' => 'No data found'];
        }
        return $this->handlingResponseItem($data);
    }

    function saveNewData() {
        $this->handlingRequestData();
        if (!$this->checkValidation()) {
            return ['error' => 415, 'msg' => $this->requestValidator->errors()->toArray()];
        }
        $saved = $this->repo->createNewData($this->columnsValues);
        if (array_key_exists('error', $saved)) {
            if (env('APP_ENV') == 'local') {
                return ['error' => 500, 'msg' => $saved['msg']];
            }
            return ['error' => 500, 'msg' => 'An error has been occured'];
        }
        return $this->handlingResponseItem($saved);
    }

    function updateByID($id, $status = false) {
        config(['currentID' => $id]);
        $this->setPublish($status);
        $this->handlingRequestData();
        if (!$this->checkValidation()) {
            return ['error' => 415, 'msg' => $this->requestValidator->errors()->toArray()];
        }
        $updated = $this->repo->updateDataByID($id, $this->columnsValues);
        if (array_key_exists('error', $updated)) {
            if (env('APP_ENV') == 'local') {
                return ['error' => 500, 'msg' => $updated['msg']];
            }
            return ['error' => 304, 'msg' => 'An error has been occured'];
        }
        
        if ($updated == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        
        return $this->handlingResponseItem($updated);
    }

    function updateByFilter($status = false) {
        $this->setPublish($status);
        $this->handlingRequestData();
        $this->handlingRequestFilter();

        if (!$this->checkValidation()) {
            return ['error' => 415, 'msg' => $this->requestValidator->errors()->toArray()];
        }
        $updated = $this->repo->updateDataByFilter($this->criteria, $this->columnsValues);
        if (array_key_exists('error', $updated)) {
            if (env('APP_ENV') == 'local') {
                return ['error' => 500, 'msg' => $updated['msg']];
            }
            return ['error' => 304, 'msg' => 'An error has been occured'];
        }
        
        if ($updated == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollection($updated);
    }

    function deleteById($id) {
        $deleted = $this->repo->deleteDataByID($id, $this->trash);
        if (!$deleted) {
            return ['error' => 500, 'msg' => 'An error has been occured'];
        } elseif ($deleted == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        return ['msg' => 'Data has been deleted successfully'];
    }

    function deleteByFilter() {
        $this->handlingRequestFilter();
        $deleted = $this->repo->deleteDataByFilter($this->criteria, $this->trash);
        if (!$deleted) {
            return ['error' => 500, 'msg' => 'An error has been occured'];
        } elseif ($deleted == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        return ['msg' => 'Data has been deleted successfully'];
    }

    function restoreById($id) {
        $restored = $this->repo->restoreDataByID($id);
        if (!$restored) {
            return ['error' => 500, 'msg' => 'An error has been occured'];
        } elseif ($restored == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        return $this->handlingResponseItem($restored);
    }

    function restoreByFilter() {
        $this->handlingRequestFilter();
        $restored = $this->repo->restoreDataByFilter($this->criteria);
        if (!$restored) {
            return ['error' => 500, 'msg' => 'An error has been occured'];
        } elseif ($restored == 'no_data') {
            return ['error' => 204, 'msg' => 'No data found'];
        }
        return $this->handlingResponseCollection($restored);
    }

    public function setRequestData($request) {
        $this->requestData = $request;
    }

    public function setRequestFilter($request) {
        $this->requestFilter = $request;
    }

    protected function setPublish($status) {
        if ($status == 'publish') {
            $this->columnsValues['is_publish'] = '1';
        } elseif ($status == 'unpublish') {
            $this->columnsValues['is_publish'] = '0';
        }
    }

    protected function checkValidation() {
        $this->requestValidator = Validator::make($this->columnsValues, $this->repo->getRequestValidationRules());
        if ($this->requestValidator->fails()) {
            return false;
        }
        return true;
    }

    protected function handlingRequestData() {
        if (isset($this->requestData)) {
            foreach ($this->requestData as $key => $value) {
                if (!in_array($key, $this->requestIgnoredDataKeys)) {
                    $this->columnsValues[$key] = $value;
                }
            }
        }
    }

    protected function handlingRequestFilter() {
        if (isset($this->requestFilter)) {
            foreach ($this->requestFilter as $columnName => $data) {
                if (!in_array($columnName, $this->requestIgnoredFilterKeys) && $this->validateFilterData($columnName, $data)) {
                    $this->criteria[$columnName] = $data;
                }
            }
        }
    }

    protected function handlingResponseItem($data, $responseHandler = false) {
        if(!$responseHandler){
            $responseHandler = $this->responseHandler;
        }
        $fractal = new Manager();
        $resource = new FractalItem($data, new $responseHandler);
        return $fractal->createData($resource)->toArray();
    }

    protected function handlingResponseCollection($data, $responseHandler = false) {
        if(!$responseHandler){
            $responseHandler = $this->responseHandler;
        }
        $collection = $data;
        $fractal = new Manager();
        $resource = new FractalCollection($collection, new $responseHandler);
        return $fractal->createData($resource)->toArray();
    }

    protected function handlingResponseCollectionPginate($data, $responseHandler = false) {
        if(!$responseHandler){
            $responseHandler = $this->responseHandler;
        }
        $collection = $data->getCollection();
        $fractal = new Manager();
        $resource = new FractalCollection($collection, new $responseHandler);
        $resource->setPaginator(new IlluminatePaginatorAdapter($data));
        return $fractal->createData($resource)->toArray();
    }

    private function validateFilterData($column, $data) {
        $return = true;
        if (isset($this->filterValidator[$column])) {
            foreach ($data as $filter) {
                if (is_array($filter)) {
                    foreach ($filter as $one) {
                        $validator = Validator::make([$column => $one], $this->filterValidator);
                        if ($validator->fails()) {
                            return false;
                        }
                    }
                } else {
                    $validator = Validator::make([$column => $filter], $this->filterValidator);
                    if ($validator->fails()) {
                        return false;
                    }
                }
            }
        }

        return $return;
    }

}
