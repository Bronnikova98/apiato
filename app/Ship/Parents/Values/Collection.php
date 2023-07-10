<?php


namespace App\Ship\Parents\Values;


use App\Ship\Parents\Models\Model;
use Illuminate\Contracts\Support\Arrayable;

abstract class Collection extends \Illuminate\Support\Collection
{


    public static function run(Arrayable|array $items)
    {
        foreach ($items as $key => $item) {
            $items[$key] = static::prepareItem($item);
        }
        return new static($items);
    }

    /**
     * @return mixed
     *
     * Функция
     */
    abstract protected static function prepareItem(Model|\stdClass $item): Value;

    /**
     * @return string
     *
     * Тип айтемов
     */
//    abstract protected static function getItemType(): string;

}
