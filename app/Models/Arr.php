<?php

class Arr
{
    function get($arr, $id_name, $col_name, $id_target)
    {
        foreach ($arr as $a) {
            if ($a[$id_name] == $id_target) {
                return $a[$col_name];
            }
        }
    }

    function group_col($arr, $col)
    {
        $return = [];
        $cek = [];
        foreach ($arr as $a) {
            if (!isset($cek[$a[$col]])) {
                $cek[$a[$col]] = true;
                array_push($return, $a[$col]);
            }
        }
        return $return;
    }

    function group_col_all($arr, $col)
    {
        $return = [];
        $cek = [];
        foreach ($arr as $a) {
            if (!isset($cek[$a[$col]])) {
                $cek[$a[$col]] = true;
                array_push($return, $a);
            }
        }
        return $return;
    }
}
