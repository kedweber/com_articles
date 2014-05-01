<? defined('KOOWA') or die; ?>

<?= @helper('behavior.mootools'); ?>

<?= @helper('behavior.keepalive'); ?>
<?= @helper('behavior.validator'); ?>

<script src="media://lib_koowa/js/koowa.js" />

<form action="" class="form-horizontal -koowa-form" method="post">
    <div class="row-fluid">
        <div class="span8">
            <fieldset>
                <legend><?= @text('CONTENT'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('TITLE'); ?></label>
                    <div class="controls">
                        <input class="span12 required" type="text" name="title" value="<?= @escape($article->title); ?>" placeholder="<?= @text('TITLE'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('SUBTITLE'); ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="subtitle" value="<?= @escape($article->subtitle); ?>" placeholder="<?= @text('SUBTITLE'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('SLUG'); ?></label>
                    <div class="controls">
                        <input class="span12" type="text" name="slug" value="<?= $article->slug; ?>" placeholder="<?= @text('SLUG'); ?>" />
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label"><?= @text('FIELDSET'); ?></label>
					<?= @template('com://admin/cck.view.connection.listbox'); ?>
				</div>
            </fieldset>

            <fieldset>
                <legend><?= @text('FIELDS'); ?></legend>
				<div id="fieldset"></div>
         	</fieldset>
        </div>
        <div class="span4">
            <fieldset>
                <legend><?= @text('DETAILS'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('START_PUBLISHING'); ?></label>
                    <div class="controls">
                        <?= @helper('behavior.calendar', array('date' => $article->publish_up === '0000-00-00' ? date('Y-m-d') : $article->publish_up, 'name' => 'publish_up', 'format'  => '%Y-%m-%d')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('END_PUBLISHING'); ?></label>
                    <div class="controls">
                        <?= @helper('behavior.calendar', array('date' => $article->publish_down, 'name' => 'publish_down', 'format'  => '%Y-%m-%d')); ?>
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label"><?= @text('PUBLISHED'); ?></label>
					<div class="controls">
						<?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $article->enabled)); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= @text('Translated'); ?></label>
					<div class="controls">
						<?= @helper('select.booleanlist', array('name' => 'translated', 'selected' => $article->translated)); ?>
					</div>
				</div>
            </fieldset>

            <fieldset>
                <legend><?= @text('META'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('DESCRIPTION'); ?></label>
                    <div class="controls">
                        <textarea name="meta_description"><?= $article->meta_description; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('KEYWORDS'); ?></label>
                    <div class="controls">
                        <textarea name="meta_keywords"><?= $article->meta_keywords; ?></textarea>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend><?= @text('RELATIONS'); ?></legend>
                <div class="control-group">
                    <label class="control-label"><?= @text('CATEGORY'); ?></label>

                    <? if($article->isRelationable()) : ?>
                        <? $test = $article->getRelation(array('type' => 'ancestors', 'filter' => array('type' => 'category')))->getIds('taxonomy_taxonomy_id'); ?>
                    <? endif; ?>

                    <div class="controls">
                        <?= @helper('com://admin/makundi.template.helper.listbox.categories', array(
                            'value' => 'taxonomy_taxonomy_id',
                            'deselect' => true,
                            'check_access' => true,
                            'name' => 'category',
                            'attribs' => array('id' => 'parent_id'),
                            'selected' => $test,
							'filter' => array('type' => 'category')
                        )); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('TAGS'); ?></label>
                    <div class="controls">
                        <?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array(
							'identifier' => 'com://admin/terms.model.tags',
							'name' => 'tags[]',
							'attribs' => array('multiple' => true, 'size' => 10),
							'type' => 'tag',
							'relation' => 'ancestors'
						)); ?>
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label"><?= @text('RELATED_ARTICLES'); ?></label>
					<div class="controls">
						<?= @helper('com://admin/taxonomy.template.helper.listbox.taxonomies', array('identifier' => 'com://admin/articles.model.articles', 'name' => 'articles[]', 'attribs' => array('multiple' => true, 'size' => 10), 'table' => $article->getTable()->getBase())); ?>
					</div>
				</div>
            </fieldset>
        </div>
    </div>
</form>