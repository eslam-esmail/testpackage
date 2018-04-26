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
    $router->get('/', 'GroupsController@getAllPagination');
    $router->post('/', 'GroupsController@getFilterPagination');
    $router->get('list', 'GroupsController@getAll');
    $router->post('list', 'GroupsController@getFilter');
    $router->get('{id:[0-9]+}', 'GroupsController@getOneId');
    $router->post('one', 'GroupsController@getOneFilter');
    $router->get('prerequestForm', 'GroupsController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'GroupsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'GroupsController@updateExsitEntryById');
    $router->post('update', 'GroupsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'GroupsController@deleteExsitEntryById');
    $router->post('delete', 'GroupsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'GroupsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'GroupsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'GroupsTrashController@getAllPagination');
        $router->post('/', 'GroupsTrashController@getFilterPagination');
        $router->get('list', 'GroupsTrashController@getAll');
        $router->post('list', 'GroupsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'GroupsTrashController@getOneId');
        $router->post('one', 'GroupsTrashController@getOneFilter');

        //Force delete & reGroup
        $router->delete('delete/{id:[0-9]+}', 'GroupsTrashController@deleteExsitEntryById');
        $router->post('delete', 'GroupsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'GroupsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'GroupsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'GroupsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
