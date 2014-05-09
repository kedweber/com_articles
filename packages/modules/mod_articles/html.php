<?php

class ModArticlesHtml extends ModDefaultHtml
{
    /**
     * @return ModDefaultHtml
     */
    public function display()
	{
		$article = $this->getService('com://site/articles.model.articles')->id($this->module->params->id)->getItem();

		$this->assign('article', $article);
		$this->assign('params', $this->module->params);
		$this->assign('showtitle', $this->module->showtitle);

		return parent::display();
	}
}