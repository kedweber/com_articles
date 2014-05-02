<?php

class ComArticlesModelArticles extends ComTaxonomyModelDefault
{
    /**
     * @param KConfig $config
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->_state
			->insert('category_id'     	, 'int')
			->insert('sort'     , 'cmd', 'id')
			->insert('direction', 'word', 'desc')
            ->insert('enabled'	, 'int')
            ->insert('exclude', 'raw')
        ;
    }

    /**
     * @param KDatabaseQuery $query
     */
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        $state = $this->_state;

        parent::_buildQueryWhere($query);

		if(is_numeric($state->category_id)) {
			$query->where('ancestors', 'REGEXP', '(.*"category":"'.$state->category_id.'")');
		}

		if(is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }

        if($state->search) {
            $query->where('tbl.title', 'LIKE', '%'.$state->search.'%');
        }

        if($state->exclude) {
            foreach($state->exclude as $key => $exclude) {
                $query->where('tbl.' . $key, 'NOT IN', $exclude);
            }
        }
    }
}