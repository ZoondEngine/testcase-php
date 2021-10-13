<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Throwable;

class CamelCaseAccessModel extends Model
{
    /**
     * @param string $key
     * @return mixed|void
     * @throws Throwable
     */
    public function __get($key)
    {
        $prop = implode('_', $this->splitCamelCaseProperty($key));

        return $this[$prop];
    }

    /**
     * @param string $key
     * @param mixed $value
     * @throws Throwable
     */
    public function __set($key, $value)
    {
        $prop = implode('_', $this->splitCamelCaseProperty($key));

        return $this[$prop] = $value;
    }

    /**
     * @param $prop
     * @return array|false|string[]
     * @throws Throwable
     */
    private function splitCamelCaseProperty($prop) {
        if($prop == ""
            || empty($prop)) {
            throw new \Exception('Property should be a valid for accessing!');
        }

        $result = preg_split('/(?=[A-Z])/', $prop, -1, PREG_SPLIT_NO_EMPTY);

        // If we're can't split it, then its 1 word
        if(!$result) {
            $result = $prop;
        }
        else {
            $temp = [];

            foreach ($result as $key => $value) {
                $temp[$key] = Str::lower($value);
            }

            $result = $temp;
        }

        return $result;
    }
}
