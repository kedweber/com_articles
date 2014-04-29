<?php

/**
 * ComArticles
 *
 * @author 		Joep van der Heijden <joep.van.der.heijden@moyoweb.nl>
 */

defined('KOOWA') or die('Restricted Access');

class ComArticlesTemplateHelperArticle extends KTemplateHelperAbstract
{
    private function links(KConfig $config)
    {
        $html = '';

        // TODO: future change for multiple links
        if ($config->article->urls) {
            $url = $this->getService('com://site/moyo.template.helper.parser')->link(array('url' => $config->article->url));

            $html .= '<h2>'. $this->translate('LINKS') .'</h2>
                    <ul>
                        <li><a href="'. $url .'" target="_blank">' . $url_title . '</a></li>
                    </ul>';
        }

        return $html;
    }

    private function relatedDocuments(KConfig $config)
    {
        // TODO: future change for multiple related documents links
        return '<h2>'. $this->translate('RELATED_DOCUMENTS') .'</h2>
                <ul>
                    <li>link 1</li>
                    <li>link 2</li>
                </ul>';
    }

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
                        <a href="' . JRoute::_('index.php?options=com_articles&view=articles&tag=' . $tag->id) . '"><span class="glyphicon glyphicon-tag"></span>'. $tag->title .'</a>
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
