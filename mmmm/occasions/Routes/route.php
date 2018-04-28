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
    $router->get('/', 'OccasionsController@getAllPagination');
    $router->post('/', 'OccasionsController@getFilterPagination');
    $router->get('list', 'OccasionsController@getAll');
    $router->post('list', 'OccasionsController@getFilter');
    $router->get('{id:[0-9]+}', 'OccasionsController@getOneId');
    $router->post('one', 'OccasionsController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'OccasionsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'OccasionsController@updateExsitEntryById');
    $router->post('update', 'OccasionsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'OccasionsController@deleteExsitEntryById');
    $router->post('delete', 'OccasionsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'OccasionsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'OccasionsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'OccasionsTrashController@getAllPagination');
        $router->post('/', 'OccasionsTrashController@getFilterPagination');
        $router->get('list', 'OccasionsTrashController@getAll');
        $router->post('list', 'OccasionsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'OccasionsTrashController@getOneId');
        $router->post('one', 'OccasionsTrashController@getOneFilter');

        //Force delete & reOccasion
        $router->delete('delete/{id:[0-9]+}', 'OccasionsTrashController@deleteExsitEntryById');
        $router->post('delete', 'OccasionsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'OccasionsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'OccasionsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'OccasionsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
