<?php

namespace Modules\Cart\Facade;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static $this put(array $values)
 * @method static $this update($id, mixed $number)
 * @method static bool has(int $productID, int $colorID)
 * @method static array get($id)
 * @method static Collection all()
 * @method static int count()
 * @method static $this delete($id)
 * @method static $this flush()
 * @method static int totalAmount()
 */

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
