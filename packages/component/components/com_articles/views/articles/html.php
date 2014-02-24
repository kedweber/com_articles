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

class ComArticlesViewArticlesHtml extends ComDefaultViewHtml
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
        $pathway = JFactory::getApplication()->getPathway();

        $url = 'index.php?option=com_articles&view=articles';
        $item = JApplication::getInstance('site')->getMenu()->getItems('link', $url, true);

        if($this->getModel()->getState()->ancestor_id) {
            $region = $this->getService('com://admin/regions.model.regions')->taxonomy_taxonomy_id($this->getModel()->getState()->ancestor_id)->getItem();
            $pathway->addItem($region->title);
        }

        return parent::display();
    }
}