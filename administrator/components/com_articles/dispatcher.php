<?php

class ComArticlesDispatcher extends ComDefaultDispatcher
{
    protected function _initialize(KConfig $config)
    {
    	$config->append(array(
    		'controller' => 'articles'
        ));

        parent::_initialize($config);
    }
}