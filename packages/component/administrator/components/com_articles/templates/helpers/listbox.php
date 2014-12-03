<?php

class ComArticlesTemplateHelperListbox extends ComMoyoTemplateHelperListbox
{
    /**
     * @param array $config
     * @return mixed|string
     */
    public function articles($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'model'    => 'articles',
            'value'    => 'id',
            'text'     => 'title',
            'prompt'   => ' - Select an article - ',
            'required' => false,
            'attribs' => array(
                'data-placeholder' => $this->translate('Select an article&hellip;'),
                'class' => 'select2-listbox'
            ),
            'behaviors' => array('select2' => array('element' => '.select2-listbox')),
            'indent'    => '- '
        ));

        return $this->_treelistbox($config);
    }
}