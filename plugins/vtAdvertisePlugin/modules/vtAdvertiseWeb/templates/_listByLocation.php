<?php
/**
 * Hien thi danh sach quang cao (anh & link) voi tuy chon
 * @author dongvt1
 * @created on 17/4/2013
 */
?>
<?php if (count($listAdvertise)>0): ?>
  <div class="mdl-adv">
  <h6>Quảng cáo</h6>
  <?php foreach ($listAdvertise as $adv): ?>
    <?php if ($adv->getIsFlash()!=1):?>
      <?php if(!$adv->getUrl()): ?>
        <div>
            <img src="<?php echo VtADVHelper::getThumbUrl($adv->getMediaPath(), 320); ?>" width="100%"/>
        </div>
      <?php else: ?>
        <div>
          <a target="_blank" href="<?php echo $adv->getUrl() ?>">
            <img src="<?php echo VtADVHelper::getThumbUrl($adv->getMediaPath(), 320); ?>" width="100%"/>
          </a>
        </div>
      <?php endif; ?>
    <?php else:?>
      <object height="320px" width="auto"
              classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0">
        <param value="link=<?php echo $adv->getUrl() ? $adv->getUrl():'#'; ?>" name="flashvars">
        <param name="movie" value="<?php echo $adv->getMediaPath(); ?>">
        <param name="wmode" value="opaque">
        <embed height="320px" width="auto" flashvars="link=<?php echo $adv->getUrl() ? $adv->getUrl():'#'; ?>"
               type="application/x-shockwave-flash"
               pluginspage="http://www.macromedia.com/go/getflashplayer"
               src="<?php echo $adv->getMediaPath();?>"
               wmode="opaque"/>
      </object>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>
<?php endif; ?>