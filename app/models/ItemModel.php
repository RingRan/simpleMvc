<?php
/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @author   Ran Ping <ranping@gutou.com>
 * @license  http://www.epet.com.cn/
 * @link     http://www.epet.com.cn/
 */
namespace app\models;

use vendor\base\Model;
use vendor\db\Db;

/**
 * 用户Model
 */
class ItemModel extends Model
{
    protected $table = 'item';


    public function search($keyword)
    {
        $sql = "select * from `$this->table` where `item_name` like :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$keyword%"]);
        $sth->execute();

        return $sth->fetchAll();
    }
}