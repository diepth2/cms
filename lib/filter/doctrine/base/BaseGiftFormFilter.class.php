<?php

/**
 * Gift filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGiftFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'        => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'createdtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'expiredtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gifttypeid'  => new sfWidgetFormFilterInput(),
      'userid'      => new sfWidgetFormFilterInput(),
      'username'    => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'value'       => new sfWidgetFormFilterInput(),
      'volume'      => new sfWidgetFormFilterInput(),
      'ip'          => new sfWidgetFormFilterInput(),
      'status'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'        => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'createdtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'expiredtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'gifttypeid'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'userid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'    => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'value'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'volume'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip'          => new sfValidatorPass(array('required' => false)),
      'status'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('gift_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gift';
  }

  public function getFields()
  {
    return array(
      'giftid'      => 'Number',
      'code'        => 'Text',
      'name'        => 'Text',
      'createdtime' => 'Date',
      'expiredtime' => 'Date',
      'gifttypeid'  => 'Number',
      'userid'      => 'Number',
      'username'    => 'Text',
      'description' => 'Text',
      'value'       => 'Number',
      'volume'      => 'Number',
      'ip'          => 'Text',
      'status'      => 'Number',
    );
  }
}
