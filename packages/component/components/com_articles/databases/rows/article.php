<?php

/**
 * Com
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 * @category	
 * @package 	
 * @subpackage	
 */
 
 defined('KOOWA') or die('Restricted Access');

class ComArticlesDatabaseRowArticle extends KDatabaseRowDefault
{
    /**
     * Converts a date string to a timestamp
     *
     * @param   String      $date
     * @param   String      $format default = '%Y-%m-%d'
     * @return  int         the converted timestamp
     */
    private static function dateStringToTimestamp($date, $format = '%Y-%m-%d')
    {
        $a = strptime($date, $format);
        return mktime(0, 0, 0, $a['tm_mon'] + 1, $a['tm_mday'], $a['tm_year'] + 1900);
    }

    public function getPrintableDate($format = '%A, %e %B %Y', $date = 'publish_up')
    {
        setlocale(LC_TIME, str_replace('-', '_', JFactory::getLanguage()->getTag()) . (strpos($_SERVER['HTTP_USER_AGENT'], 'OS X') ? '.UTF-8' : '.utf8'));

        return strftime($format, ComArticlesDatabaseRowArticle::dateStringToTimestamp($this[$date]));
    }
}