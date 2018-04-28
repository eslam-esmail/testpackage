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
    $router->get('/', 'MessageTemplatesTypesController@getAllPagination');
    $router->post('/', 'MessageTemplatesTypesController@getFilterPagination');
    $router->get('list', 'MessageTemplatesTypesController@getAll');
    $router->post('list', 'MessageTemplatesTypesController@getFilter');
    $router->get('{id:[0-9]+}', 'MessageTemplatesTypesController@getOneId');
    $router->post('one', 'MessageTemplatesTypesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'MessageTemplatesTypesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'MessageTemplatesTypesController@updateExsitEntryById');
    $router->post('update', 'MessageTemplatesTypesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'MessageTemplatesTypesController@deleteExsitEntryById');
    $router->post('delete', 'MessageTemplatesTypesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'MessageTemplatesTypesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'MessageTemplatesTypesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'MessageTemplatesTypesTrashController@getAllPagination');
        $router->post('/', 'MessageTemplatesTypesTrashController@getFilterPagination');
        $router->get('list', 'MessageTemplatesTypesTrashController@getAll');
        $router->post('list', 'MessageTemplatesTypesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'MessageTemplatesTypesTrashController@getOneId');
        $router->post('one', 'MessageTemplatesTypesTrashController@getOneFilter');

        //Force delete & reMessageTemplatesType
        $router->delete('delete/{id:[0-9]+}', 'MessageTemplatesTypesTrashController@deleteExsitEntryById');
        $router->post('delete', 'MessageTemplatesTypesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'MessageTemplatesTypesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'MessageTemplatesTypesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'MessageTemplatesTypesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
