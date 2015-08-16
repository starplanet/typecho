<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>


<?php if(!empty($this->categories)) : ?>
	<?php $mid = $this->categories[0]['mid']; ?>
	<?php $this->widget('Widget_Archive@myCustomCategory', 'type=category', 'mid=' . $mid)->to($categoryPosts); ?>
	<?php while($categoryPosts->next()): ?>
		<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
		    <h2 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $categoryPosts->permalink() ?>"><?php $categoryPosts->title() ?></a></h2>
		    <ul class="post-meta">
			<li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $categoryPosts->author->permalink(); ?>" rel="author"><?php $categoryPosts->author(); ?></a></li>
			<li><?php _e('时间: '); ?><time datetime="<?php $categoryPosts->date('c'); ?>" itemprop="datePublished"><?php $categoryPosts->date('F j, Y'); ?></time></li>
			<li><?php _e('分类: '); ?><?php $categoryPosts->category(','); ?></li>
			<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $categoryPosts->permalink() ?>#comments"><?php $categoryPosts->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></li>
		    </ul>
		    <div class="post-content" itemprop="articleBody">
			<?php $categoryPosts->excerpt(); ?>
		    </div>
		</article>
	<?php endwhile; ?>
	<?php $categoryPosts->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
<?php else: ?>
	<?php $this->need('comments.php') ?>
<?php endif ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
