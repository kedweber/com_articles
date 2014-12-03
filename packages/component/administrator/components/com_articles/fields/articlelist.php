<?php

/**
 * ComArticles
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */
 
defined('KOOWA') or die('Restricted Access');

class JFormFieldArticlelist extends JFormField {
    protected $type = 'Articlelist';

    protected function getInput() {
        return KService::get('com://admin/articles.template.helper.listbox')->articles(array(
            'name' => $this->name,
            'selected' => $this->value,
            'indent'    => '- '
        ));
    }
}