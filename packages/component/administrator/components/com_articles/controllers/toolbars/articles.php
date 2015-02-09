<?php

class ComArticlesControllerToolbarArticles extends ComDefaultControllerToolbarDefault
{
    public function getCommands()
    {
        $this
            ->addSeparator()
            ->addCopy()
            ->addIndex()
            ->addSeparator();

        if(JFactory::getUser()->authorise('core.admin')) {
            $this->addCheckin();
        }

        return parent::getCommands();
    }

    public function _commandIndex(KControllerToolbarCommand $command)
    {
        $command->icon = 'refresh';
        $command->label = JText::_('Index');
        $command->append(array(
            'attribs' => array(
                'data-action' => 'index',
                'data-novalidate' => 'novalidate'
            )
        ));
    }

    public function _commandCheckin(KControllerToolbarCommand $command)
    {
        $command->icon = 'checkin';
        $command->label = JText::_('Checkin');
        $command->append(array(
            'attribs' => array(
                'data-action' => 'checkin',
                'data-novalidate' => 'novalidate'
            )
        ));
    }
}