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
    $router->get('/', 'MessageTemplatesController@getAllPagination');
    $router->post('/', 'MessageTemplatesController@getFilterPagination');
    $router->get('list', 'MessageTemplatesController@getAll');
    $router->post('list', 'MessageTemplatesController@getFilter');
    $router->get('{id:[0-9]+}', 'MessageTemplatesController@getOneId');
    $router->post('one', 'MessageTemplatesController@getOneFilter');
    $router->get('prerequestForm', 'MessageTemplatesController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'MessageTemplatesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'MessageTemplatesController@updateExsitEntryById');
    $router->post('update', 'MessageTemplatesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'MessageTemplatesController@deleteExsitEntryById');
    $router->post('delete', 'MessageTemplatesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'MessageTemplatesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'MessageTemplatesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'MessageTemplatesTrashController@getAllPagination');
        $router->post('/', 'MessageTemplatesTrashController@getFilterPagination');
        $router->get('list', 'MessageTemplatesTrashController@getAll');
        $router->post('list', 'MessageTemplatesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'MessageTemplatesTrashController@getOneId');
        $router->post('one', 'MessageTemplatesTrashController@getOneFilter');

        //Force delete & reMessageTemplate
        $router->delete('delete/{id:[0-9]+}', 'MessageTemplatesTrashController@deleteExsitEntryById');
        $router->post('delete', 'MessageTemplatesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'MessageTemplatesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'MessageTemplatesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'MessageTemplatesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
