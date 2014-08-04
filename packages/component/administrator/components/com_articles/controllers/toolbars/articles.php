<?php

class ComArticlesControllerToolbarArticles extends ComDefaultControllerToolbarDefault
{
    public function getCommands()
    {
        $this
            ->addSeparator()
            ->addCopy()
            ->addIndex();

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
}