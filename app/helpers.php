<?php

if (!function_exists('get_tld')) {
    /**
     * @return string
     */
    function get_tld() : string
    {
        return \substr(\Illuminate\Support\Facades\Request::root(), strrpos(\Illuminate\Support\Facades\Request::root(), '.') + 1);
    }
}

if (!function_exists('route_rel')) {
    /**
     * @param string $name
     * @param array $parameters
     *
     * @return string
     */
    function route_rel(string $name, array $parameters = []) : string
    {
        return \route($name, $parameters, false);
    }
}

if (!function_exists('array_multi_get')) {
    /**
     * @param array $array
     * @param string $key
     *
     * @return array
     */
    function array_multi_get(array $array, string $key) : array
    {
        $result = [];
        foreach ($array as $item) {
            if (\is_array($item)) {
                $result[] = \array_get($item, $key);
            }
        }
        return \array_filter($result);
    }
}
