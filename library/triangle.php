<?php 

namespace library;

use PDOStatement;

use Exception;

use PDO;

use library\helper;

class triangle
{
    public $db;

    private $lazy   = PDO::FETCH_LAZY;
    
    private $unique = PDO::FETCH_UNIQUE;
    
    private $group = PDO::FETCH_GROUP;
    
    private $obj    = PDO::FETCH_OBJ;
    
    private $assoc  = PDO::FETCH_ASSOC;
    
    private $column = PDO::FETCH_COLUMN;

    private $helper;
    
    public function __construct()
    {
        $pdo = sprintf("mysql:host=%s;dbname=%s;charset=utf8", DBHOST, DBNAME);

        $this->db = new PDO($pdo, DBUSER, DBPASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        ]);

        $this->helper = new helper;
    }

    private function return($stmt, $mode = 0)
    {
        return $stmt->rowCount() > 0 
        
            ? ['status' => TRUE, 'id' => $mode == 1 ? $this->db->lastInsertId() : NULL]

            : ['status' => FALSE];
    }

    private function fetch($stmt, $mode = 0, $fetch = 0)
    {
        if($mode == 0 && $fetch == 0)
        {
            return $stmt->fetch($this->obj);

        } else if($mode == 1 && $fetch == 0)
        {
            return $stmt->fetch($this->assoc);

        } else if($mode == 0 && $fetch == 1)
        {
            return $stmt->fetch($this->lazy);  
     
        } else if($mode == 1 && $fetch == 1)
        {
            return $stmt->fetchColumn();  

        } else if($mode == 2 && $fetch == 0)
        {
            return $stmt->fetchAll($this->obj);

        } else if($mode == 2 && $fetch == 1)
        {
            return $stmt->fetchAll($this->assoc);

        } else if($mode == 2 && $fetch == 2)
        {
            return $stmt;
        }
        else if($mode == 2 && $fetch == 3)
        {
            return $stmt->fetchAll($this->unique);
        }
    }

    public function trans()
    {
        return $this->db->beginTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function back()
    {
        return $this->db->rollBack();
    }

    #$db->columns('token')
    public function columns($t1)
    {
        return $this->db->query("SHOW COLUMNS FROM {$t1}")->fetchAll($this->column);
    }

    public function sql($sql, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->query($sql);
        return $this->fetch($stmt, $mode, $fetch);
    }
    
    #$db->tsql('SELECT * FROM article WHERE article_id = ?', [10]);
    public function tsql($sql, $values = [], $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t1('code', 2, 1);
    public function t1($t1, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->query("SELECT * FROM $t1");
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$this->db->t1where('image', 'image_id < ?', [$blog->blog_id]);
    #$this->db->t1where('image', "image_name LIKE ?", ["%$variable%"]);
    #$this->db->t1where('image', 'image_id < ?', [$blog->blog_id], false, false, ['user_id']);
    public function t1where($t1, $keys, $values = [], $mode = 0, $fetch = 0, $excepts = [])
    {
        $stmt = $this->db->prepare(!$excepts ? "SELECT * FROM $t1 WHERE $keys"
            : "SELECT {$this->helper->comma_separated($excepts)} FROM $t1 WHERE $keys");

        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t1wherein('code', 'id', $data, 2);
    public function t1wherein($t1, $keys, $values, $mode = 0, $fetch = 0, $sql = FALSE)
    {
        $stmt = $this->db->prepare("SELECT * FROM $t1 WHERE $keys 
            IN ({$this->helper->question_mark($values)}) $sql");
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }
    
    #$this->db->t1count('image', 'image_id < ?', [$blog->blog_id]);
    public function t1count($t1, $keys, $values = [], $mode = 0, $fetch= 0)
    {
        $stmt = $this->db->prepare("SELECT COUNT({$t1}_id) as count FROM $t1 WHERE $keys");
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t2('article', 'category', 2);
    public function t2($t1, $t2, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->query("SELECT $t2.*, $t1.* FROM $t1
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id
        "); return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t2where('article', 'category', 'article_id = ? and category.category_id = ?', ['10', '11']);
    public function t2where($t1, $t2, $keys, $values = [], $mode = 0, $fetch = 0, $excepts = [])
    {
        $stmt = $this->db->prepare(!$excepts ? "SELECT $t2.*, $t1.* FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id WHERE $keys" 
            : "SELECT {$this->helper->comma_separated($excepts)} FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id WHERE $keys");
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$this->db->t1count('image', 'image_id < ?', [$blog->blog_id]);
    public function t2count($t1, $t2, $keys, $values = [], $mode = 0, $fetch= 0)
    {
        $stmt = $this->db->prepare("SELECT COUNT({$t1}_id) as count FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id WHERE $keys");
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t3('article', 'category', 'section', 2);
    public function t3($t1, $t2, $t3, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->query("SELECT $t3.*, $t2.*, $t1.* FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id
            INNER JOIN $t3 ON $t2.{$t3}_id = $t3.{$t3}_id
        "); return $this->fetch($stmt, $mode, $fetch);
    }

    #$db->t3where('article', 'category', 'section', 'article_id = ? and category = ? AND section = ?', ['10', 'psd', 'freebies']);
    public function t3where($t1, $t2, $t3, $keys, $values, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->prepare("SELECT $t3.*, $t2.*, $t1.* FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id
            INNER JOIN $t3 ON $t2.{$t3}_id = $t3.{$t3}_id
            WHERE $keys
        "); $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }
    
    public function t3wherein($t1, $t2, $t3, $keys, $values, $mode = 0, $fetch = 0)
    {
        $stmt = $this->db->prepare("SELECT $t3.*, $t2.*, $t1.* FROM $t1 
            INNER JOIN $t2 ON $t1.{$t2}_id = $t2.{$t2}_id
            INNER JOIN $t3 ON $t2.{$t3}_id = $t3.{$t3}_id
            WHERE $keys IN ({$this->helper->question_mark($values)})
        "); $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }
    
    #$this->db->create('article', $data);
    public function create($t1, $values, $mode = false)
    {   
        try {   
            
            $stmt = $this->db->prepare("INSERT INTO $t1 SET {$this->helper->keys($values)}");
            
            $stmt->execute(array_values($values));

            return $this->return($stmt, $mode);

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];

        }
    }
    /*qqq*/
    // $this->db->update('user', $data, ['id' => 'user_id']);
    /* $this->db->update('article', ['article.category_id' => 4, 'category_id' => 1, ], ['id' => 'category_id', 'p2' => 'category_id']); */
    public function update($t1, $values, $p1 = [])
    {
        try {

            $id = $values[$p1['id']];

            if(isset($p1['p2'])){
                $p2 = $values[$p1['p2']];
                unset($values[$p1['p2']]);
            }

            unset($values[$p1['id']]);
            
            $execute = $values;
            
            $execute += [$p1['id'] => $id];
    
            if(isset($p1['p2'])){
                $execute += [$p1['p2'] => $p2];
            }

            $stmt = $this->db->prepare("UPDATE $t1 SET {$this->helper->keys($values)} WHERE {$p1['id']}=?");
            $stmt->execute(array_values($execute));

            return $this->return($stmt);

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    #$this->db->increment('post', 'post_hit', 18, 2);
    public function increment($t1, $p1, $id, $p2 = 1)
    {
        try {
            $stmt = $this->db->query("UPDATE $t1 SET $p1 = $p1 + $p2 WHERE {$t1}_id={$id}");

            return $this->return($stmt);

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    #$this->db->increment('post', 'post_hit', 18, 2);
    public function decrement($t1, $p1, $id, $p2 = 1)
    {
        try {
            $stmt = $this->db->query("UPDATE $t1 SET $p1 = $p1 - $p2 WHERE {$t1}_id={$id}");

            return $this->return($stmt);

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }


    #$this->db->delete('sms', ['sms_recipient' => '994519467158'], ['id' => 'sms_recipient']);
    public function delete($t1, $values = [], $p1 = [])
    {
        try {
            
            $id = $values[$p1['id']];
            
            unset($values[$p1['id']]);
            
            $execute = $values;
            
            $execute += [$p1['id'] => $id];

            $stmt = $this->db->prepare("DELETE FROM $t1 WHERE {$p1['id']}=?");

            $stmt->execute(array_values($execute));

            return $this->return($stmt);

        } catch (Exception $e) {

            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public function deletein($t1, $keys, $values)
    {
        try{
            $stmt = $this->db->prepare("DELETE FROM $t1 WHERE $keys IN 
                ({$this->helper->question_mark($values)})");
            $stmt->execute(array_values($values));
            return $this->return($stmt);
        } catch (Exception $e) {
            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public function drop($t1)
    {
        try {   
            $stmt = $this->db->query("DELETE FROM $t1");
            return $this->return($stmt);
        } catch (Exception $e) {
            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public function store($t1, $keys = [], $values = [])
    {   
        try {   

            $query = "INSERT INTO $t1 ({$this->helper->keystore($keys)}) VALUES ";

            $valuequery = false;

            foreach($values as $value){
                $valuequery .= "({$this->helper->valuestore($value)}),";
            }

            $query .= substr($valuequery, 0, -1) . ';';

            $stmt = $this->db->query($query);

            return $this->return($stmt);

        } catch (Exception $e) {
            return ['status' => FALSE, 'error' => $e->getMessage()];
        }
    }

    public function __destruct(){
        $this->db = null;
    }

    #$this->db->p3where('article', 'user', 'category', 'article_id=?', [1], 0, 0, ['article.*']);
    public function p3where($t1, $t2, $t3, $keys, $values, $mode = 0, $fetch = 0, $excepts = [])
    {
        $sql = !$excepts 
            ? "$t3.*, $t2.*, $t1.*" 
            : "{$this->helper->comma_separated($excepts)}";

        $stmt = $this->db->prepare("SELECT {$sql} FROM $t1 
            INNER JOIN $t2 ON $t2.{$t2}_id = $t1.{$t2}_id
            INNER JOIN $t3 ON $t3.{$t3}_id = $t1.{$t3}_id
            WHERE $keys"); 
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }

    // $this->db->p3count('article', 'user', 'category', 'article_status=1', []);
    public function p3count($t1, $t2, $t3, $keys, $values = [], $mode = 0, $fetch= 0)
    {
        $stmt = $this->db->prepare("SELECT COUNT({$t1}_id) as count FROM $t1 
            INNER JOIN $t2 ON $t2.{$t2}_id = $t1.{$t2}_id
            INNER JOIN $t3 ON $t3.{$t3}_id = $t1.{$t3}_id
            WHERE $keys");
        $stmt->execute(array_values($values));
        return $this->fetch($stmt, $mode, $fetch);
    }
}
