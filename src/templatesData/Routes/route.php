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
    $router->get('/', 'DTemplatesController@getAllPagination');
    $router->post('/', 'DTemplatesController@getFilterPagination');
    $router->get('list', 'DTemplatesController@getAll');
    $router->post('list', 'DTemplatesController@getFilter');
    $router->get('{id:[0-9]+}', 'DTemplatesController@getOneId');
    $router->post('one', 'DTemplatesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'DTemplatesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'DTemplatesController@updateExsitEntryById');
    $router->post('update', 'DTemplatesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'DTemplatesController@deleteExsitEntryById');
    $router->post('delete', 'DTemplatesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'DTemplatesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'DTemplatesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'DTemplatesTrashController@getAllPagination');
        $router->post('/', 'DTemplatesTrashController@getFilterPagination');
        $router->get('list', 'DTemplatesTrashController@getAll');
        $router->post('list', 'DTemplatesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'DTemplatesTrashController@getOneId');
        $router->post('one', 'DTemplatesTrashController@getOneFilter');

        //Force delete & reDTemplate
        $router->delete('delete/{id:[0-9]+}', 'DTemplatesTrashController@deleteExsitEntryById');
        $router->post('delete', 'DTemplatesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'DTemplatesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'DTemplatesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'DTemplatesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
