<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/11
 * Time: 下午1:37
 */

namespace Lmh\AllinPay\Support;


class Md5Signer extends AbstractSigner
{
    private $appKey;

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }


    public function __construct(string $appKey = '')
    {
        $this->appKey = $appKey;
    }


    public function sign(string $plainText): string
    {
        return strtoupper(md5($plainText.'<key>'.$this->appKey.'</key>'));
    }


    public function verify(string $plainText, string $signature)
    {

    }
}