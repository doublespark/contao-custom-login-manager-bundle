<?php

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['dsCustomLoginManager'] = [
    'customLoginMessages' => [
        'tables' => ['tl_ds_login_messages']
    ],
    'customLoginPopups' => [
        'tables' => ['tl_ds_login_popups']
    ],
    'customLoginClients' => [
        'tables' => ['tl_ds_login_clients']
    ]
];

/**
 * Define model classes
 */
$GLOBALS['TL_MODELS'] = [
    'tl_ds_login_messages' => 'Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginMessagesModel',
    'tl_ds_login_popups'   => 'Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginPopupsModel',
    'tl_ds_login_clients'  => 'Doublespark\ContaoCustomLoginManagerBundle\Models\DsLoginClientsModel'
];