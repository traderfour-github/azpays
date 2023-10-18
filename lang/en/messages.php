<?php

return [
    'respond' => [
        //error messages
        'error'                     => 'Error has been detected.',
        'not_found'                 => 'No resource was found.',
        'wrong_parameter'           => 'Wrong parameter has been detected.',
        'invalid_query'             => 'Invalid query has been detected.',
        'invalid_parameters'        => 'Invalid parameters has been detected.',
        'unauthorized'              => 'Unauthorized action has been detected.',
        'forbidden'                 => 'Forbidden action has been detected.',
        'not_acceptable'            => 'Unacceptable action detected.',
        'access_deny'               => 'Access Denied.',
        // return messages
        'entity_removed'            => 'Entity has been removed successfully.',
        'entity_created'            => 'Entity has been created.',
        'successful_message'        => 'Response successfully returned.',
        'successful_update_message' => 'The data has been successfully updated.',
        'successful_created_message'=> 'The data has been successfully created.',
        'successful_delete_message' => 'The data has been successfully deleted.',
        // authentication
        'login_successfully'        => 'User logged in successfully.',
        'wrong_purse_access'        => 'You can not access this purse',
        'duplicate_request'        => 'Your request is duplicate',
    ],
    'payment' => [
        'wrong_password'            => 'Password is not correct.',
        'payment_already_confirmed' => 'Payment is already confirmed.',
        'gateway_not_found'         => 'Gateway not found.',
    ],
];
