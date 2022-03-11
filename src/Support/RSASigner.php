<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: lmh <lmh@weiyian.com>
 * Date: 2022/3/7
 * Time: 下午1:36
 */

namespace Lmh\AllinPay\Support;


use Exception;

class RSASigner extends AbstractSigner
{
    /**
     * @var string 商户私钥内容
     */
    private $keyContent;
    /**
     * @var string  商户公钥内容
     */
    private $certContent;
    /**
     * @var string 平台公钥内容
     */
    private $platformCertContent;

    /**
     * RSASigner constructor.
     * @param string $filepath
     * @param string $password
     * @param string $keyContent
     * @param string $certificateFilename
     * @param string $certContent
     * @param string $platformCertContent
     */
    public function __construct(string $filepath = '', string $password = '', string $keyContent = '', string $certificateFilename = '', string $certContent = '', string $platformCertContent = '')
    {
        if ($certContent) {
            $this->certContent = $certContent;
        } else if ($certificateFilename) {
            $this->certContent = file_get_contents($certificateFilename);
        }
        if ($keyContent) {
            $this->keyContent = $keyContent;
        } else if ($filepath) {
            $pkcs12 = file_get_contents($filepath);
            openssl_pkcs12_read($pkcs12, $p12cert, $password);
            $this->keyContent = $p12cert["pkey"];
            $this->certContent = $p12cert['cert'];
        }
        $this->platformCertContent = $platformCertContent;
    }

    /**
     * 生成签名
     * @param string $plainText
     * @param int $algorithm
     * @return string
     * @throws Exception
     */
    public function sign(string $plainText, $algorithm = OPENSSL_ALGO_SHA1): string
    {
        $signature = "";
        if (!$this->keyContent) {
            throw new Exception('签名证书配置错误');
        }
        if (strpos($this->keyContent, '-----') === false) {
            $this->keyContent = "-----BEGIN RSA PRIVATE KEY-----\n" .
                wordwrap($this->keyContent, 64, "\n", true) .
                "\n-----END RSA PRIVATE KEY-----";
        }
        openssl_sign($plainText, $signature, $this->keyContent, $algorithm);
        return base64_encode($signature);
    }


    /**
     * 验证签名
     * @param string $plainText
     * @param string $signature
     * @param int $algorithm
     * @return int
     * @throws Exception
     */
    public function verify(string $plainText, string $signature, $algorithm = OPENSSL_ALGO_SHA1): int
    {
        $signature = base64_decode($signature);
        if (!$this->platformCertContent) {
            throw new Exception('签名证书配置错误');
        }
        if (strpos($this->platformCertContent, '-----') === false) {
            $this->platformCertContent = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($this->platformCertContent, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }
        return openssl_verify($plainText, $signature, $this->platformCertContent, $algorithm);
    }
}