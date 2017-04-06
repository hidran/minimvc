
<article>
    <h1><?=$post->title?></h1>
    <p>
        <time datetime="<?=$post->datecreated?>"><?=$post->datecreated?></time>
        by <span><a href="mailto:<?=$post->email?>"><?=$post->email?></a></span>
    </p>
    <div><?=$post->message?></div>
</article>
