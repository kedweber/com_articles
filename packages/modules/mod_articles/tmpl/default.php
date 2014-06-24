<div class="container">
	<h2><?= $article->title; ?></h2>
	<?= $article->introtext; ?>
	<? if($article->fulltext) : ?>
		<a class="readmore" href="<?= @route('option=com_articles&view=article&date=' . date('Y-m-d', strtotime($article->publish_up)) . '&id=' . $article->id . '&slug=' . $article->slug); ?>"?><?= @text('READ_MORE'); ?></a>
	<? endif; ?>
</div>