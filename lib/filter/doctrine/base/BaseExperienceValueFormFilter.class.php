<?php

/**
 * ExperienceValue filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseExperienceValueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'increase'          => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'increase'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('experience_value_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExperienceValue';
  }

  public function getFields()
  {
    return array(
      'experiencevalueid' => 'Number',
      'increase'          => 'Number',
      'description'       => 'Text',
    );
  }
}
