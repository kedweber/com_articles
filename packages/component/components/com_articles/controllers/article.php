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
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'behaviors' => array(
                'com://admin/moyo.controller.behavior.cacheable'
            )
        ));

        parent::_initialize($config);
    }

    public function getRequest()
    {
        $this->_request->limit = $this->_request->limit ? $this->_request->limit : 20;

        return $this->_request;
    }
}