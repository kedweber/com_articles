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

class ComArticlesTemplateHelperDate extends KTemplateHelperAbstract
{
    public function format($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'format'    => '%A, %e ',
            'date'      => '0000-00-00'
        ));

        if ($config->date == '0000-00-00' || $config->date == '1970-01-01') {
            return '';
        }

        setlocale(LC_TIME, str_replace('-', '_', JFactory::getLanguage()->getTag()) . (strpos($_SERVER['HTTP_USER_AGENT'], 'OS X') ? '.UTF-8' : '.utf8'));

        return strftime($config->format, strtotime($config->date));
    }
}