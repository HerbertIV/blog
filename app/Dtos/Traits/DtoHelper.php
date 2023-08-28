<?php

namespace App\Dtos\Traits;

use Illuminate\Support\Str;

trait DtoHelper
{
    protected array $relations = [];
    protected array $files = [];

    protected function setterByData(array $data): void
    {
        foreach ($data as $k => $v) {
            $key = Str::studly($k);
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($v);
            } else {
                $key = lcfirst($key);
                if (array_key_exists($key, get_class_vars(self::class))) {
                    $this->$key = $v;
                }
            }
        }
    }

    protected function getterByAttribute(string $attribute)
    {
        $key = Str::studly($attribute);
        if (method_exists($this, 'get' . $key)) {
            return $this->{'get' . $key}();
        }
        return $this->{lcfirst($key)} ?? false;
    }

    protected function fillInArray(array $fillables): array
    {
        $result = [];
        foreach ($fillables as $fill) {
            $value = $this->getterByAttribute($fill);
            if ($value === false) {
                continue;
            }
            $result[$fill] = $value;
        }
        return $result;
    }

}
