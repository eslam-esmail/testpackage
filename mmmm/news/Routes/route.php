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
    $router->get('/', 'NewsController@getAllPagination');
    $router->post('/', 'NewsController@getFilterPagination');
    $router->get('list', 'NewsController@getAll');
    $router->post('list', 'NewsController@getFilter');
    $router->get('{id:[0-9]+}', 'NewsController@getOneId');
    $router->post('one', 'NewsController@getOneFilter');
    $router->get('prerequestForm', 'NewsController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'NewsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'NewsController@updateExsitEntryById');
    $router->post('update', 'NewsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'NewsController@deleteExsitEntryById');
    $router->post('delete', 'NewsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'NewsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'NewsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'NewsTrashController@getAllPagination');
        $router->post('/', 'NewsTrashController@getFilterPagination');
        $router->get('list', 'NewsTrashController@getAll');
        $router->post('list', 'NewsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'NewsTrashController@getOneId');
        $router->post('one', 'NewsTrashController@getOneFilter');

        //Force delete & reNews
        $router->delete('delete/{id:[0-9]+}', 'NewsTrashController@deleteExsitEntryById');
        $router->post('delete', 'NewsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'NewsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'NewsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'NewsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
