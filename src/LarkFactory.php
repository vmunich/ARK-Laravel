<?php

/*
 * This file is part of Laravel Ark.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Lark;

use InvalidArgumentException;
use BrianFaust\Ark\Client;

class LarkFactory
{
    /**
     * Make a new Lark client.
     *
     * @param array $config
     *
     * @return \BrianFaust\Lark\Lark
     */
    public function make(array $config): Lark
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
        $keys = ['ip', 'port', 'nethash', 'version'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['key']);
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
        return new Client($config['ip'], $config['port'], $config['nethash'], $config['version']);
    }
}
