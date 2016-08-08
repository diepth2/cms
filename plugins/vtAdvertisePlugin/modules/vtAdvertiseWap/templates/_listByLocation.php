<?php
/**
 * Hien thi danh sach quang cao (anh & link) voi tuy chon
 * @author dongvt1
 * @created on 23/04/2013
 */
?>
<?php if (count($listAdvertise)): ?>
<div class="mdl-adv">
  <?php foreach ($listAdvertise as $adv): ?>
    <?php if ($adv->getIsFlash()!=1):?>
      <?php if(!$adv->getUrl()): ?>

            <img src="<?php echo VtHelper::getThumbUrl($adv->getMediaPath(),240); ?>" width="100%" />

      <?php else: ?>

          <a target="_blank" href="<?php echo $adv->getUrl() ?>">
            <img src="<?php echo VtHelper::getThumbUrl($adv->getMediaPath(),240); ?>" width="100%"/>
          </a>

      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>