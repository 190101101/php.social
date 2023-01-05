<?php 

return (object) [
	'undeleted_status_id_order' => "article.article_deleted=0 AND article.article_status=1 AND article.article_id=? ORDER BY article.article_id DESC",
	'undeleted_status_id' => 'article_deleted=0 AND article_status=1 AND article_id=?',
	'ArticleStatusId' => 'article_deleted=0 AND article_status=1 AND article_id=?',
	'ArticleStatusIdByUser' => 'article_deleted=0 AND article_status=1 AND user_id',
];


