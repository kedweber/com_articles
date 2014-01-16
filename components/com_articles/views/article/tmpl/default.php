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

<script>
    jQuery(document).ready(function($) {
        var $form = $('#form-mail');
        var $loading = $('<div class="loading" style="height: 200px;"></div>');
        var $modalBody = $form.find('.modal-content').find('.modal-body');
        var $modalFooter = $form.find('.modal-content').find('.modal-footer');
        $modalBody.find('.success').hide();
        $modalBody.find('.failed').hide();
        $modalBody.find('.loading').hide();

        $form.on('submit', function(event) {
            event.preventDefault();

            $modalBody.children().hide();
            $modalFooter.hide();
            $modalBody.find('.loading').show();
            $modalBody.append($loading);

            $.post($form.attr('action'), $form.serialize())
                .done(function() {
                    $modalBody.find('.success').show();
                })
                .fail(function() {
                    $modalBody.children().show();
                    $modalFooter.show();
                    $modalBody.find('.success').hide();
                })
                .always(function() {
                    $loading.remove();
                });
        });

        $('#mail').on('click', function() {
            $modalBody.children().show();
            $modalFooter.show();
            $modalBody.find('.success').hide();
            $modalBody.find('.failed').hide();
        });
    });
</script>

<article class="block__item" itemscope itemtype="http://schema.org/Article">
    <meta itemprop="articleSection" content="<?= $article->regions; ?>">
    <header>
        <h1 itemprop="name"><?= $article->title; ?></h1>
        <div class="meta">
            <span class="small" itemprop="datePublished" datetime="<?= date('Y-m-d', strtotime($article->created_on)); ?>"><span class="clementine"><?= @text('Published'); ?>:</span> <?= date('l, d F Y', strtotime($article->created_on)); ?></span>
            <a id="mail" data-toggle="modal" href="#myModal"><i class="icon-envelope quicksand pull-right"></i></a>
        </div>
    </header>
    <div class="body clearfix" itemprop="articleBody">
        <div class="row">
            <? if($article->image) : ?>
            <div class="col-sm-6">
                <?= @service('com://admin/cloudinary.controller.image')->path($article->image)->width(400)->quality(80)->attribs(array('class' => 'img-responsive', 'itemprop' => 'image'))->cache(0)->display(); ?>
            </div>
            <? endif; ?>
            <div <?= $article->image ? 'class="col-sm-6"' : 'class="col-sm-12"'; ?>>
                <span itemprop="description"><?= $article->introtext; ?></span>
            </div>
        </div>
        <div class="body__image">
        </div>
        <?= $article->fulltext; ?>
    </div>
    <footer class="social">
        <div class="col-md-6 col-sm-6">
            <?= @service('com://site/social.controller.button')->display(); ?>
        </div>
    </footer>
    <div id="disqus_thread"></div>
</article>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-mail" class="form-horizontal" role="form" method="post" action="<?= @route('option=com_events&view=mail&format=json'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close Window</button>
                    <h4 class="modal-title">E-mail this link</h4>
                </div>
                <div class="modal-body">
                    <div class="failed">
                        <p>Failed to send email at this time. Please try again later.</p>
                    </div>
                    <div class="success">
                        <h4>Your email has been sent.</h4>
                    </div>
                    <div class="form-group">
                        <label for="emailto" class="col-xs-2 control-label">Email to:</label>
                        <div class="col-xs-7">
                            <input name="mailto" type="email" class="form-control" required="required" id="emailto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sender" class="col-xs-2 control-label">Sender:</label>
                        <div class="col-xs-7">
                            <input name="sender" type="email" class="form-control" required="required" id="sender">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-xs-2 control-label">Subject:</label>
                        <div class="col-xs-7">
                            <input name="subject" type="text" class="form-control" required="required" id="subject">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-xs-2 control-label">Message:</label>
                        <div class="col-xs-10">
                            <textarea name="message" rows="5" type="message" required="required" class="form-control" id="message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary pull-left col-sm-offset-2">Send</button>
                    <button type="button" class="btn-default pull-left" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'web2fordev'; // required: replace example with your forum shortname
    var disqus_identifier= '<?= $article->uuid; ?>';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>

<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>