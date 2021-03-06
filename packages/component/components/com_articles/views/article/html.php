<?php
/**
 * ComArticles
 *
 * @author      Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */
 
defined('KOOWA') or die('Protected resource');

class ComArticlesViewArticleHtml extends ComDefaultViewHtml
{
    /**
     * @param KConfig $config
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'template_filters' => array('module'),
        ));

        parent::_initialize($config);
    }

	public function display()
	{
		$article = $this->getModel()->getItem();

		$layout = end(explode(':', $article->layout));
		$this->setLayout($layout ? $layout : 'default');

		$menu = JFactory::getApplication()->getMenu();

		header('X-Article-ID: '.$article->id);

		$doc =& JFactory::getDocument();
		if($article->title) {
			$doc->setTitle($article->title);
		}

		if($article->meta_keywords) {
			$doc->setMetaData('Keywords', $article->meta_keywords);
		}

		if($article->meta_description) {
			$doc->setMetaData('Description', $article->meta_description);
		}

		$pathway = JFactory::getApplication()->getPathway();

		$itemid = JRequest::getVar('Itemid');

		$menu_item = JApplication::getInstance('site')->getMenu()->getItems('link', 'index.php?option=com_articles&view=article&id='.$article->id, true);

		if(!$itemid) {
			if(!$menu_item) {
				if($article->category instanceof KDatabaseRowDefault) {
					$category = $article->category;

					$item = JApplication::getInstance('site')->getMenu()->getItems('link', 'index.php?option=com_makundi&view=category&id='.$category->id, true);

					if($item) {
						$i = 0;
						foreach(explode('/', $item->route) as $part) {
							$pathway->addItem(ucfirst($part), 'index.php?Itemid='.$item->tree[$i]);
							$i++;
						}
					} else {
						if(!JSite::getMenu()->getActive()->id)
						{
							$pathway->addItem($category->title, JRoute::_('index.php?option=com_makundi&view=category&parent_slug_path=' . $category->parent_slug_path . '&slug=' . $category->slug));
						}
					}

					$pathway->addItem($article->title);
				}
			}
		} elseif($itemid != $menu_item->id) {
			$pathway->addItem($article->title);
		}

		return parent::display();
	}
}