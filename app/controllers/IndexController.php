<?php
/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @author   Ran Ping <ranping@gutou.com>
 * @license  http://www.epet.com.cn/
 * @link     http://www.epet.com.cn/
 */
namespace app\controllers;

use vendor\base\Controller;
use app\models\ItemModel;

class IndexController extends Controller
{
    // 首页方法，测试框架自定义DB查询
    public function index()
    {
        $this->assign('title', '全部条目');
        $this->assign('keyword', 'index page');
        $this->render();
    }
}