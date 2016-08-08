<?php

/**
 * Cpkey form base class.
 *
 * @method Cpkey getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCpkeyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cpkeyid'    => new sfWidgetFormInputHidden(),
      'cpid'       => new sfWidgetFormInputText(),
      'keyconnect' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'cpkeyid'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('cpkeyid')), 'empty_value' => $this->getObject()->get('cpkeyid'), 'required' => false)),
      'cpid'       => new sfValidatorString(array('max_length' => 11, 'required' => false)),
      'keyconnect' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cpkey[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cpkey';
  }

}
