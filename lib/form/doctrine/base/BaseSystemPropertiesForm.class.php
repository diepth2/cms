<?php

/**
 * SystemProperties form base class.
 *
 * @method SystemProperties getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSystemPropertiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'key_'         => new sfWidgetFormInputHidden(),
      'value_'       => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'modifiedtime' => new sfWidgetFormDateTime(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'key_'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('key_')), 'empty_value' => $this->getObject()->get('key_'), 'required' => false)),
      'value_'       => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'modifiedtime' => new sfValidatorDateTime(array('required' => false)),
      'createdtime'  => new sfValidatorDateTime(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('system_properties[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SystemProperties';
  }

}
