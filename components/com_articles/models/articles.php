<?php

class ComArticlesModelArticles extends ComDefaultModelDefault
{
    /**
     * @param KConfig $config
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->_state
            ->insert('ancestor_id'    , 'int')
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

        if(is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }

        $query->where('tbl.enabled', '=', 1);
    }

    protected function _buildQueryHaving(KDatabaseQuery $query)
    {
        $state = $this->_state;

        parent::_buildQueryHaving($query);

        if(is_numeric($state->ancestor_id)) {
            $query->having('(FIND_IN_SET('.$state->ancestor_id.', LOWER(ANCESTORS)))');
        }
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        if (!isset($this->_total)) {
            if ($this->isConnected()) {
                $query = $this->getTable()->getDatabase()->getQuery();

                $this->_buildQueryColumns($query);
                $this->_buildQueryFrom($query);
                $this->_buildQueryJoins($query);
                $this->_buildQueryWhere($query);
                $this->_buildQueryGroup($query);
                $this->_buildQueryHaving($query);

                $total = count($this->getTable()->select($query, KDatabase::FETCH_FIELD_LIST));
                $this->_total = $total;
            }
        }

        return $this->_total;
    }
}