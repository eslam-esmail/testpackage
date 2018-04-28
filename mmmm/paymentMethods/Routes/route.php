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
    $router->get('/', 'PaymentMethodsController@getAllPagination');
    $router->post('/', 'PaymentMethodsController@getFilterPagination');
    $router->get('list', 'PaymentMethodsController@getAll');
    $router->post('list', 'PaymentMethodsController@getFilter');
    $router->get('{id:[0-9]+}', 'PaymentMethodsController@getOneId');
    $router->post('one', 'PaymentMethodsController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'PaymentMethodsController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'PaymentMethodsController@updateExsitEntryById');
    $router->post('update', 'PaymentMethodsController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'PaymentMethodsController@deleteExsitEntryById');
    $router->post('delete', 'PaymentMethodsController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'PaymentMethodsController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'PaymentMethodsController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'PaymentMethodsTrashController@getAllPagination');
        $router->post('/', 'PaymentMethodsTrashController@getFilterPagination');
        $router->get('list', 'PaymentMethodsTrashController@getAll');
        $router->post('list', 'PaymentMethodsTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'PaymentMethodsTrashController@getOneId');
        $router->post('one', 'PaymentMethodsTrashController@getOneFilter');

        //Force delete & rePaymentMethod
        $router->delete('delete/{id:[0-9]+}', 'PaymentMethodsTrashController@deleteExsitEntryById');
        $router->post('delete', 'PaymentMethodsTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'PaymentMethodsTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'PaymentMethodsTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'PaymentMethodsTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
