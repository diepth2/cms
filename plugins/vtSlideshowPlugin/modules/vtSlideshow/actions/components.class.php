<?php
/**
 * default components.
 *
 * @package    ind
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vtSlideshowComponents extends sfComponents
{
 
  /**
   * Danh sach slideshow trang chu
   * @param sfWebRequest $request
   */
  public function executeListHome(sfWebRequest $request)
  {
  	$this->listSlideshow = VtSlideshowTable::getInstance()->getActivatedItems(sfConfig::get('app_slideshow_num_of_items', 5));
  	$this->w = sfConfig::get('app_slideshow_width');
  	$this->h = sfConfig::get('app_slideshow_height'); 
  }
}
