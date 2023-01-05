<?php 

namespace modulus\main\info\model;
use core\model;

class InfoModel extends model
{
    public function RuleCount()
    {
        return $this->db->t1count('rule', 'rule_id > 0', [])->count;
    }    

    public function RuleList($start, $limit)
    {
        return $this->db->t1where('rule', "rule_id > 0
            ORDER BY rule_id ASC LIMIT {$start}, {$limit}", [], 2, 2);
    }

    public function FaqCount()
    {
        return $this->db->t1count('faq', 'faq_id > 0', [])->count;
    }    

    public function FaqList($start, $limit)
    {
        return $this->db->t1where('faq', "faq_id > 0
            ORDER BY faq_id ASC LIMIT {$start}, {$limit}", [], 2, 2);
    }
}

