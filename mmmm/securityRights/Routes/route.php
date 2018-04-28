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
    $router->get('/', 'SecurityRightsController@getAllPagination');
    $router->post('/', 'SecurityRightsController@getFilterPagination');
    $router->get('list', 'SecurityRightsController@getAll');
    $router->post('list', 'SecurityRightsController@getFilter');
    $router->get('{id:[0-9]+}', 'SecurityRightsController@getOneId');
    $router->post('one', 'SecurityRightsController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'SecurityRightsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'SecurityRightsController@updateExsitEntryById');
    $router->post('update', 'SecurityRightsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'SecurityRightsController@deleteExsitEntryById');
    $router->post('delete', 'SecurityRightsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'SecurityRightsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'SecurityRightsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'SecurityRightsTrashController@getAllPagination');
        $router->post('/', 'SecurityRightsTrashController@getFilterPagination');
        $router->get('list', 'SecurityRightsTrashController@getAll');
        $router->post('list', 'SecurityRightsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'SecurityRightsTrashController@getOneId');
        $router->post('one', 'SecurityRightsTrashController@getOneFilter');

        //Force delete & reSecurityRight
        $router->delete('delete/{id:[0-9]+}', 'SecurityRightsTrashController@deleteExsitEntryById');
        $router->post('delete', 'SecurityRightsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'SecurityRightsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'SecurityRightsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'SecurityRightsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
