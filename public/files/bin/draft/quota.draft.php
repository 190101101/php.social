<?php 

	if(User::has() && User::status() == 1 && 
		time_diff(User::user_last_updated(), date('Y-m-d H:i:s'))->days > 0)
	{
		db()->update('user', [
			'user_id' => User::user_id(),
			'user_last_updated' => date('Y-m-d H:i:s'),
			'user_post_quota' => 5,
			'user_comment_quota' => 5,
		], ['id' => 'user_id']);

	    User::update([
	    	'user_post_quota' => 5,
			'user_comment_quota' => 5,
	    	'user_last_updated' => date('Y-m-d H:i:s')
	    ]);
	}

