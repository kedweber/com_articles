<?php

defined('_JEXEC') or die;

class ComArticlesRouter
{
    public static function getInstance()
    {
        static $instance;

        if (!$instance) {
            $instance = new ComArticlesRouter();
        }

        return $instance;
    }

	public function build(&$query)
	{
		$segments	= array();

		if($query['id'] && !$query['slug']) {
			if($query['view'] == 'article') {
				$segments['slug'] = KService::get('com://site/articles.model.articles')->id($query['id'])->getItem()->slug;
			}
		}

		return $segments;
	}

	public function parse($segments)
	{
		$vars = array();

		if($segments[0]) {
			return JError::raiseError(404, JText::_('COM_ARTICLES_NOT_FOUND'));
		}

		$article = KService::get('com://site/articles.model.articles')->slug($segments['slug'])->getItem();

		if(!JApplication::getInstance('site')->getMenu()->getItems('link', 'index.php?option=com_articles&view=article&id='.$article->id, true)) {
			if($article->category instanceof KDatabaseRowDefault) {
				$category = $article->category;

//				if($article->category->isRelationable()) {
//					print_r($category->getParent());
//				}

				$item = JApplication::getInstance('site')->getMenu()->getItems('link', 'index.php?option=com_makundi&view=category&id='.$category->id, true);

				if($item) {
					$vars['Itemid'] = $item->id;
				}
			}
		}

		return $vars;
	}
}

function ArticlesBuildRoute(&$query)
{
	return ComArticlesRouter::getInstance()->build($query);
}

function ArticlesParseRoute($segments)
{
	return ComArticlesRouter::getInstance()->parse($segments);
}
