<?php 

function db()
{
    return new library\triangle();
}

function ee()
{
	echo '<body style="background: #14171a !important; color: #e84118 !important;">';
	echo '<div class="dd_class"><pre>'; print_r('exit'); echo '</pre></div></body>';
	exit;
}

function dd($data)
{
	echo '<div class="dd_class"><pre>'; print_r($data); echo '<pre></div>';
}

function ddx($data)
{	
	echo '<body style="background: #14171a !important; color: #e84118 !important;">';
	echo '<div class="dd_class"><pre>'; print_r($data); echo '<pre></div></body>';
	exit;
}

function qq($data)
{
	echo '<div class="dd_class"><pre>'; var_dump($data); echo '<pre></div>';
}

function qqx($data)
{
	echo '<body style="background: #14171a !important; color: #e84118 !important;">';
	echo '<div class="dd_class"><pre>'; var_dump($data); echo '<pre></div></body>';
	exit;
}

function bcrypt_encode($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function bcrypt_decode($password, $hash)
{
    return password_verify($password, $hash);

    #$password = bcrypt_encode('password');
    #echo bcrypt_decode('password', $password);
}

/*encode decode*/
function token_code()
{
	return md5(md5(ssl_encode(uniqid())));
}

function ssl_encode($p1)
{
	return openssl_encrypt($p1, "AES-128-ECB", ENCRYPT);
}

function ssl_decode($p1)
{
	return openssl_decrypt($p1, "AES-128-ECB", ENCRYPT);
}

function ssl_encode_each_keys($p1)
{
	$return = [];
	foreach($p1 as $p2 => $p3)
		$return += [
            openssl_encrypt($p2, "AES-128-ECB", ENCRYPT) 
                => 
            openssl_encrypt($p3, "AES-128-ECB", ENCRYPT)
        ];
	return $return;
}

function ssl_decode_each_keys($p1)
{
    $return = [];
    foreach($p1 as $p2 => $p3)
        $return += [
            openssl_decrypt($p2, "AES-128-ECB", ENCRYPT) 
                => 
            openssl_decrypt($p3, "AES-128-ECB", ENCRYPT)
        ];
    return $return;
}


function base64_ssl_encode($url)
{
	return base64_encode(ssl_encode($url));
}

function base64_ssl_decode($url)
{
	return ssl_decode(base64_decode($url));
}

/*encode decode*/


/*math*/
function byte($size){
    $metrics[0] = 'byte';
    $metrics[1] = 'KB';
    $metrics[2] = 'MB';
    $metrics[3] = 'GB';
    $metrics[4] = 'TB';
    $metric = 0;         
    while(floor($size/1024) > 0){
         ++$metric;
         $size /= 1024;
     }        
     $ret =  round($size,1)." ".(isset($metrics[$metric])?$metrics[$metric]:'??');
    return $ret;
}

function percent( $number, $everything, $decimals = 2 )
{
  return round( $number / $everything * 100, $decimals );
}

function memory()
{
  return memory_get_usage();
}

/*math*/


/*clean*/
function peel_tag_array($p1 = [])
{
    foreach($p1 as $p2 => $p3){
        $p1[$p2] = remove_tags($p3);
    }
    return $p1;
}

function remove_tags($p1)
{
    $p1 = strip_tags($p1);
    $p1 = htmlspecialchars($p1);
    $p1 = htmlentities($p1);
    $p1 = html_entity_decode($p1);
    $p1 = rtrim($p1);
    return $p1;
}

function xss($p1)
{
	$p1 = str_replace(")","",$p1);
	$p1 = str_replace("(","",$p1);
	$p1 = str_replace("'","",$p1);
	$p1 = str_replace(";","",$p1);
	$p1 = str_replace('"',"",$p1);
	$p1 = str_replace("iframe","",$p1);
	$p1 = str_replace("eval","",$p1);
	$p1 = str_replace("refresh","",$p1);
	$p1 = str_replace("style","",$p1);
	$p1 = str_replace("script","",$p1);
	$p1 = str_replace("<alert>","",$p1);
	$p1 = str_replace("<script>","",$p1);
	$p1 = str_replace("<script","",$p1);
	$p1 = str_replace("</script","",$p1);
	$p1 = str_replace("/script","",$p1);
	$p1 = str_replace("<?","",$p1);
	$p1 = str_replace("?>","",$p1);
	$p1 = str_replace("SELECT *","",$p1); 
	$p1 = str_replace("DELETE FROM","",$p1); 
	return $p1;
}
/*clean*/

/*check*/
function is_not_empty($p1)
{
	return $p1 != '' || $p1 != null || $p1 != false || !empty($p1);
}

function is_empty($p1)
{
	return $p1 == '' || $p1 == null || $p1 == false || empty($p1);
}

function return_stripos($p1, $p2)
{
    if(stripos($p1, $p2) !== FALSE) 
    {
        return TRUE;
    } 
}

/*check*/

/*time*/
function date_dy($date, $seperator = '/')
{
	$explode = explode(' ', $date);
	$ymd     = $explode[0];
	$his     = $explode[1];

	$his = explode(':', $his);
	$his = $his[0].':'.$his[1];

	$ymd = explode('-', $ymd);
	$ymd = array_reverse($ymd);
	$ymd = $ymd[0].'-'.$ymd[1].'-'.substr($ymd[2], -2);

	$date = $his.' '.$seperator.' '.$ymd;
	return $date;
}

function date_ymd($date)
{
	$explode = explode(' ', $date);
	$ymd     = $explode[0];
	$his     = $explode[1];

	$his = explode(':', $his);
	$his = $his[0].':'.$his[1];

	$ymd = explode('-', $ymd);
	$ymd = array_reverse($ymd);
	$ymd = $ymd[0].'.'.$ymd[1].'.'.substr($ymd[2], -2);

	$date = $ymd;
	return $date;
}
/*time*/

function breadcump_form_panel($url = "/post/search/title")
{
	echo '<ol class="breadcrumb d-flex justify-content-between">';
    echo '<div class="d-flex">';
	$uri = explode('/', $url ?? $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    for($i = 0; $i < count($uri)-1; $i++){
        echo "<li class='breadcrumb-item'>{$uri[$i]}</li>";
    }
    echo "<li class='breadcrumb-item active'>{$uri[$i]}</li>";
    echo '</div>';
    echo '<div class="text-success d-flex">';
    echo '<form action="'.$url.'">
          <div class="input-group">
            <input type="text" class="form-control" name="search_field" minlength="2" maxlength="20"
              placeholder="Search for..."
            >
            <span class="input-group-btn">
                <button class="btn btn-secondary ml-1" type="submmit">Go!</button>
            </span>
          </div>
        </form>';
    echo '</div>';
    echo '</ol>';
}

function breadcump_form($url = "/post/search/title")
{
    echo '<ol class="breadcrumb d-flex justify-content-between">';
    echo '<div class="d-flex">';
    $uri = explode('/', $url ?? $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    for($i = 0; $i < count($uri)-1; $i++){
        echo "<li class='breadcrumb-item'>{$uri[$i]}</li>";
    }
    echo "<li class='breadcrumb-item active'>{$uri[$i]}</li>";
    echo '</div>';
    echo '<div class="text-success d-flex">';
    echo '<form action="'.$url.'">
          <div class="input-group">
            <input type="text" class="form-control" name="post_title" minlength="2" maxlength="20"
              placeholder="Search for..."
            >
            <span class="input-group-btn">
                <button class="btn btn-secondary ml-1" type="submmit">Go!</button>
            </span>
          </div>
        </form>';
    echo '</div>';
    echo '</ol>';
}

function breadcump($url = null)
{
    echo '<ol class="breadcrumb d-flex justify-content-between">';
    echo '<div class="d-flex">';
    $uri = explode('/', $url ?? $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    for($i = 0; $i < count($uri)-1; $i++){
        echo "<li class='breadcrumb-item'>{$uri[$i]}</li>";
    }
    echo "<li class='breadcrumb-item active'>{$uri[$i]}</li>";
    echo '</div>';
    echo '<div class="text-success d-flex">';
    echo "online: ". Guest::online()->guest_count;
    echo '</div>';
    echo '</ol>';
}

/*array*/

#unique_multi_array
function unique_multi_array($array, $key) { 
    $temp_array = []; 
    $i = 0; 
    $key_array = []; 

    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
}

#удаляет ключ с значением из массива;
function array_duplicate(array $array)
{
    return array_diff_assoc($array, array_unique($array));
}

function except($array, $keys) {
    return array_diff_key($array, array_flip((array) $keys));   
} 

function array_except($array, $keys) {
    return array_diff_key($array, array_flip((array) array_keys($keys)));
} 

function array_except_keys($array, $keys) {
    return array_diff_key(array_keys($array), array_flip((array) array_keys($keys)));
} 

function key_compare($a, $b)
{
    if ($a === $b) {
        return 0;
    } return ($a > $b) ? 1 : -1;
}

function exclude($array, $keys) {
    return array_diff_key((array) $array, array_flip((array) $keys));   
} 

function compare_array_keys($p1, $p2)
{
    return array_diff_uassoc(array_keys($p1), $p2, "key_compare");
}

function compare_array($p1, $p2)
{
    return array_diff_uassoc($p1, $p2, "key_compare");
}

#если тру ошибка // $array1 = ['user_token'], $array2 = $_POST
function array_different($array1, $array2)
{
    return array_diff($array1, array_keys($array2)) != TRUE ?: FALSE;
}

function getIn($data, $by)
{
    $return = [];
    foreach($data as $key){
        $return[] = $key[$by];
    }
    return $return;
}

function getInById($data, $by, $id)
{
    $return = [];
    foreach($data as $key){
        $return[$key[$id]] = $key[$by];
    }
    return $return;
}


function file_in_array($file, $path)
{
    if(in_array($file, scan($path)))
    {
        return TRUE;
    }
}

# sort_by_arg($arr, 'rank', SORT_DESC)
function sort_by_arg($arr, $arg, $by = SORT_ASC)
{
    array_multisort(array_column($arr, $arg), $by, $arr);
    return $arr;
}

function array_implode($array, $separator)
{
    return implode($separator, $array);
}

#возврат кроме некодированного
function return_other_than_uncoded($array){
    return array_except($array, return_uncoded_value(array_keys($array)));
}

#возврат кроме кодированного
function return_other_than_encoded($array){
    return array_except($array, return_encoded_value(array_keys($array)));
}

#декодировать закодированное ключи
function decode_encoded_keys($array)
{
    return ssl_decode_array_keys(return_uncoded_value($array));
}

#декодировать закодированный массив
function decode_encoded_array($array)
{
    return ssl_decode_array(return_encoded_value($array));
}

#исключает закодированные ключи
function excludes_encoded_keys($array, $except){
    return array_except($array, array_keys($except));
}

#массив каторый кейси кодировались а значение не кодировались и исключает полученный ключ
function array_except_encoded($array, $except){
    return excludes_encoded_keys($_POST, return_uncoded_value($except));
}

function return_each_char_in_array($p1)
{
    $return = [];
    foreach($p1 as $keys => $values)
        $return[$keys] = xss($values);
    return $return;
}

#возврат кроме некодированного
function return_uncoded_value($p1)
{
    return array_filter($p1, function($p3){
        return is_empty(ssl_decode($p3));
    });
}

#возврат кроме закодированного
function return_encoded_value($p1)
{
    return array_filter($p1, function($p3){
        return is_not_empty(ssl_decode($p3));
    });
}

#после энкоде проверяет все ключи и значения
function return_array_after_ssl_decode($p1)
{
    $keys = array_values(array_map(function ($item) {
        return ssl_decode($item);
    }, array_keys($p1)));

    $values = array_values(array_map(function ($item) {
        return ssl_decode($item);
    }, array_values($p1)));

    $array_merge = array_merge($keys, $values);
    return array_filter($array_merge, function($item){
        return is_empty($item);
    });
}

function ssl_decode_array($p1)
{
    $keys = array_values(array_map(function ($item) {
        return ssl_decode($item, "AES-128-ECB", "password");
    }, array_keys($p1)));

    $values = array_values(array_map(function ($item) {
        return ssl_decode($item, "AES-128-ECB", "password");
    }, array_values($p1)));
        
    return array_combine($keys, $values);
}

function ssl_decode_array_keys($p1)
{
    $keys = array_values(array_map(function ($item) {
        return ssl_decode($item);
    }, array_keys($p1)));

    $values = array_values(array_map(function ($item) {
        return $item;
    }, array_values($p1)));

    return array_combine($keys, $values);
}

function ssl_decode_array_values($p1)
{
    $keys = array_values(array_map(function ($item) {
        return $item;
    }, array_keys($p1)));

    $values = array_values(array_map(function ($item) {
        return ssl_decode($item);
    }, array_values($p1)));

    return array_combine($keys, $values);
}
/*array*/

/*http*/
function segment($segment = false)
{
  $explode = explode('/', $_SERVER['REQUEST_URI']);
  return $segment == true ? $explode[$segment] : $explode;
}

function breadcump_search()
{
    $explode = explode('page', $_SERVER['REQUEST_URI']);
    return substr($explode[0], + 1);
}

function HOST_REFERER()
{
    return $_SERVER['HTTP_HOST'].DV.$_REQUEST['page'];
}

function REFERER()
{
    return isset($_SERVER['HTTP_REFERER'])
        ? $_SERVER['HTTP_REFERER']
        : FALSE;
}

function HTTP_REFERER()
{
    header("location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

function REQUEST()
{
    return $_SERVER['REQUEST_URI'];
}

function HOST()
{
    return $_SERVER['HTTP_HOST'];
}

function REFRESH($seconds = 2)
{
    header("Refresh: $seconds; /");
}

function REDIRECT($url = false, $exit = true)
{
    header('location: /'.$url);
    $exit == false ?: exit;
}

function HTTP($url = false, $exit = true)
{
    header('location: '.$url);
    $exit == false ?: exit;
}

function HTTP_REQUEST($url)
{
    header('location: '.$url);
}

function HTTP_COOKIE()
{
    return $_SERVER['HTTP_COOKIE'];
}

function REMOTE_RAND() 
{
    return 
    rand(100,999).'.'.
    rand(100,999).'.'.
    rand(100,999).'.'.
    rand(100,999);
}

function REMOTE_ADDR() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return trim($ipaddress);
}

function isXmlHttpRequest($redirect = 'home')
{
    $header = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
    ($header === 'XMLHttpRequest') == 1 ?: REDIRECT($redirect, 1);
}

function request_uri()
{
    $server = $_SERVER['REQUEST_URI'];
    $server = explode('/', $server);
    array_shift($server);
    $return = false;

    for($i = 0; $i < count($server); $i++)
        $return .= $server[$i].' ';
    return $return;
}

function exploder($delimiter, $data)
{
    $explode = explode($delimiter, $data); 
    array_shift($explode);
    return $explode;
}

function replace_str($find, $delimiter, $text){
    return str_replace($find, $delimiter, $text);
}

##
function setGlobal($p1, $p2){
    $GLOBALS[$p1] = $p2;
}

function getGlobal($p1){
    return isset($GLOBALS[$p1]) ? $GLOBALS[$p1] : FALSE;
}

function has_notice(){
    echo '<a href="/notification/list" class="mr-1">';
    if(notification()){
        echo '<img src="files/system/svg/greenbell.svg" width="15">';        
    }else{
        echo '<img src="files/system/svg/bell.svg" width="15">';
    }
    echo '</a>';
}

function time_diff($p1, $p2)
{
    #date_create('0000-00-00');
    $start = new DateTime($p1);
    $end = new DateTime($p2);
    return $start->diff($end);
}

function getDatesFromRange($start, $end, $format = 'Y-m-d') 
{
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format);
    }
  
    // Return the array elements
    return $array;

    // Function call with passing the start date and end date
    // $Date = getDatesFromRange('2002-06-06', '2022-12-09');
    // dd($Date);
}
  
function css_mode(){
    if(library\cookie::read('css_mode') == 1 || 
        library\cookie::read('css_mode') == NULL){
        return (object)['css_mode' => 'light', 'code' => 1];
    }
    else {
        return (object)['css_mode' => 'dark', 'code' => 2];
    }
}


/*---*/
function panel_breadcrumb($data, $url)
{
    $breadcump_item = false;

    $uri = explode('/', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

    for($i = 0; $i < count($uri)-1; $i++):
        $breadcump_item .= 
        <<<HTML
            <li class='breadcrumb-item'>{$uri[$i]}</li>
        HTML;
    endfor;

    $option = false;

    foreach($data as $key):
        $option .= 
        <<<HTML
            <option value="$key">$key</option>
        HTML;
    endforeach;

    echo 
    <<<HTML
        <ol class="breadcrumb d-flex justify-content-between">
            <div class="d-flex">
                $breadcump_item
            </div>
            <div class="text-success d-flex">
                <form action="$url">
                  <div class="input-group">
                    <select class="form-control form-control-sm mr-1" name="field_key">
                        $option           
                    </select>
                    <input type="text" class="form-control form-control-sm mr-1" name="field_value" minlength="1" maxlength="20"
                      placeholder="Search for..."
                    >
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-secondary" type="submmit">Go!</button>
                    </span>
                  </div>
              </form>
            </div>
        </ol>
    HTML;
}
