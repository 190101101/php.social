<?php 

namespace library;

use \Pattern\Creational\Singleton\Singleton;

class message extends Singleton
{
    private $code;
    private $message;
    private $theme;
    private $return;
    private $data;
    private $http;
    private $time = 3;

    public function code($code)
    {
        $this->code = $code;
        return $this;
    }

    public function data($arr = [])
    {
        if($arr != FALSE)
        {
            foreach($arr as $key => $value){
                $this->data[$key] = $value;
            }
        }
        return $this;
    }

    public function time($time)
    {
        $this->time = $time;
        return $this;
    }

    public function redirect($http = false)
    {
        header('location: '.$http);
        exit;
    }

    public function http($http = false)
    {
        header('location: /'.$http);
        exit;
    }

    public function referer()
    {
        header("location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    public function return($message, $message2 = false)
    {
        $message2 .= ' ';
        $return =  require '../tmp/lang/az/response.php';
        $this->message = $message2 . $return->$message;
        return $this;
    }

    public function response($message)
    {
        $this->message = $message;
        return $this;
    }

    public function get()
    {
        $_SESSION['message'] = (object) [
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data,
            'time'    => $this->time,
        ];
        return $this;
    }

    public function json()
    {
        echo json_encode([
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data,
            'time'    => $this->time,
        ]);
        exit;
    }
}

// dd((new message)
//     ->code(404)
//     ->return('success')
//     ->data(['user' => db()->t1('user')])
//     ->data(['guest' => db()->t1('guest')])
//     ->time(5)
// ->json());
