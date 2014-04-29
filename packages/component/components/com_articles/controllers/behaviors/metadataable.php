<?php

/**
 * ComArticles
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 * @category	
 * @package 	
 * @subpackage	
 */
 
 defined('KOOWA') or die('Restricted Access');

class ComArticlesControllerBehaviorMetadataable extends KControllerBehaviorAbstract
{
    private $properties;
    private $values;
    private $og;

    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'og' => false,
            'properties' => array(
                'title'         => 'title',
                'description'   => 'description',
                'keywords'      => '',
                'og:title'      => 'title'
            ),
            'values' => array(
                'og:type'       => 'article',
                'og:url'        => KRequest::url(),
                'og:site_name'  => JFactory::getConfig()->get('sitename')
            )
        ));

        $this->properties = new KConfig($config->properties);
        $this->values = new KConfig($config->values);
        $this->og = $config->og;

        // Remove properties which are already set in the values:
        foreach($this->values as $value) {
            foreach($this->properties as $property) {
                if ($value == $property) {
                    unset($this->properties[$value]);
                }
            }
        }

        parent::_initialize($config);
    }

    private static function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    protected function _afterRead(KCommandContext $context)
    {
        if ($context->caller->getRequest()->format != 'html') {
            return;
        }

        $item = $context->caller->getModel()->getItem();

        if (!$item->isNew()) {
            $doc =& JFactory::getDocument();
            $doc->setTitle($item[$this->properties->title]);
            unset($this->properties->title);

            foreach ($this->properties as $property => $value) {
                if (!$value) {
                    continue;
                }

                if (self::startsWith($property, 'og:')) {
                    if ($this->og) {
                        if ($item[$value]) {
                            $doc->addCustomTag('<meta property="' . $property . '" value="' . strip_tags($item[$value]) . '"/>');
                        }
                    }
                    continue;
                }

                if ($item[$value]) {
                    $doc->setMetaData($property, strip_tags($item[$value]));
                }
            }

            foreach ($this->values as $property => $value) {
                if (!$value) {
                    continue;
                }

                if (self::startsWith($property, 'og:')) {
                    if ($this->og) {
                        $doc->addCustomTag('<meta property="' . $property . '" value="' . $value . '"/>');
                    }
                    continue;
                }

                $doc->setMetaData($property, $value);
            }
        }
    }
}