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
     * Sets the layout to the value of $article->layout if there is no layout param
     *
     * @param $article
     */
    private function resolveLayout($article)
    {
        if (!KRequest::get('get.layout', 'string') && $article->layout) {
            $this->setLayout($article->layout);
        }
    }

    /**
     * @return string
     */
    public function display()
    {
        $article = $this->getModel()->getItem();

        $this->resolveLayout($article);

        $doc =& JFactory::getDocument();
        $doc->setTitle($article->title);
        $doc->setMetaData('Keywords', $article->meta_keywords);
        $doc->setMetaData('Description', $article->meta_description);

        //TODO: Check if itemId
        $pathway = JFactory::getApplication()->getPathway();
        if(!in_array($article->title, $pathway->getPathwayNames())) {
            $pathway->addItem($article->title);
        }

        $article->regions = '';
        $regions = $this->getService('com://admin/regions.model.regions')->getList();

        foreach($regions as $region) {
            foreach(explode(',', $article->ancestors) as $ancestor) {
                if ($region->taxonomy_taxonomy_id === $ancestor) {
                    $article->regions .= $region->title . ' ';
                }
            }
        }

        $menus  =& JSite::getMenu();
        $menu   = $menus->getActive();

        $params   = new KConfig(json_decode($menu->params, true));

        $params->append(array(
            'show_publishdate'      => 1,
            'show_socialbuttons'    => 1
        ));

        $this->assign('article', $article);
        $this->assign('regions', $regions);
        $this->assign('params', $params);

        return parent::display();
    }
}