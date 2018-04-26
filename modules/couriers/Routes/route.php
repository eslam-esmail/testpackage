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
    $router->get('/', 'CouriersController@getAllPagination');
    $router->post('/', 'CouriersController@getFilterPagination');
    $router->get('list', 'CouriersController@getAll');
    $router->post('list', 'CouriersController@getFilter');
    $router->get('{id:[0-9]+}', 'CouriersController@getOneId');
    $router->post('one', 'CouriersController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'CouriersController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'CouriersController@updateExsitEntryById');
    $router->post('update', 'CouriersController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'CouriersController@deleteExsitEntryById');
    $router->post('delete', 'CouriersController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'CouriersController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'CouriersController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'CouriersTrashController@getAllPagination');
        $router->post('/', 'CouriersTrashController@getFilterPagination');
        $router->get('list', 'CouriersTrashController@getAll');
        $router->post('list', 'CouriersTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'CouriersTrashController@getOneId');
        $router->post('one', 'CouriersTrashController@getOneFilter');

        //Force delete & reCourier
        $router->delete('delete/{id:[0-9]+}', 'CouriersTrashController@deleteExsitEntryById');
        $router->post('delete', 'CouriersTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'CouriersTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'CouriersTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'CouriersTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed
});
