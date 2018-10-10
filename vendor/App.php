<?php
namespace vendor;

/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @author   Ran Ping <ranping@gutou.com>
 * @license  http://www.epet.com.cn/
 * @link     http://www.epet.com.cn/
 */

define('CORE_PATH', __DIR__);

class App
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        $this->setReporting();
        $this->setHandleException();
        $this->setDbConfig();
        $this->route();
    }

    public function setHandleException()
    {
        set_error_handler([$this, 'handError']);
        set_exception_handler([$this, 'handException']);
    }

    public function handError($exception)
    {
        echo 'this is a error page.';
    }

    public function handException($exception)
    {
        echo 'this is a 404 page.';
    }

    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }

    // 路由处理
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        $route = $_GET['r'];

        if ($route) {
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $route);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);

            // 获取控制器名
            $controllerName = ucfirst($urlArray[0]);

            // 获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // 判断控制器和操作是否存在
        $controller = 'app\\controllers\\'. $controllerName . 'Controller';
        if (!class_exists($controller)) {
            throw new \HttpException($controller . ' controller not found.', 404);
        }
        if (!method_exists($controller, $actionName)) {
            throw new \HttpException($controller . ' method not found.', 404);
        }

        // 如果控制器和操作名存在，则实例化控制器，因为控制器对象里面
        // 还会用到控制器名和操作名，所以实例化的时候把他们俩的名称也
        // 传进去。结合Controller基类一起看
        $dispatch = new $controller($controllerName, $actionName);

        // $dispatch保存控制器实例化后的对象，我们就可以调用它的方法，
        // 也可以像方法中传入参数，以下等同于：$dispatch->$actionName($param)
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // 配置数据库信息
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }
}
