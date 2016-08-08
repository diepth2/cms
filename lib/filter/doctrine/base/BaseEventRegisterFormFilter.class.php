<?php

/**
 * EventRegister filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEventRegisterFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eventid'         => new sfWidgetFormFilterInput(),
      'username'        => new sfWidgetFormFilterInput(),
      'fullname'        => new sfWidgetFormFilterInput(),
      'email'           => new sfWidgetFormFilterInput(),
      'phone'           => new sfWidgetFormFilterInput(),
      'registeredtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ym'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rank'            => new sfWidgetFormFilterInput(),
      'comment'         => new sfWidgetFormFilterInput(),
      'identity'        => new sfWidgetFormFilterInput(),
      'startcash'       => new sfWidgetFormFilterInput(),
      'status'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'eventid'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'        => new sfValidatorPass(array('required' => false)),
      'fullname'        => new sfValidatorPass(array('required' => false)),
      'email'           => new sfValidatorPass(array('required' => false)),
      'phone'           => new sfValidatorPass(array('required' => false)),
      'registeredtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ym'              => new sfValidatorPass(array('required' => false)),
      'rank'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment'         => new sfValidatorPass(array('required' => false)),
      'identity'        => new sfValidatorPass(array('required' => false)),
      'startcash'       => new sfValidatorPass(array('required' => false)),
      'status'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('event_register_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EventRegister';
  }

  public function getFields()
  {
    return array(
      'eventregisterid' => 'Number',
      'eventid'         => 'Number',
      'username'        => 'Text',
      'fullname'        => 'Text',
      'email'           => 'Text',
      'phone'           => 'Text',
      'registeredtime'  => 'Date',
      'ym'              => 'Text',
      'rank'            => 'Number',
      'comment'         => 'Text',
      'identity'        => 'Text',
      'startcash'       => 'Text',
      'status'          => 'Number',
    );
  }
}
