<?php

/**
 * Option form base class.
 *
 * @method Option getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOptionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'optionid'    => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'value'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'optionid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('optionid')), 'empty_value' => $this->getObject()->get('optionid'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 20)),
      'description' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'value'       => new sfValidatorString(array('max_length' => 4000)),
    ));

    $this->widgetSchema->setNameFormat('option[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Option';
  }

}
