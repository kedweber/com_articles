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
            ->insert('category_id'  , 'int')
            ->insert('enabled'      , 'int')
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
            $query->where('tbl.category_id', '=', $state->category_id);
        }

        if(is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }

        $query->where('tbl.enabled', '=', 1);
    }

    protected function _buildQueryOrder(KDatabaseQuery $query)
    {
        $query->order('publish_up', 'DESC');

        parent::_buildQueryOrder($query);
    }
}