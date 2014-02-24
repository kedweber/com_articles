<?php

class ModArticlesHtml extends ModDefaultHtml
{
    /**
     * @return ModDefaultHtml
     */
    public function display()
	{
//        $taxonomies = $this->getService('com://site/taxonomy.model.taxonomies')->type(array('article', 'event'))->limit($this->module->params->limit)->getList();
//
//		$this->assign('taxonomies', $taxonomies);
//		$this->assign('limit', $this->module->params->limit);
//        $this->assign('total', $this->getService('com://site/taxonomy.model.taxonomies')->type(array('article', 'event'))->getTotal());

		$article = $this->getService('com://site/articles.model.articles')->id($this->module->params->id)->getItem();

		$this->assign('article', $article);

		return parent::display();
	}
}