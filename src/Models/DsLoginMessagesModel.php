<?php

namespace Doublespark\ContaoCustomLoginManagerBundle\Models;

use Contao\Database;
use Contao\Date;
use Contao\Model;

/**
 * Class DsLoginMessagesModel
 *
 * @property integer $id
 * @property integer $tstamp
 * @property integer $createdAt
 * @property string  $messageText
 * @property string  $messageAudience
 * @property integer $start
 * @property integer $stop
 * @property bool    $published
 * @property bool    $sticky
 *
 * @method static DsLoginMessagesModel|null findById($id, array $opt=array())
 * @method static DsLoginMessagesModel|null findByPk($id, array $opt=array())
 * @method static DsLoginMessagesModel|null findOneByAlias($val, array $opt=array())
 * @method static Model\Collection|DsLoginMessagesModel[]|DsLoginMessagesModel|null findBy($col, $val, array $opt=array())
 * @method static Model\Collection|DsLoginMessagesModel[]|DsLoginMessagesModel|null findAll(array $opt=array())
 */
class DsLoginMessagesModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_ds_login_messages';

    public static function findPublished($arrOptions=[])
    {
        $t = static::$strTable;

        $time = Date::floorToMinute();

        $arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published=1";

        if (!isset($arrOptions['order']))
        {
            $arrOptions['order'] = "$t.createdAt";
        }

        return static::findBy($arrColumns, $arrOptions);
    }
}