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
    $router->get('/', 'SecurityRolesController@getAllPagination');
    $router->post('/', 'SecurityRolesController@getFilterPagination');
    $router->get('list', 'SecurityRolesController@getAll');
    $router->post('list', 'SecurityRolesController@getFilter');
    $router->get('{id:[0-9]+}', 'SecurityRolesController@getOneId');
    $router->post('one', 'SecurityRolesController@getOneFilter');
    $router->get('prerequestForm', 'SecurityRolesController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'SecurityRolesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'SecurityRolesController@updateExsitEntryById');
    $router->post('update', 'SecurityRolesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'SecurityRolesController@deleteExsitEntryById');
    $router->post('delete', 'SecurityRolesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'SecurityRolesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'SecurityRolesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'SecurityRolesTrashController@getAllPagination');
        $router->post('/', 'SecurityRolesTrashController@getFilterPagination');
        $router->get('list', 'SecurityRolesTrashController@getAll');
        $router->post('list', 'SecurityRolesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'SecurityRolesTrashController@getOneId');
        $router->post('one', 'SecurityRolesTrashController@getOneFilter');

        //Force delete & reSecurityRole
        $router->delete('delete/{id:[0-9]+}', 'SecurityRolesTrashController@deleteExsitEntryById');
        $router->post('delete', 'SecurityRolesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'SecurityRolesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'SecurityRolesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'SecurityRolesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
