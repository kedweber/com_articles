<?php
/**
 * ComArticles
 *
 * @author      Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */

class ComArticlesDatabaseTableArticles extends KDatabaseTableDefault
{
    protected function _initialize(KConfig $config)
    {
		$relationable = $this->getBehavior('com://site/taxonomy.database.behavior.relationable',
			array(
				'ancestors' => array(
					'category' => array(
						'identifier' => 'com://site/makundi.model.categories',
					),
					'topic' => array(
						'identifier' => 'com://site/makundi.model.categories',
					),
					'tags' => array(
						'identifier' => 'com://admin/terms.model.tags',
					),
				),
				'descendants' => array(
					'articles' => array(
						'identifier' => 'com://site/articles.model.articles',
					)
				)
			)
		);

        $config->append(array(
            'behaviors' => array(
                $relationable,
				'com://admin/cck.database.behavior.elementable',
                'com://admin/translations.database.behavior.translatable',
            )
        ));

        parent::_initialize($config);
    }
}