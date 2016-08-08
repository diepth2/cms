<?php if ($listPager && $listPager->haveToPaginate()) : ?>
<?php $params = (isset($params)) ? ($params) : ''; ?>
<?php
  $pages = $listPager->getLinks();
  $countPage = count($pages);
  ?>

<div class="pagging" align="center">
  <?php if ($listPager->getLastPage() > 5 && $listPager->getPage() >= 4): ?>
  <a page_num="<?php echo $listPager->getFirstPage(); ?>" class="first" href="?page=<?php echo $listPager->getFirstPage(); ?><?php echo $params ?>"></a>
  <a page_num="<?php echo $listPager->getPreviousPage(); ?>" class="previous" href="?page=<?php echo $listPager->getPreviousPage(); ?><?php echo $params ?>"></a>
  <?php endif;?>

  <?php foreach ($pages as $key => $page) : ?>
  <?php if ($page == $listPager->getPage()): ?>
    <a page_num="<?php echo $page; ?>" class="active" href="javascript:void(0)"><?php echo $page ?></a>
    <?php else: ?>
    <a page_num="<?php echo $page; ?>" href="?page=<?php echo $page ?><?php echo $params ?>"><?php echo $page ?></a>
    <?php endif; ?>

  <?php if($key != ($countPage - 1)): ?>
    <span class="dot">.</span>
    <?php endif;?>
  <?php endforeach; ?>

  <?php if ($listPager->getLastPage() > 5 && $listPager->getPage() != $listPager->getLastPage()): ?>
  <a page_num="<?php echo $listPager->getNextPage(); ?>"  class="next" href="?page=<?php echo $listPager->getNextPage(); ?><?php echo $params ?>"></a>
  <a page_num="<?php echo $listPager->getLastPage(); ?>" class="last" href="?page=<?php echo $listPager->getLastPage(); ?><?php echo $params ?>"></a>
  <?php endif; ?>
</div>
<?php endif;?>

