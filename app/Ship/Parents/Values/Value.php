<?php

namespace App\Ship\Parents\Values;

use Apiato\Core\Abstracts\Values\Value as AbstractValue;
use Illuminate\Support\Str;

abstract class Value extends AbstractValue
{

    public static function run(): static
    {
        $static = new static();
        $static->mount();
        return $static;
    }


    public function toArray(): array
    {
        $result = [];
        $vars = get_object_vars($this);

        foreach ($vars as $name => $value) {
            $result[Str::snake($name)] = $value;
        }
        return $result;
    }

    /**
     * @return string
     */
    public function toJson():string
    {
        return json_encode($this->toArray());
    }

    protected function mount(): void
    {

    }
}
