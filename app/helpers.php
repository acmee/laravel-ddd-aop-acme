<?php

if (!function_exists('get_tld'))
{
    function get_tld()
    {
        return substr(\Illuminate\Support\Facades\Request::root(), strrpos(\Illuminate\Support\Facades\Request::root(), '.') + 1 );
    }
}

if (!function_exists('route_rel'))
{
    function route_rel($name, array $parameters = [])
    {
        return route($name, $parameters, false);
    }
}

if (!function_exists('array_multi_get'))
{
    function array_multi_get(array $array, $key)
    {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result[] = array_get($item, $key);
            }
        }
        return array_filter($result);
    }
}
