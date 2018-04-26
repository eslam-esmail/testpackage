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
    $router->get('/', 'ProductAttributesController@getAllPagination');
    $router->post('/', 'ProductAttributesController@getFilterPagination');
    $router->get('list', 'ProductAttributesController@getAll');
    $router->post('list', 'ProductAttributesController@getFilter');
    $router->get('{id:[0-9]+}', 'ProductAttributesController@getOneId');
    $router->post('one', 'ProductAttributesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'ProductAttributesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'ProductAttributesController@updateExsitEntryById');
    $router->post('update', 'ProductAttributesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'ProductAttributesController@deleteExsitEntryById');
    $router->post('delete', 'ProductAttributesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'ProductAttributesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'ProductAttributesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'ProductAttributesTrashController@getAllPagination');
        $router->post('/', 'ProductAttributesTrashController@getFilterPagination');
        $router->get('list', 'ProductAttributesTrashController@getAll');
        $router->post('list', 'ProductAttributesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'ProductAttributesTrashController@getOneId');
        $router->post('one', 'ProductAttributesTrashController@getOneFilter');

        //Force delete & reProductAttribute
        $router->delete('delete/{id:[0-9]+}', 'ProductAttributesTrashController@deleteExsitEntryById');
        $router->post('delete', 'ProductAttributesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'ProductAttributesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'ProductAttributesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'ProductAttributesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
