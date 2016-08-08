<?php

/**
 * PluginVtAdvertise form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     dongvt1
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginVtAdvertiseFormFilter extends BaseVtAdvertiseFormFilter
{
  public function setup()
  {
    parent::setup();
    $i18n = sfContext::getInstance()->getI18N();
    $this->widgetSchema['location_list'] = new sfWidgetFormDoctrineChoice(array(
      'multiple' => false,
      'model'    => 'VtAdvertiseLocation',
      'expanded' => false,
      'method' => 'getTemplate',
      'add_empty'=>$i18n->__('All')
    ));
    $this->validatorSchema['location_list'] = new sfValidatorDoctrineChoice(array(
      'multiple' => true,
      'model'    => 'VtAdvertiseLocation',
      'required' => false,
    ));
  }
}
