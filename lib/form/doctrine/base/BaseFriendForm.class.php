<?php

/**
 * Friend form base class.
 *
 * @method Friend getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFriendForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'friendid'     => new sfWidgetFormInputHidden(),
      'leftuserid'   => new sfWidgetFormInputText(),
      'rightuserid'  => new sfWidgetFormInputText(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'acceptedtime' => new sfWidgetFormDateTime(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'friendid'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('friendid')), 'empty_value' => $this->getObject()->get('friendid'), 'required' => false)),
      'leftuserid'   => new sfValidatorInteger(),
      'rightuserid'  => new sfValidatorInteger(),
      'createdtime'  => new sfValidatorDateTime(),
      'acceptedtime' => new sfValidatorDateTime(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friend[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friend';
  }

}
