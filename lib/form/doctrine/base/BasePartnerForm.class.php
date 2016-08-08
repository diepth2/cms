<?php

/**
 * Partner form base class.
 *
 * @method Partner getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePartnerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'partnerid'   => new sfWidgetFormInputHidden(),
      'partnername' => new sfWidgetFormInputText(),
      'smsnumber'   => new sfWidgetFormInputText(),
      'username'    => new sfWidgetFormInputText(),
      'password'    => new sfWidgetFormInputText(),
      'accesskey1'  => new sfWidgetFormInputText(),
      'accesskey2'  => new sfWidgetFormInputText(),
      'createdtime' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'partnerid'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('partnerid')), 'empty_value' => $this->getObject()->get('partnerid'), 'required' => false)),
      'partnername' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'smsnumber'   => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'username'    => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'password'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'accesskey1'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'accesskey2'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'createdtime' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('partner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Partner';
  }

}
