<?php
declare(strict_types=1);


namespace Lmh\AllinPay\Support;


class SignatureFactory
{
    /**
     * @var AbstractSigner
     */
    private static $signer;

    /**
     * @return AbstractSigner
     */
    public static function getSigner(): ?AbstractSigner
    {
        return self::$signer;
    }

    /**
     * @param mixed $signer
     */
    public static function setSigner(AbstractSigner $signer): void
    {
        self::$signer = $signer;
    }
}