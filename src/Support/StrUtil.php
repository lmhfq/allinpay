<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay\Support;


class StrUtil
{

    /**
     * 获取签名字符串
     * 签名字符串为除了sign之外的其他非空字段组成键值对
     * @param array $params
     * @return string
     * @author lmh
     */
    public static function getSignText(array $params): string
    {
        unset($params['sign']);

        ksort($params);

//        $params = array_filter($params, function ($v) {
//            return $v != '';
//        }, ARRAY_FILTER_USE_BOTH);
        return urldecode(http_build_query($params));
    }
}