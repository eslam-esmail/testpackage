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
    $router->get('/', 'ExchangeAndRefundsController@getAllPagination');
    $router->post('/', 'ExchangeAndRefundsController@getFilterPagination');
    $router->get('list', 'ExchangeAndRefundsController@getAll');
    $router->post('list', 'ExchangeAndRefundsController@getFilter');
    $router->get('{id:[0-9]+}', 'ExchangeAndRefundsController@getOneId');
    $router->post('one', 'ExchangeAndRefundsController@getOneFilter');
    $router->get('prerequestForm', 'ExchangeAndRefundsController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'ExchangeAndRefundsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'ExchangeAndRefundsController@updateExsitEntryById');
    $router->post('update', 'ExchangeAndRefundsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'ExchangeAndRefundsController@deleteExsitEntryById');
    $router->post('delete', 'ExchangeAndRefundsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'ExchangeAndRefundsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'ExchangeAndRefundsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'ExchangeAndRefundsTrashController@getAllPagination');
        $router->post('/', 'ExchangeAndRefundsTrashController@getFilterPagination');
        $router->get('list', 'ExchangeAndRefundsTrashController@getAll');
        $router->post('list', 'ExchangeAndRefundsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'ExchangeAndRefundsTrashController@getOneId');
        $router->post('one', 'ExchangeAndRefundsTrashController@getOneFilter');

        //Force delete & reExchangeAndRefund
        $router->delete('delete/{id:[0-9]+}', 'ExchangeAndRefundsTrashController@deleteExsitEntryById');
        $router->post('delete', 'ExchangeAndRefundsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'ExchangeAndRefundsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'ExchangeAndRefundsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'ExchangeAndRefundsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
