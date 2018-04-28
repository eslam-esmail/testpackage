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
    $router->get('/', 'StatesController@getAllPagination');
    $router->post('/', 'StatesController@getFilterPagination');
    $router->get('list', 'StatesController@getAll');
    $router->post('list', 'StatesController@getFilter');
    $router->get('{id:[0-9]+}', 'StatesController@getOneId');
    $router->post('one', 'StatesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'StatesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'StatesController@updateExsitEntryById');
    $router->post('update', 'StatesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'StatesController@deleteExsitEntryById');
    $router->post('delete', 'StatesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'StatesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'StatesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'StatesTrashController@getAllPagination');
        $router->post('/', 'StatesTrashController@getFilterPagination');
        $router->get('list', 'StatesTrashController@getAll');
        $router->post('list', 'StatesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'StatesTrashController@getOneId');
        $router->post('one', 'StatesTrashController@getOneFilter');

        //Force delete & reState
        $router->delete('delete/{id:[0-9]+}', 'StatesTrashController@deleteExsitEntryById');
        $router->post('delete', 'StatesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'StatesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'StatesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'StatesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
