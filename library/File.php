<?php 

namespace library;

class File
{
    private $type, $tmp, $name, $size, $dir, $new_name, $byte, $allow, $error, $errors;
    
    private $image_allow = ['jpg', 'png', 'jpeg', 'gif'];
    
    private $archive_allow = ['zip', 'rar'];
    
    private $image_byte = 1024 * 1024 * 10;

    private $archive_byte = 1024 * 1024 * 1000;

    public function set($file, $mode)
    {
        $this->type = $file[$mode]['type'];
        
        $this->tmp  = $file[$mode]['tmp_name'];
        
        $this->name = $file[$mode]['name'];
        
        $this->size = $file[$mode]['size'];
        
        $this->determinant($mode);

        return $this;
    }

    public function determinant($mode)
    {
        if(preg_match('/image/', $mode) == TRUE)            
        {
            $this->byte = $this->image_byte;
            
            $this->allow = $this->image_allow;

            $this->dir = 'image';
        }
        if(preg_match('/archive/', $mode) == TRUE)
        {
            $this->byte = $this->archive_byte;
            
            $this->allow = $this->archive_allow;

            $this->dir = 'archive';
        }
    }

    public function is_empty($name)
    {
        if(!empty($name) && strlen($name) > 3){
            return $name;
        }
    }

    public function allow()
    {
        $ext = substr(strrchr($this->name,'.'), 1);

        if(in_array($ext, $this->allow) !== false)
        {
            return $this->new_name = uniqid().'.'.$ext;
        }
    }

    public function size($size)
    {
        return $this->byte > $size ?: FALSE;
    }

    public function errors()
    {
        if($this->error != FALSE)
        {
            return $this->errors = 'type_error';
        }

        if($this->allow($this->new_name) === FALSE)
        {
            return $this->errors = 'allow_error';
        }

        if($this->is_empty($this->new_name) == FALSE)
        {
            return $this->errors = 'empty_error';
        }

        if($this->size($this->size) == FALSE)
        {
            return $this->errors = 'size_error';
        }
    }

    public function get()
    {    
        $this->errors();

        if($this->errors == FALSE)
        {
            return [
                
                'status' => TRUE, 
                
                'type'   => $this->type,

                'tmp'    => $this->tmp, 

                'name'   => $this->new_name,
                
                'size'   => $this->size,

                'dir'   => $this->dir,

            ];
        }
        else
        {
            return [
                
                'status' => FALSE, 
                
                'errors' => $this->errors, 
            ];
        }

    }   

    public function move($move = [])
    {
        $file = getcwd()."/files/upload/{$move['dir']}/".$move['name'];
        
        $move = move_uploaded_file($move['tmp'], $file);
        
        return $move == TRUE ? ['status' => TRUE] : ['status' => FALSE];
    }

    public function drop($file)
    {
        $ext = substr(strrchr($file,'.'), 1);

        if(in_array($ext, $this->image_allow) !== false)
        {
            $dir = 'image';
        }
        if(in_array($ext, $this->archive_allow) !== false)
        {
            $dir = 'archive';
        }

        if(!empty($file))
        {
            $file_delete = getcwd()."/files/upload/{$dir}/".$file;

            if(file_exists($file_delete))
            {
               $unlink = unlink($file_delete);
               
               if($unlink == TRUE)
               {
                    return ['status' => TRUE, 'message' => 'файл успешно удален'];

               }else
               {
                    return ['status' => FALSE, 'message' => 'что то пошло не так'];
               }
            }else
            {
                return ['status' => FALSE, 'message' => 'файл не найден'];
            }
        }
    }


}

/*
    $image = (new f)->set($_FILES, 'article_image')->get();
    $move = (new f)->move($image);
*/

/*
    $archive = (new f)->set($_FILES, 'article_archive')->get();
    $move = (new f)->move($archive);
*/

/*
    (new f)->drop('62c9b8f201f4f.jpg');
*/