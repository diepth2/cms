<?php

/**
 * GcmRegister form base class.
 *
 * @method GcmRegister getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGcmRegisterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gcmregisterid' => new sfWidgetFormInputHidden(),
      'gcmid'         => new sfWidgetFormTextarea(),
      'os'            => new sfWidgetFormInputText(),
      'createdtime'   => new sfWidgetFormDateTime(),
      'modifiedtime'  => new sfWidgetFormDateTime(),
      'cp'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'gcmregisterid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('gcmregisterid')), 'empty_value' => $this->getObject()->get('gcmregisterid'), 'required' => false)),
      'gcmid'         => new sfValidatorString(array('max_length' => 1000)),
      'os'            => new sfValidatorString(array('max_length' => 50)),
      'createdtime'   => new sfValidatorDateTime(),
      'modifiedtime'  => new sfValidatorDateTime(array('required' => false)),
      'cp'            => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gcm_register[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GcmRegister';
  }

}
