<?php
/**
 * ComArticles
 *
 * @author      Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */

class ComArticlesModelArticles extends ComDefaultModelDefault
{
	/**
	 *
	 */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->_state
			->insert('category_id'     	, 'int')
			->insert('tag'     	        , 'int')
			->insert('featured'     	, 'int', null, true)
            ->insert('enabled'      	, 'int')
			->insert('sort'     		, 'cmd', 'publish_up')
			->insert('direction'		, 'word', 'desc')
        ;
    }

    /**
     * @param KDatabaseQuery $query
     */
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        $state = $this->_state;

		if($state->featured) {
			$query->where('tbl.featured', '=', $state->featured);
		}

		parent::_buildQueryWhere($query);

		if(is_numeric($state->category_id)) {
			$query->where('ancestors', 'REGEXP', '(.*"category":"'.$state->category_id.'")');
		}

		if(is_array($state->ancestors)) {
			foreach($state->ancestors as $type => $value) {
				$query->where('ancestors', 'REGEXP', '(.*"'.KInflector::singularize($type).'":"'.$value.'")');
			}
		}

		if(is_array($state->category_id)) {
			foreach($state->category_id as $category_id) {
				$query->where('ancestors', 'REGEXP', '(.*"category":"'.$category_id.'")', 'OR');
			}
		}

        if(is_numeric($state->tag)) {
            $query->where('FIND_IN_SET('.$state->tag.', REPLACE(SUBSTRING_INDEX(SUBSTR(ANCESTORS,LOCATE(\'"TAGS":["\',ANCESTORS)+CHAR_LENGTH(\'"TAGS":["\')),\'"]\', 1),\'"\', \'\'))', null, null);
        }

        $query->where('tbl.enabled', '=', 1);
    }

	protected function _buildQueryOrder(KDatabaseQuery $query)
	{
		parent::_buildQueryOrder($query);

		$query->order('tbl.publish_up', 'desc');
	}
}