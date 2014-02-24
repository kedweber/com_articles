<?php

defined('JPATH_BASE') or die;

class JFormFieldArticle extends JFormField
{
	protected $type = 'Article';

	protected function getInput()
	{
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal');

		// Build the script.
		$script = array();
		$script[] = '	function jSelectArticle_'.$this->id.'(id, title, catid, object) {';
		$script[] = '		document.id("'.$this->id.'_id").value = id;';
		$script[] = '		document.id("'.$this->id.'_name").value = title;';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));


		// Setup variables for display.
		$html	= array();
		$link	= 'index.php?option=com_articles&amp;view=articles&amp;layout=modal&amp;tmpl=component&amp;function=jSelectArticle_'.$this->id;

		$title = KService::get('com://site/articles.model.articles')->id($this->value)->getItem()->title;

        $html[] = '<span class="input-append">';
        $html[] = '<input type="text" class="inoutbox input=medium" id="'.$this->id.'_name" value="'.$title.'" readonly="readonly" disabled="disabled" size="40" placeholder="'. JText::_('COM_ARTICLES_SELECT_AN_ITEM').'" /><a class="btn btn-primary modal" href="'.$link.'&amp;'.JSession::getFormToken().'=1" rel="{handler: \'iframe\', size: {x: 800, y: 450}}"><i class="icon-list icon-white"></i>
'.JText::_('Select').'</a>';

		// The active article id field.
		if (0 == (int)$this->value) {
			$value = '';
		} else {
			$value = (int)$this->value;
		}

		// class='required' for client side validation
		$class = '';
		if ($this->required) {
			$class = ' class="required modal-value"';
		}

		$html[] = '<input type="hidden" id="'.$this->id.'_id"'.$class.' name="'.$this->name.'" value="'.$value.'" />';

		return implode("\n", $html);
	}
}