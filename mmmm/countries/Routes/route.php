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
    $router->get('/', 'CountriesController@getAllPagination');
    $router->post('/', 'CountriesController@getFilterPagination');
    $router->get('list', 'CountriesController@getAll');
    $router->post('list', 'CountriesController@getFilter');
    $router->get('{id:[0-9]+}', 'CountriesController@getOneId');
    $router->post('one', 'CountriesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'CountriesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'CountriesController@updateExsitEntryById');
    $router->post('update', 'CountriesController@updateExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'CountriesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'CountriesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'CountriesTrashController@getAllPagination');
        $router->post('/', 'CountriesTrashController@getFilterPagination');
        $router->get('list', 'CountriesTrashController@getAll');
        $router->post('list', 'CountriesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'CountriesTrashController@getOneId');
        $router->post('one', 'CountriesTrashController@getOneFilter');

        //Force delete & reCountry
        $router->get('restore/{id:[0-9]+}', 'CountriesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'CountriesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
