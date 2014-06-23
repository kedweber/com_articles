<?php

/**
 * ComArticles
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */

defined('KOOWA') or die('Restricted Access');

class ComArticlesTemplateHelperArticle extends KTemplateHelperAbstract
{
    public function footer($config = array())
    {
        $config = new KConfig($config);

        $link = $this->links($config);

        if (!$link) {
            return '';
        }

        return '<footer class="row">
                    <div class="col-md-6">'
                    . $link . '
                    </div>
                </footer>';
    }

    public function tags($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'tags' => array(),
        ));

        $html = '';
        $tags = '';

        foreach ($config->tags as $tag) {
            $tags .= '<li class="tag">
                        <a href="' . JRoute::_('index.php?option=com_terms&view=tag&id=' . $tag->id . '&slug=' . $tag->slug . '&format=html') . '"><span class="glyphicon glyphicon-tag"></span>'. $tag->title .'</a>
                      </li>';
        }

        $html .= '<ul class="tags">' . $tags . '</ul>';

        return $html;
    }

    public function category_header($config = array())
    {
        $config = new KConfig($config);

        $html = '';

        if ($config->category) {
            $category = $config->category;

            $parent = $category->getParent() ? $category->getParent()->title : 'CTA';

            $html .= '<hgroup>
                        <div class="col-xs-12 col-md-8  blue"><h3>'. $category->title .'</h3></div>
                        <div class="col-xs-12 col-md-4 green"><h3>'. $parent .'</h3></div>
                      </hgroup>';
        }

        return $html;
    }
}
