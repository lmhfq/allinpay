<?php
declare(strict_types=1);


namespace Lmh\AllinPay\Support;

use Lmh\AllinPay\Provider\ConfigServiceProvider;
use Pimple\Container;

class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $userConfig = [];
    /**
     * @var array
     */
    protected $providers = [];


    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($prepends);

        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders(): array
    {
        return array_merge([
            ConfigServiceProvider::class,
        ], $this->providers);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $base = [
            'http' => [
                'timeout' => 60.0,
                'base_uri' => 'https://vsp.allinpay.com/apiweb/unitorder/pay',
            ],
            'debug' => false,
            'log' => [
                'name' => 'allinpay',
                'path' => '/tmp/allinpay.log',
                'level' => 'debug',
            ],
            'appid' => '',
            'keystoreFilename' => '',
            'keystorePassword' => '',
            'keyContent' => '',
            'certificateFilename' => '',
            'certContent' => '',
            'platformCertContent' => '',
        ];
        return array_replace_recursive($base, $this->userConfig);
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}