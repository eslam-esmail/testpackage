<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$router->group([
    'prefix' => basename(dirname(__DIR__))
        ], function () use($router) {

    // List routes
    $router->get('/', 'ProductAttributeValuesController@getAllPagination');
    $router->post('/', 'ProductAttributeValuesController@getFilterPagination');
    $router->get('list', 'ProductAttributeValuesController@getAll');
    $router->post('list', 'ProductAttributeValuesController@getFilter');
    $router->get('{id:[0-9]+}', 'ProductAttributeValuesController@getOneId');
    $router->post('one', 'ProductAttributeValuesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'ProductAttributeValuesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'ProductAttributeValuesController@updateExsitEntryById');
    $router->post('update', 'ProductAttributeValuesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'ProductAttributeValuesController@deleteExsitEntryById');
    $router->post('delete', 'ProductAttributeValuesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'ProductAttributeValuesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'ProductAttributeValuesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'ProductAttributeValuesTrashController@getAllPagination');
        $router->post('/', 'ProductAttributeValuesTrashController@getFilterPagination');
        $router->get('list', 'ProductAttributeValuesTrashController@getAll');
        $router->post('list', 'ProductAttributeValuesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'ProductAttributeValuesTrashController@getOneId');
        $router->post('one', 'ProductAttributeValuesTrashController@getOneFilter');

        //Force delete & reProductAttributeValue
        $router->delete('delete/{id:[0-9]+}', 'ProductAttributeValuesTrashController@deleteExsitEntryById');
        $router->post('delete', 'ProductAttributeValuesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'ProductAttributeValuesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'ProductAttributeValuesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'ProductAttributeValuesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
