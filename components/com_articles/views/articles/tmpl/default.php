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
        <h1><?= @text('Regions'); ?></h1>
        <ul class="regions__list">
            <? $regions = @service('com://admin/regions.model.regions')->getList(); ?>
            <? foreach($regions as $region) : ?>
            <? if($region->isRelationable()) : ?>
                <li <?= $state->ancestor_id == $region->taxonomy_taxonomy_id ? 'class="active"' : null ?>>
                <i class="rounded"><?= $region->title[0]; ?></i> <a href="<?= @route('&ancestor_id='.$region->taxonomy_taxonomy_id); ?>"><?= $region->title; ?> <span class="normalize">(<?= $region->getTaxonomy()->getDescendants(array('filter' => array('type' => 'article')))->count(); ?>)</span></a>
                <? endif; ?>
            </li>
        <? endforeach; ?>
        </ul>
    </div>
</module>

<section class="block__list">
    <header>
        <h1><?= @text('News'); ?></h1>
    </header>
    <? foreach($articles as $article) : ?>
        <article>
            <header>
                <h1><a href="<?= @route('view=article&id='.$article->id); ?>"><?= $article->title; ?></a></h1>
            </header>
            <div class="meta">
                <span class="small"><span class="quicksand"><?= @text('Posted'); ?>:</span> <?= date('l, d F Y', strtotime($article->created_on)); ?></span>
            </div>
            <div class="body row">
                <? if($article->image) : ?>
                <div class="col-md-4">
                    <?= @service('com://admin/cloudinary.controller.image')->path($article->image)->width(350)->height(200)->quality(80)->attribs(array('class' => 'img-responsive'))->cache(0)->display(); ?>
                </div>
                <? endif; ?>
                <div <?= $article->image ? 'class="col-md-8"' : 'class="col-md-12"'?>>
                    <span>
                        <?= $article->introtext; ?>
                        <a class="readmore" href="<?= @route('view=article&id='.$article->id); ?>"><?= @text('Read more'); ?></a>
                    </span>
                </div>
            </div>
            <footer class="clearfix">
                <span class="comment-count pull-right">Comments: <a class="readmore" data-disqus-identifier="<?= $article->uuid; ?>" href="<?= @route('view=article&id='.$article->id.'#disqus_thread'); ?>">Loading</a></span>
            </footer>
        </article>
    <? endforeach; ?>
    <footer>
        <?= @text('Load more'); ?>
    </footer>
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