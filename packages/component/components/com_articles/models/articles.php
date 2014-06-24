<?php

defined('KOOWA') or die('Protected resource');

$loader = KService::get('koowa:loader');

$loader->loadFile(JPATH_ROOT.'/config/com_articles/models/articles.php');