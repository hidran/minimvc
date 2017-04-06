<?php foreach ($posts as $post): ?>
<article>
    <h2><a href="/post/<?=$post->id?>"><?= htmlentities($post->title) ?></a></h2>
    <p>
        <time datetime="<?=$post->datecreated?>"><?=$post->datecreated?></time>
        by <span><a href="mailto:<?=$post->email?>"><?=$post->email?></a></span>
    </p>
    <?= htmlentities($post->message);?>
</article>
<?php endforeach; ?>
