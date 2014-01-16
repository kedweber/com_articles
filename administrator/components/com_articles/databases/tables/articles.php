<?php

class ComArticlesDatabaseTableArticles extends KDatabaseTableDefault
{
    protected function _initialize(KConfig $config)
    {
        $relationable = $this->getBehavior('com://admin/taxonomy.database.behavior.relationable',
            array(
                'ancestors'     => array('regions', 'categories'),
            )
        );

        $routable = $this->getBehavior('com://admin/routes.database.behavior.routable',
            array(
                'ancestors'     => array('regions', 'categories'),
            )
        );

        $config->append(array(
            'behaviors' => array(
                'lockable',
                'creatable',
                'modifiable',
                'identifiable',
                'orderable',
                'sluggable',
                'com://admin/cck.database.behavior.elementable',
                $relationable,
                'com://admin/translations.database.behavior.translatable',
                $routable,
            )
        ));

        parent::_initialize($config);
    }
}