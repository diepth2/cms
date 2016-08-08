<?php

/**
 * DataLog form base class.
 *
 * @method DataLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDataLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'datalogid'    => new sfWidgetFormInputHidden(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'insertedtime' => new sfWidgetFormDateTime(),
      'userid'       => new sfWidgetFormInputText(),
      'username'     => new sfWidgetFormInputText(),
      'matchid'      => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'content'      => new sfWidgetFormTextarea(),
      'clienttype'   => new sfWidgetFormInputText(),
      'matchindex'   => new sfWidgetFormInputText(),
      'duration'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'datalogid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('datalogid')), 'empty_value' => $this->getObject()->get('datalogid'), 'required' => false)),
      'createdtime'  => new sfValidatorDateTime(array('required' => false)),
      'insertedtime' => new sfValidatorDateTime(array('required' => false)),
      'userid'       => new sfValidatorInteger(array('required' => false)),
      'username'     => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'matchid'      => new sfValidatorInteger(array('required' => false)),
      'type'         => new sfValidatorInteger(array('required' => false)),
      'content'      => new sfValidatorString(array('required' => false)),
      'clienttype'   => new sfValidatorInteger(array('required' => false)),
      'matchindex'   => new sfValidatorInteger(array('required' => false)),
      'duration'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('data_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataLog';
  }

}
