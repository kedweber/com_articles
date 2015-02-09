<?php

class ComArticlesControllerArticle extends ComDefaultControllerDefault
{
    public function _initialize(KConfig $config)
    {
        $this->mixin($this->getService('com://admin/kutafuta.controller.behavior.indexable'));
        $this->mixin($this->getService('com://admin/moyo.controller.behavior.copyable'));

        $config->append(array(
            'behaviors' => array(
                'com://admin/cck.controller.behavior.autosavable'
            )
        ));

        parent::_initialize($config);
	}

    public function _actionCheckin(KCommandContext $context)
    {
        JFactory::getLanguage()->load('com_checkin', JPATH_ADMINISTRATOR);

        $table = $this->getModel()->getTable();
        $database = $table->getDatabase();
        $query = 'UPDATE #__' . $table->getName() . ' SET `locked_on` = \'0000-00-00 00:00:00\', `locked_by` = 0 WHERE locked_by > 0;';;

        $database->execute($query);
        $rows = $database->getConnection()->affected_rows;

        $this->setRedirect(KRequest::referrer(), JText::plural('COM_CHECKIN_N_ITEMS_CHECKED_IN', $rows));
    }
}