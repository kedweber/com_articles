<?php

defined('KOOWA') or die('Protected resource');

class ComArticlesDatabaseRowArticle extends ComTaxonomyDatabaseRowDefault
{
    public function getTypes()
    {
        $types = array();

        $rows = $this->getService('com://admin/cck.model.connections')->package($this->getIdentifier()->package)->name($this->getIdentifier()->name)->getList();
        foreach($rows as $row)
        {
            $types[] = $row->slug;
        }

        return $types;
    }
}