<?php

class ComArticlesControllerArticle extends ComDefaultControllerDefault
{
    public function _initialize(KConfig $config)
    {
        $this->mixin($this->getService('com://admin/kutafuta.controller.behavior.indexable'));
        $this->mixin($this->getService('com://admin/moyo.controller.behavior.copyable'));

        parent::_initialize($config);
	}
}