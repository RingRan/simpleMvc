<?php
/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package vendor\base
 * @author   Ran Ping <ranping@gutou.com>
 * @license  http://www.epet.com.cn/
 * @link     http://www.epet.com.cn/
 */

namespace vendor\base;

use vendor\db\Sql;

class Model extends Sql
{
    protected $model;

    public function __construct()
    {
        // 获取数据库表名
        if (!$this->table) {

            // 获取模型类名称
            $this->model = get_class($this);

            // 删除类名最后的 Model 字符
            $this->model = substr($this->model, 0, -5);

            // 数据库表名与类名一致
            $this->table = strtolower($this->model);
        }
    }
}