<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Models;

use Contao\Model;

/**
 * Class DsLoginClientsModel
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $domain
 * @property string  $name
 * @property integer $popup
 *
 * @method static DsLoginClientsModel|null findById($id, array $opt=array())
 * @method static DsLoginClientsModel|null findByPk($id, array $opt=array())
 * @method static DsLoginClientsModel|null findOneByDomain($val, array $opt=array())
 * @method static Model\Collection|DsLoginClientsModel[]|DsLoginClientsModel|null findBy($col, $val, array $opt=array())
 * @method static Model\Collection|DsLoginClientsModel[]|DsLoginClientsModel|null findAll(array $opt=array())
 */
class DsLoginClientsModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_ds_login_clients';
}