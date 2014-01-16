<? defined('KOOWA') or die; ?>

<? $function	= JRequest::getCmd('function', 'jSelectArticle'); ?>

<?= @helper('behavior.mootools'); ?>

<!--
<script src="media://lib_koowa/js/koowa.js" />
-->

<div class="com_cck boxed">
    <div class="row-fluid">
        <form action="<?= @route('&tmpl=component'); ?>" method="get" class="-koowa-grid" data-toolbar=".toolbar-list">
            <div class="btn-toolbar" id="filter-bar">
                <div class="filter-search btn-group pull-left">
                    <input type="text" value="<?= $state->search; ?>" placeholder="Search" id="filter_search" name="search">
                </div>
                <div class="btn-group pull-left hidden-phone">
                    <button title="" class="btn hasTooltip" type="submit" data-original-title="Search"><i class="icon-search"></i></button>
                    <button onclick="document.id('filter_search').value='';this.form.submit();" title="" class="btn hasTooltip" type="button" data-original-title="Clear"><i class="icon-remove"></i></button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <?= @helper('grid.sort', array('column' => 'title', 'title' => @text('TITLE'))); ?>
                    </th>
                    <th>
                        <?= @helper('grid.sort', array('column' => 'id', 'title' => @text('ID'))); ?>
                    </th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <td colspan="2">
                        <?= @helper('paginator.pagination', array('total' => $total)) ?>
                    </td>
                </tr>
                </tfoot>

                <tbody>
                <? foreach ($articles as $article) : ?>
                <tr>
                    <td>
                        <a onclick="if (window.parent) window.parent.<?= @escape($function); ?>('<?php echo $article->id; ?>', '<?= @escape(addslashes($article->title)); ?>', '<?= @escape($article->catid); ?>', null, <?php echo "'index.php?option=com_cck&view=article&id=" . $article->id . "'" ?>, '<?= @escape($lang); ?>', '<?= KRequest::get('get.fieldname', 'string'); ?>');">
                            <?= $article->title; ?>
                        </a>
                    </td>
                    <td>
                        <?= $article->id; ?>
                    </td>
                </tr>
                    <? endforeach; ?>

                <? if (!count($articles)) : ?>
                <tr>
                    <td colspan="2" align="center" style="text-align: center;">
                        <?= @text('ARTICLES_NO_ITEMS') ?>
                    </td>
                </tr>
                    <? endif; ?>
                </tbody>
            </table>
        </form>
    </div>
</div>