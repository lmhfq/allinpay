<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay;


use Illuminate\Support\Str;

/**
 * Class Factory
 * @package Lmh\Payeco
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/07
 * @method static Service\Syb\Application    syb(array $config)
 * @method static Service\Customs\Application    customs(array $config)
 */
class Factory
{

    /**
     * @param string $name
     * @param array $config
     * @return mixed
     * @author lmh
     */
    public static function make(string $name, array $config)
    {
        $namespace = Str::studly($name);
        $application = "\\Lmh\\AllinPay\\Service\\{$namespace}\\Application";
        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return self::make($name, ...$arguments);
    }
}