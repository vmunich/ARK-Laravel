<?php

declare(strict_types=1);

/*
 * This file is part of ARK Laravel.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Lark;

use BrianFaust\Ark\Client;
use BrianFaust\Ark\Config;
use InvalidArgumentException;

class LarkFactory
{
    /**
     * Make a new Ark client.
     *
     * @param array $config
     *
     * @return \BrianFaust\Ark\Client
     */
    public function make(array $config): Client
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['protocol', 'ip', 'port', 'nethash', 'version', 'networkAddress'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['protocol', 'ip', 'port', 'nethash', 'version', 'networkAddress']);
    }

    /**
     * Get the Ark client.
     *
     * @param array $config
     *
     * @return \BrianFaust\Ark\Client
     */
    protected function getClient(array $config): Client
    {
        return new Client(new Config($config['protocol'], $config['ip'], $config['port'], $config['nethash'], $config['version'], $config['networkAddress']));
    }
}
