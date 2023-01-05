<?php 

namespace middleware;
use Setting;

class Page
{
	public static function handle($next)
	{
		if(segment(2) == 'about' && Setting::about_page_status() == 0
			|| segment(2) == 'faq' && Setting::faq_page_status() == 0
				|| segment(2) == 'rule' && Setting::rule_page_status() == 0)
		{
			REDIRECT();
		}

		return $next;
	}
}

