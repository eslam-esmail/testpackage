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
    $router->get('/', 'LanguagesController@getAllPagination');
    $router->post('/', 'LanguagesController@getFilterPagination');
    $router->get('list', 'LanguagesController@getAll');
    $router->post('list', 'LanguagesController@getFilter');
    $router->get('{id:[0-9]+}', 'LanguagesController@getOneId');
    $router->post('one', 'LanguagesController@getOneFilter');

    //Add, update & delete  routes
    $router->post('save', 'LanguagesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'LanguagesController@updateExsitEntryById');
    $router->post('update', 'LanguagesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'LanguagesController@deleteExsitEntryById');
    $router->post('delete', 'LanguagesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'LanguagesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'LanguagesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'LanguagesTrashController@getAllPagination');
        $router->post('/', 'LanguagesTrashController@getFilterPagination');
        $router->get('list', 'LanguagesTrashController@getAll');
        $router->post('list', 'LanguagesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'LanguagesTrashController@getOneId');
        $router->post('one', 'LanguagesTrashController@getOneFilter');

        //Force delete & reLanguage
        $router->delete('delete/{id:[0-9]+}', 'LanguagesTrashController@deleteExsitEntryById');
        $router->post('delete', 'LanguagesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'LanguagesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'LanguagesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'LanguagesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
