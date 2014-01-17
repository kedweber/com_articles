<?php

class ComArticlesDatabaseTableArticles extends KDatabaseTableDefault
{
    protected function _initialize(KConfig $config)
    {
        $relationable = $this->getBehavior('com://admin/taxonomy.database.behavior.relationable',
            array(
                'ancestors'     => array('regions'),
            )
        );

        $config->append(array(
            'behaviors' => array(
                'com://admin/cck.database.behavior.elementable',
                $relationable,
                'com://admin/translations.database.behavior.translatable',
            )
        ));

        parent::_initialize($config);
    }
}