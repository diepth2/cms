<?php

/**
 * Cp form base class.
 *
 * @method Cp getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCpForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'cpid'         => new sfWidgetFormInputText(),
      'cpname'       => new sfWidgetFormInputText(),
      'createdtime'  => new sfWidgetFormDateTime(),
      'modifiedtime' => new sfWidgetFormDateTime(),
      'cashcurrency' => new sfWidgetFormInputText(),
      'goldcurrency' => new sfWidgetFormInputText(),
      'homepage'     => new sfWidgetFormInputText(),
      'noticetext'   => new sfWidgetFormTextarea(),
      'privatekey'   => new sfWidgetFormTextarea(),
      'status'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cpid'         => new sfValidatorString(array('max_length' => 10)),
      'cpname'       => new sfValidatorString(array('max_length' => 20)),
      'createdtime'  => new sfValidatorDateTime(array('required' => false)),
      'modifiedtime' => new sfValidatorDateTime(array('required' => false)),
      'cashcurrency' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'goldcurrency' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'homepage'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'noticetext'   => new sfValidatorString(array('max_length' => 300)),
      'privatekey'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cp';
  }

}
