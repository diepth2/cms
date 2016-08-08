<?php

/**
 * Notification filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNotificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pushmessage'    => new sfWidgetFormFilterInput(),
      'pushnumber'     => new sfWidgetFormFilterInput(),
      'pushtime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cp'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pushmessage'    => new sfValidatorPass(array('required' => false)),
      'pushnumber'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pushtime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cp'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notification';
  }

  public function getFields()
  {
    return array(
      'notificationid' => 'Number',
      'pushmessage'    => 'Text',
      'pushnumber'     => 'Number',
      'pushtime'       => 'Date',
      'cp'             => 'Text',
    );
  }
}
