<?php

/**
 * VtUserSigninLock filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVtUserSigninLockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'    => new sfWidgetFormFilterInput(),
      'created_time' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_name'    => new sfValidatorPass(array('required' => false)),
      'created_time' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('vt_user_signin_lock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VtUserSigninLock';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_name'    => 'Text',
      'created_time' => 'Number',
    );
  }
}
