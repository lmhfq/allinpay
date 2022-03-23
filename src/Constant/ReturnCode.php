<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午2:19
 */

namespace Lmh\AllinPay\Constant;


class ReturnCode
{
    /**
     * 交易成功
     */
    public const SUCCESS = '0000';
    /**
     * 该笔订单已入库，请不要重复发送
     */
    public const R1009 = '1009';

}