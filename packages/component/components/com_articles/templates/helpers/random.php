<?php

/**
 * ComArticles
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */
 
defined('KOOWA') or die('Restricted Access');

class ComArticlesTemplateHelperRandom extends KTemplateHelperAbstract
{
    public static $types = 'image';

    private function getImages(KConfig $config)
    {
        return $this->getService('com://admin/files.controller.file')->types($config->types)->container($config->container)->browse();
    }

    public function image($config = array())
    {
        $config = new KConfig($config);

        $config->append(array(
            'types' => self::$types,
            'width' => 1300,
            'height' => 370,
            'container' => 'images'
        ));


        $images = $this->getImages($config);

        $count = count($images);
        $random_index = rand(0, $count - 1);

        $i = 0;
        foreach ($images as $image) {
            if ($i != $random_index) {
                $i++;
                continue;
            }

            return $this->getService('com://admin/cloudinary.controller.image')->path(str_replace(JPATH_ROOT . '/', '' ,$image['container']->path) . '/' .$image->name)->width($config->width)->height($config->height)->attribs(array('class' => 'img-responsive'))->cache(0)->display();
        }
    }
}