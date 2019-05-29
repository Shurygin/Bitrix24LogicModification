<?php


namespace BitEntity;


class Entity
{
    public static function log($param1=[],$param2=[],$param3=[])
    {
        $date = date('m-d');
        if (!is_dir(__DIR__.'/'.$date))
        {
            mkdir(__DIR__.'/'.$date);
        }
        file_put_contents(__DIR__.'/'.$date.'/log.txt',print_r([$param1,$param2,$param3],1),FILE_APPEND);
    }

    public static function dd($param1=[],$param2=[],$param3=[])
    {
        echo "<pre>";
        echo print_r($param1, 1);
        echo "</pre>";
        echo "<pre>";
        echo print_r($param2, 1);
        echo "</pre>";
        echo "<pre>";
        echo print_r($param3, 1);
        echo "</pre>";
        die;
    }
}