<?php

/**
 * ExperienceValue form base class.
 *
 * @method ExperienceValue getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExperienceValueForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'experiencevalueid' => new sfWidgetFormInputHidden(),
      'increase'          => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'experiencevalueid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('experiencevalueid')), 'empty_value' => $this->getObject()->get('experiencevalueid'), 'required' => false)),
      'increase'          => new sfValidatorInteger(array('required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('experience_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExperienceValue';
  }

}
