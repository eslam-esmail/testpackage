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
    $router->get('/', 'ItemCategoriesController@getAllPagination');
    $router->post('/', 'ItemCategoriesController@getFilterPagination');
    $router->get('list', 'ItemCategoriesController@getAll');
    $router->post('list', 'ItemCategoriesController@getFilter');
    $router->get('{id:[0-9]+}', 'ItemCategoriesController@getOneId');
    $router->post('one', 'ItemCategoriesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'ItemCategoriesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'ItemCategoriesController@updateExsitEntryById');
    $router->post('update', 'ItemCategoriesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'ItemCategoriesController@deleteExsitEntryById');
    $router->post('delete', 'ItemCategoriesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'ItemCategoriesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'ItemCategoriesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'ItemCategoriesTrashController@getAllPagination');
        $router->post('/', 'ItemCategoriesTrashController@getFilterPagination');
        $router->get('list', 'ItemCategoriesTrashController@getAll');
        $router->post('list', 'ItemCategoriesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'ItemCategoriesTrashController@getOneId');
        $router->post('one', 'ItemCategoriesTrashController@getOneFilter');

        //Force delete & reItemCategory
        $router->delete('delete/{id:[0-9]+}', 'ItemCategoriesTrashController@deleteExsitEntryById');
        $router->post('delete', 'ItemCategoriesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'ItemCategoriesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'ItemCategoriesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'ItemCategoriesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
