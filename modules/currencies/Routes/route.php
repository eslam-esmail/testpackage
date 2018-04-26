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
    $router->get('/', 'CurrenciesController@getAllPagination');
    $router->post('/', 'CurrenciesController@getFilterPagination');
    $router->get('list', 'CurrenciesController@getAll');
    $router->post('list', 'CurrenciesController@getFilter');
    $router->get('{id:[0-9]+}', 'CurrenciesController@getOneId');
    $router->post('one', 'CurrenciesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'CurrenciesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'CurrenciesController@updateExsitEntryById');
    $router->post('update', 'CurrenciesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'CurrenciesController@deleteExsitEntryById');
    $router->post('delete', 'CurrenciesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'CurrenciesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'CurrenciesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'CurrenciesTrashController@getAllPagination');
        $router->post('/', 'CurrenciesTrashController@getFilterPagination');
        $router->get('list', 'CurrenciesTrashController@getAll');
        $router->post('list', 'CurrenciesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'CurrenciesTrashController@getOneId');
        $router->post('one', 'CurrenciesTrashController@getOneFilter');

        //Force delete & reCurrency
        $router->delete('delete/{id:[0-9]+}', 'CurrenciesTrashController@deleteExsitEntryById');
        $router->post('delete', 'CurrenciesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'CurrenciesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'CurrenciesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'CurrenciesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
