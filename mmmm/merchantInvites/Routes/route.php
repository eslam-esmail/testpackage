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
    $router->get('/', 'MerchantInvitesController@getAllPagination');
    $router->post('/', 'MerchantInvitesController@getFilterPagination');
    $router->get('list', 'MerchantInvitesController@getAll');
    $router->post('list', 'MerchantInvitesController@getFilter');
    $router->get('{id:[0-9]+}', 'MerchantInvitesController@getOneId');
    $router->post('one', 'MerchantInvitesController@getOneFilter');
    $router->get('prerequestForm', 'MerchantInvitesController@getPrerequestFormData');

    //Add, update & delete  routes
    $router->post('save', 'MerchantInvitesController@createNewEntry');
    $router->put('update/{id:[0-9]+}', 'MerchantInvitesController@updateExsitEntryById');
    $router->post('update', 'MerchantInvitesController@updateExsitEntryByFilter');
    $router->delete('delete/{id:[0-9]+}', 'MerchantInvitesController@deleteExsitEntryById');
    $router->post('delete', 'MerchantInvitesController@deleteExsitEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}', 'MerchantInvitesController@updateStatusForEntryByFilter');
    $router->post('{newStatus:\bpublish|unpublish\b}/{id:[0-9]+}', 'MerchantInvitesController@updateStatusForEntryById');

    // Trash system
    $router->group([
        'prefix' => 'trash'
            ], function () use($router) {
        // List routes
        $router->get('/', 'MerchantInvitesTrashController@getAllPagination');
        $router->post('/', 'MerchantInvitesTrashController@getFilterPagination');
        $router->get('list', 'MerchantInvitesTrashController@getAll');
        $router->post('list', 'MerchantInvitesTrashController@getFilter');
        $router->get('{id:[0-9]+}', 'MerchantInvitesTrashController@getOneId');
        $router->post('one', 'MerchantInvitesTrashController@getOneFilter');

        //Force delete & reMerchantInvite
        $router->delete('delete/{id:[0-9]+}', 'MerchantInvitesTrashController@deleteExsitEntryById');
        $router->post('delete', 'MerchantInvitesTrashController@deleteExsitEntryByFilter');
        $router->post('deleteAll', 'MerchantInvitesTrashController@deleteExsitEntryByFilter');
        $router->get('restore/{id:[0-9]+}', 'MerchantInvitesTrashController@restoreDeletedEntryById');
        $router->post('restore/one', 'MerchantInvitesTrashController@restoreDeletedEntryByFilter');
    });

    //Other routes needed 
});
