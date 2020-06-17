<?php

$GLOBALS['TL_DCA']['tl_ds_login_clients'] = array
(
    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id'     => 'primary',
                'domain' => 'index'
            )
        ),
        'onsubmit_callback' => [
            ['tl_ds_login_clients', 'clearCache']
        ]
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'flag'                    => 6,
            'fields'                  => array('name'),
            'panelLayout'             => 'filter;search,limit',
            'disableGrouping'         => true
        ),
        'label' => array
        (
            'fields'                  => array('name'),
            'format'                  => '%s',
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'copy' => array
            (
                'href'                => 'act=copy',
                'icon'                => 'copy.svg'
            ),
            'delete' => array
            (
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'href'                => 'act=show',
                'icon'                => 'show.svg'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default' => '{details_legend},name,domain,popup;',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'name' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength' => 255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'domain' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'url', 'unique'=>true, 'maxLength' => 255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'popup' => array
        (
            'exclude'                 => true,
            'inputType'               => 'select',
            'foreignKey'              => 'tl_ds_login_popups.name',
            'eval'                    => array('mandatory'=>false, 'includeBlankOption' => true, 'multiple'=>false, 'tl_class'=>'w50 clr'),
            'sql'                     => "int(10) unsigned NOT NULL default 0"
        )
    )
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_ds_login_clients extends Contao\Backend
{
    /**
     * Clears the popup cache
     */
    public function clearCache()
    {
        $cache = \Contao\System::getContainer()->get('doublespark.custom-login-manager.popups-cache');
        $cache->clear();
    }
}