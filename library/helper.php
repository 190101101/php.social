<?php 

namespace library;

class helper
{
    public function keystore($data)
    {
        $values = implode(', ', array_map(function($item){
        
            return '`'. $item . '`';
        
        }, array_values($data)));
        
        return $values;
    }

    public function valuestore($data)
    {
        $values = implode(', ', array_map(function($item){
        
            return "'". $item . "'";
        
        }, array_values($data)));
        
        return $values;
    }

    public function keys($data)
    {
        $values = implode(', ', array_map(function($item){
        
            return $item . '=?';
        
        }, array_keys($data)));
        
        return $values;
    }

    public function values($data)
    {
        
        $values = implode(', ', array_map(function($item){
        
            return $item . '=?';
        
        }, array_values($data)));
        
        return $values;
    }

    public function aimp($data)
    {
        $values = implode(' && ', array_map(function($item){
        
            return $item . '=?';
        
        }, array_keys($data)));
        
        return $values;
    }

    public function comma_separated($data)
    {
        $values = implode(', ', array_map(function($item){
        
            return $item;
        
        }, array_values($data)));
        
        return $values;
    }

    public function question_mark($data)
    {
        $values = implode(', ', array_map(function($item){

            return '?';
        
        }, array_values($data)));
        
        return $values;
    }

    public function getIn($data, $by)
    {
        $return = [];
        foreach($data as $key){
            $return[] = $key[$by];
        }
        return $return;
    }

    public function keyinsert($data)
    {
        $values = implode(', ', array_map(function($item){
        
            return '`'. $item . '`';
        
        }, array_values($data)));
        
        return $values;
    }
}
