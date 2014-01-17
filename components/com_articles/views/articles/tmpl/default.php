<?php
/**
 * Com
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ...
 * @uses        Com_
 */

defined('KOOWA') or die('Protected resource'); ?>

<module position="left" prepend="0">
    <div class="regions">
        <h1><?= @text('FILTER_BY'); ?>:</h1>
        <ul class="regions__list">
            <? $regions = @service('com://admin/regions.model.regions')->getList(); ?>
            <? foreach($regions as $region) : ?>
            <? if($region->isRelationable()) : ?>
                <li <?= $state->ancestors['region'] == $region->taxonomy_taxonomy_id ? 'class="active"' : null ?>>
                <i class="circle"><?= $region->title[0]; ?></i> <a class="ajaxify" data-target="#container" href="<?= @route('&ancestors[region]='.$region->taxonomy_taxonomy_id); ?>"><?= $region->title; ?> <span class="normalize">(<?= $region->getTaxonomy()->getDescendants(array('filter' => array('type' => 'article')))->count(); ?>)</span></a>
                <? endif; ?>
            </li>
        <? endforeach; ?>
        </ul>
    </div>
</module>

<section class="block__list">
    <header>
        <h1><?= JFactory::getApplication()->getMenu()->getActive()->title; ?></h1>
    </header>
    <div id="container">
        <?= @template('default_items'); ?>
    </div>
    <? if($total > $state->limit) : ?>
    <footer>
        <?= @helper('com://site/moyo.template.helper.paginator.pagination', array('total' => $total, 'limit' => $state->limit, 'ajax' => true, 'url' => '?option=com_articles&view=articles&layout=default_items&format=raw')); ?>
    </footer>
    <? endif; ?>
</section>

<script>
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'web2fordev'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>