<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eventid'      => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'content'      => new sfWidgetFormTextarea(),
      'starttime'    => new sfWidgetFormDateTime(),
      'endtime'      => new sfWidgetFormDateTime(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'author'       => new sfWidgetFormInputText(),
      'daily'        => new sfWidgetFormInputText(),
      'weekly'       => new sfWidgetFormInputText(),
      'monthly'      => new sfWidgetFormInputText(),
      'photo'        => new sfWidgetFormInputText(),
      'cp'           => new sfWidgetFormInputText(),
      'regstarttime' => new sfWidgetFormDateTime(),
      'regendtime'   => new sfWidgetFormDateTime(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'eventid'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eventid')), 'empty_value' => $this->getObject()->get('eventid'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'      => new sfValidatorString(array('max_length' => 5000, 'required' => false)),
      'starttime'    => new sfValidatorDateTime(array('required' => false)),
      'endtime'      => new sfValidatorDateTime(array('required' => false)),
      'createdtime'  => new sfValidatorDateTime(array('required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'daily'        => new sfValidatorInteger(array('required' => false)),
      'weekly'       => new sfValidatorInteger(array('required' => false)),
      'monthly'      => new sfValidatorInteger(array('required' => false)),
      'photo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cp'           => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'regstarttime' => new sfValidatorDateTime(array('required' => false)),
      'regendtime'   => new sfValidatorDateTime(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
