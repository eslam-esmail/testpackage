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
    $router->get('/', 'FranchisesController@getAllPagination');
    $router->post('/', 'FranchisesController@getFilterPagination');
    $router->get('list', 'FranchisesController@getAll');
    $router->post('list', 'FranchisesController@getFilter');
    $router->get('{id:[0-9]+}', 'FranchisesController@getOneId');
    $router->post('one', 'FranchisesController@getOneFilter');
    $router->get('prerequestForm', 'FranchisesController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'FranchisesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'FranchisesController@updateExsitEntryById');
    $router->post('update', 'FranchisesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'FranchisesController@deleteExsitEntryById');
    $router->post('delete', 'FranchisesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'FranchisesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'FranchisesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'FranchisesTrashController@getAllPagination');
        $router->post('/', 'FranchisesTrashController@getFilterPagination');
        $router->get('list', 'FranchisesTrashController@getAll');
        $router->post('list', 'FranchisesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'FranchisesTrashController@getOneId');
        $router->post('one', 'FranchisesTrashController@getOneFilter');

        //Force delete & reFranchise
        $router->delete('delete/{id:[0-9]+}', 'FranchisesTrashController@deleteExsitEntryById');
        $router->post('delete', 'FranchisesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'FranchisesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'FranchisesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'FranchisesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed
    
    
});

//security routes
$router->post('login', 'FranchisesController@franchiseSecureLogin');