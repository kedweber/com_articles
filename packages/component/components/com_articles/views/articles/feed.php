<?php

/**
 * Com
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 * @category	
 * @package 	
 * @subpackage	
 */

defined('KOOWA') or die('Restricted Access');

class ComArticlesViewArticlesFeed extends KViewAbstract
{
    public function display()
    {
        $articles	= $this->getModel()->limit(20)->getList();
        $doc		= JFactory::getDocument();

        foreach($articles as $article) {
			$item				= new JFeedItem();
			$item->title		= $article->title;
			$item->link 		= $this->createRoute('option=com_articles&view=article&date=' . date('Y-m-d', strtotime($article->publish_up)) . '&id=' . $article->id . '&slug=' . $article->slug . '&format=html');
			$item->description	= $article->introtext;
			$item->date			= $article->publish_up;

			$category = json_decode($article->ancestors)->category;

			if(is_numeric($category)) {
				$item->category = $this->getService('com://site/makundi.model.categories')->id($category)->getItem()->title;
			}

			$doc->addItem($item);
        }

        return parent::display();
    }
}