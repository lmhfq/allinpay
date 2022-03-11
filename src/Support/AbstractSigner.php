<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午2:41
 */

namespace Lmh\AllinPay\Support;


abstract class AbstractSigner
{

    abstract public function sign(string $plainText);

    abstract public function verify(string $plainText, string $signature);
}