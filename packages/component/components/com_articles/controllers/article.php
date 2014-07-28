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

class ComArticlesControllerArticle extends ComDefaultControllerDefault
{
	/**
	 * @param KConfig $config
	 */
	protected function _initialize(KConfig $config)
	{
        $metadataable = $this->getBehavior('com://site/articles.controller.behavior.metadataable',
            array(
                'og' => true
            )
        );

		$config->append(array(
			'behaviors' => array(
                $metadataable,
				'com://site/translations.controller.behavior.translatable'
			)
		));

		parent::_initialize($config);
	}

	/**
	 * @return array|KConfig
	 */
	public function getRequest()
	{
		$this->_request->limit = $this->_request->limit ? $this->_request->limit : 4;

		return $this->_request;
	}
}