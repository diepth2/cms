<?php if (!count($listSlideshow)) return '';?>
<?php 
  use_stylesheet('/vtSlideshowPlugin/css/feature-carousel.css');
  use_javascript('/vtSlideshowPlugin/js/jquery.featureCarousel.min.js');
   use_javascript('/vtSlideshowPlugin/js/slideshow.js');
?>

<div id="carousel-container">
    <div id="carousel">
        <?php foreach ($listSlideshow as $index => $slideshow): ?>
            <?php $media = $slideshow->getFilePath();?>
            <?php if ($media):?>
                <div class="carousel-feature">
                    <?php if (!$slideshow->getIsFlash()): ?>
                        <?php if ($slideshow->getUrl()): ?>
                            <a href="<?php echo $slideshow->getUrl();?>" target="_blank">
                                <img src="<?php echo VtSlideshowPluginHelper::getThumbUrl($media, $w, $h)?>" />
                            </a>
                        <?php else: ?>
                            <img src="<?php echo VtSlideshowPluginHelper::getThumbUrl($media, $w, $h)?>" />
                        <?php endif;?>
                    <?php else: ?>
                        <object height="<?php echo $h;?>" width="<?php echo $w; ?>"
                            classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0">
                            <param value="link=<?php echo $slideshow->getUrl(); ?>" name="flashvars">
                            <param name="movie" value="<?php echo $slideshow->getFilePath(); ?>">
                            <param name="wmode" value="opaque">
                            <embed height="<?php echo $h; ?>" width="<?php echo $w; ?>" flashvars="link=<?php echo $slideshow->getUrl(); ?>"
                            type="application/x-shockwave-flash"
                            pluginspage="http://www.macromedia.com/go/getflashplayer"
                            src="<?php echo $slideshow->getFilePath();?>" wmode="opaque" />
                        </object>
                    <?php endif;?>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div id="carousel-left"><img src="/vtSlideshowPlugin/images/mstore_06b.png" /></div>
    <div id="carousel-right"><img src="/vtSlideshowPlugin/images/mstore_07b.png" /></div>

</div>


