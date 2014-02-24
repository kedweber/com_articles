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

<? foreach($articles as $article) : ?>
    <article itemscope itemtype="http://schema.org/Article">
        <header>
            <h1><a itemprop="url" href="<?= @route('view=article&id='.$article->id.'&format=html'); ?>"><span itemprop="name"><?= $article->title; ?></span></a></h1>
        </header>
        <div class="meta">
            <span class="small">
                <span class="clementine"><?= @text('Posted'); ?>:</span> <time itemprop="datePublished" datetime="<?= date('Y-m-d', strtotime($article->publish_up)); ?>"><?= $article->getPrintableDate(); ?></time>
                <meta itemprop="dateCreated" content="<?= date('Y-m-d', strtotime($article->created_on)); ?>" />
                <meta itemprop="dateModified" content="<?= date('Y-m-d', strtotime($article->modified_on)); ?>" />
            </span>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-md-4">
                    <?= @service('com://admin/cloudinary.controller.image')->path($article->image)->width(350)->height(200)->quality(80)->attribs(array('class' => 'img-responsive', 'itemprop' => 'image'))->cache(0)->display(); ?>
                </div>
                <div class="col-md-8">
                    <span itemprop="description"><?= $article->introtext; ?></span>
                    <a class="readmore" itemprop="url" href="<?= @route('view=article&id='.$article->id.'&format=html'); ?>"><?= @text('READ_MORE'); ?></a>
                </div>
            </div>
        </div>
        <footer class="clearfix">
            <span class="comment-count pull-right"><?= @text('COMMENTS'); ?>: <a itemprop="discussionUrl" class="readmore" data-disqus-identifier="<?= $article->uuid; ?>" href="<?= @route('view=article&id='.$article->id.'&format=html#disqus_thread'); ?>">Loading</a></span>
        </footer>
    </article>
<? endforeach; ?>

<? if (!count($articles)) : ?>
    <article>
        <p><?= @text('NO_NEWS_STORIES_AVAILABLE'); ?></p>
    </article>
<? endif; ?>