<?php

namespace App\Enums;

trait EnumTrait
{
    public static function getValues(): array
    {
        return array_values(static::toArray());
    }

    public static function getKeys(): array
    {
        return array_keys(static::toArray());
    }


    public static function getImplodedValues($separator = ','): string
    {
        return implode($separator, self::getValues());
    }

    public static function toArray(): array
    {
        return array_map(function ($value) {
            return $value->value;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

    public static function toSelectArray(): array
    {
        return array_map(function ($value) {
            return $value->description;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

    public static function toSelectArrayWithKeys(): array
    {
        return array_map(function ($value) {
            return $value->description;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

}
