<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class ArrayHelper
{
    public static function arrayToObject(array $array)
    {
        return json_decode(json_encode($array, JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);
    }

    public static function prepareCollectionToSelect2(Collection $collection): array
    {
        return $collection->mapWithKeys(function ($element) {
            return [
                $element->getKey() => [
                    'id' => $element->getKey(),
                    'name' => $element->name,
                ],
            ];
        })->toArray();
    }

    public static function prepareArrayToSelect2(array $array, bool $theSameKey = false): array
    {
        $result = [];
        foreach ($array as $k => $value) {
            $result[] = [
                'id' => $theSameKey ? $value : $k,
                'name' => $value,
            ];
        }

        return $result;
    }
}

