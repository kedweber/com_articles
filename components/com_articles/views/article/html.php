<?php
/**
 * Com
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ...
 * @uses        Com_
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

    /**
     * @return string
     */
    public function display()
    {
        $article = $this->getModel()->getItem();

        $doc =& JFactory::getDocument();
        $doc->setMetaData('Keywords', $article->meta_keywords);
        $doc->setMetaData('Description', $article->meta_description);

        $pathway = JFactory::getApplication()->getPathway();
        $pathway->addItem('News', 'index.php?option=com_articles&view=articles');
        $pathway->addItem($article->title);

        $article->regions = '';
        $regions = $this->getService('com://admin/regions.model.regions')->getList();

        foreach($regions as $region) {
            foreach(explode(',', $article->ancestors) as $ancestor) {
                if ($region->taxonomy_taxonomy_id === $ancestor) {
                    $article->regions .= $region->title . ' ';
                }
            }
        }

        $this->assign('article', $article);
        $this->assign('regions', $regions);

        return parent::display();
    }
}