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

namespace BrianFaust\Lark\Facades;

use Illuminate\Support\Facades\Facade;

class Lark extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'lark';
    }
}
