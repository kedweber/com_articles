<?php

class ComArticlesTemplateHelperModal extends KTemplateHelperAbstract
{
    public function article($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'attribs' => array(),
            'visible' => true,
            'link_text' => JText::_('SELECT'),
            'link'  => JRoute::_('index.php?option=com_articles&view=articles&layout=modal&tmpl=component&function=Articles.selectArticle&enabled=1'),
            'link_selector' => 'modal'
        ))->append(array(
            'value' => $config->name
        ));

        $html = "<script>
        jQuery(function($){
            if (typeof Articles === 'undefined') Articles = {};

            Articles.selectArticle = function(id, title) {
        	    $('#".$config->id."_hidden').val(id);
        	    $('#".$config->id."').val(title);
        	    $('#article').trigger('change');

        	    SqueezeBox.close();
            };
        });
        </script>
        ";

        $html .= $this->select_article($config);

        return $html;
    }

    public function select_article($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'name' => '',
            'attribs' => array(),
            'visible' => true,
            'link' => '',
            'link_text' => JText::_('SELECT'),
            'link_selector' => 'modal'
        ))->append(array(
            'id' => $config->name,
            'value' => $config->name
        ));

        $attribs = KHelperArray::toString($config->attribs);

        $input = '<input id="%1$s" value="%2$s" %3$s size="40" %4$s />';

        $link = '<a class="%s btn"
                    rel="{\'handler\': \'iframe\', \'size\': {\'x\': 690}}"
                    href="%s">%s</a>';

        $hidden = '<input id="%1$s_hidden" type="hidden" name="%2$s" value="%3$s" />';

        $html = sprintf($input, $config->id, $config->title, $config->visible ? 'type="text" readonly' : 'type="hidden"', $attribs);
        $html .= sprintf($link, $config->link_selector, $config->link, $config->link_text);
        $html .= sprintf($hidden, $config->id, $config->name, $config->selected);

        return $html;
    }
}
