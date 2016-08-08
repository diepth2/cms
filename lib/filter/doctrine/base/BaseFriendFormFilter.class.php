<?php

/**
 * Friend filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFriendFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'leftuserid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rightuserid'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'acceptedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'leftuserid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rightuserid'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'createdtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'acceptedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('friend_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friend';
  }

  public function getFields()
  {
    return array(
      'friendid'     => 'Number',
      'leftuserid'   => 'Number',
      'rightuserid'  => 'Number',
      'createdtime'  => 'Date',
      'acceptedtime' => 'Date',
      'status'       => 'Number',
    );
  }
}
