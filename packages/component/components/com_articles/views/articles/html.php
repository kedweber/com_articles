<?php
/**
 * ComArticles
 *
 * @author      Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
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

	public function display()
	{
		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();

		$depends_on = implode(' ', $this->getModel()->getList()->getColumn('id'));

		header('X-Article-IDs: '.$depends_on);

		if($menu->getDefault() != $menu->getActive()) {
			$this->assign('menu', $menu->getActive());
		}

		return parent::display();
	}
}