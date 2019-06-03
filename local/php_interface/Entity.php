<?php


namespace BitEntity;


class Entity
{
    public static function log($a='no params')
    {
        $date = date('m-d');
        if (!is_dir(__DIR__.'/'.$date))
        {
            mkdir(__DIR__.'/'.$date);
        }
        $params=func_get_args();
        file_put_contents(__DIR__.'/'.$date.'/log.txt',print_r($params,1),FILE_APPEND);
    }

    public static function dd($a='no params')
    {
        $params=func_get_args();
        echo "<pre>";
        echo print_r($params, 1);
        echo "</pre>";
        die;
    }
}
