<?php 

namespace modulus\admin\panel\model;
use core\model;

class PanelModel extends model
{
	public function UserCount()
	{
		return $this->db->t1count('user', 'user_id > 0', [])->count;
	}

	public function GuestCount()
	{
		return $this->db->t1count('guest', 'guest_id > 0', [])->count;
	}

	public function ArticleCount()
	{
		return $this->db->t1count('article', 'article_id > 0', [])->count;
	}

	public function CommentCount()
	{
		return $this->db->t1count('comment', 'comment_id > 0', [])->count;
	}

	public function ContactCount()
	{
		return $this->db->t1count('contact', 'contact_id > 0', [])->count;
	}

	public function RuleCount()
	{
		return $this->db->t1count('rule', 'rule_id > 0', [])->count;
	}

	public function FaqCount()
	{
		return $this->db->t1count('faq', 'faq_id > 0', [])->count;
	}

	public function SettingCount()
	{
		return $this->db->t1count('setting', 'setting_id > 0', [])->count;
	}
}

