<?php if (!$vt_advertise->getIsFlash()): ?>
<img src="
     <?php echo VtHelper::getThumbUrl($vt_advertise->getMediaPath(), 50, 50); ?>
      " width="50" height="50"/>
<?php else: ?>
<?php echo 'FLASH'; ?>
<?php endif; ?>
