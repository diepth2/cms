<?php

/**
 * GvTestCase form base class.
 *
 * @method GvTestCase getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGvTestCaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'test_key'    => new sfWidgetFormInputText(),
      'value'       => new sfWidgetFormTextarea(),
      'game_id'     => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'status'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'test_key'    => new sfValidatorString(array('max_length' => 200)),
      'value'       => new sfValidatorString(array('max_length' => 512)),
      'game_id'     => new sfValidatorInteger(),
      'description' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'status'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gv_test_case[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GvTestCase';
  }

}
