<?php

/**
 * PluginVtSlideshow form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginVtSlideshowFormFilter extends BaseVtSlideshowFormFilter
{
  public function setup()
  {
    parent::setup();
    $i18n = sfContext::getInstance()->getI18N();
    $this->widgetSchema['is_active'] = new sfWidgetFormChoice(array(
      'choices' => array('' => $i18n->__('All'),
       1 => $i18n->__('Yes'),
       0 => $i18n->__('No'),
    )));
  }
}
