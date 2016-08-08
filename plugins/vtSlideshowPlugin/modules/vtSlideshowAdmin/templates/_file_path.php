<?php if (!$vt_slideshow->getIsFlash()): ?>
  <img src="<?php echo VtSlideshowPluginHelper::getThumbUrl($vt_slideshow->getFilePath(), 50, 50); ?>" width="50" height="50" />
<?php else: ?>
  <?php echo 'FLASH';?>
<?php endif;?>