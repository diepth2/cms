<?php

/**
 * Message form base class.
 *
 * @method Message getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'messageid'         => new sfWidgetFormInputHidden(),
      'senderuserid'      => new sfWidgetFormInputText(),
      'senderusername'    => new sfWidgetFormInputText(),
      'recipientuserid'   => new sfWidgetFormInputText(),
      'recipientusername' => new sfWidgetFormInputText(),
      'title'             => new sfWidgetFormInputText(),
      'body'              => new sfWidgetFormTextarea(),
      'senttime'          => new sfWidgetFormDateTime(),
      'status'            => new sfWidgetFormInputText(),
      'readed'            => new sfWidgetFormInputText(),
      'attachitemid'      => new sfWidgetFormInputText(),
      'attachitemquatity' => new sfWidgetFormInputText(),
      'expiredtime'       => new sfWidgetFormDateTime(),
      'parentid'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'messageid'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('messageid')), 'empty_value' => $this->getObject()->get('messageid'), 'required' => false)),
      'senderuserid'      => new sfValidatorInteger(array('required' => false)),
      'senderusername'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'recipientuserid'   => new sfValidatorInteger(),
      'recipientusername' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'body'              => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'senttime'          => new sfValidatorDateTime(array('required' => false)),
      'status'            => new sfValidatorInteger(array('required' => false)),
      'readed'            => new sfValidatorInteger(array('required' => false)),
      'attachitemid'      => new sfValidatorInteger(array('required' => false)),
      'attachitemquatity' => new sfValidatorInteger(array('required' => false)),
      'expiredtime'       => new sfValidatorDateTime(array('required' => false)),
      'parentid'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Message';
  }

}
