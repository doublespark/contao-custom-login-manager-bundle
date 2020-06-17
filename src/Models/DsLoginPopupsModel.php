<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Models;

use Contao\Model;

/**
 * Class DsLoginPopupsModel
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $singleSRC
 * @property bool    $published
 *
 * @method static DsLoginPopupsModel|null findById($id, array $opt=array())
 * @method static DsLoginPopupsModel|null findByPk($id, array $opt=array())
 * @method static Model\Collection|DsLoginPopupsModel[]|DsLoginPopupsModel|null findBy($col, $val, array $opt=array())
 * @method static Model\Collection|DsLoginPopupsModel[]|DsLoginPopupsModel|null findAll(array $opt=array())
 */
class DsLoginPopupsModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_ds_login_popups';
}