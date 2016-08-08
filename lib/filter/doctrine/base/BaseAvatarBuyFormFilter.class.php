<?php

/**
 * AvatarBuy filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAvatarBuyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'    => new sfWidgetFormFilterInput(),
      'avatarid'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'boughttime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'userid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'    => new sfValidatorPass(array('required' => false)),
      'avatarid'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'boughttime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('avatar_buy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AvatarBuy';
  }

  public function getFields()
  {
    return array(
      'avatarbuyid' => 'Number',
      'userid'      => 'Number',
      'username'    => 'Text',
      'avatarid'    => 'Number',
      'boughttime'  => 'Date',
    );
  }
}
