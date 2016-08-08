<?php

/**
 * History form base class.
 *
 * @method History getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'historyid'         => new sfWidgetFormInputHidden(),
      'userid'            => new sfWidgetFormInputText(),
      'username'          => new sfWidgetFormInputText(),
      'cash'              => new sfWidgetFormInputText(),
      'currentcash'       => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'gameid'            => new sfWidgetFormInputText(),
      'transactiontypeid' => new sfWidgetFormInputText(),
      'time'              => new sfWidgetFormDateTime(),
      'money'             => new sfWidgetFormInputText(),
      'cp'                => new sfWidgetFormTextarea(),
      'title'             => new sfWidgetFormTextarea(),
      'iscoin'            => new sfWidgetFormInputText(),
      'cardtype'          => new sfWidgetFormInputText(),
      'shortcode'         => new sfWidgetFormInputText(),
      'telco'             => new sfWidgetFormInputText(),
      'status'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'historyid'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('historyid')), 'empty_value' => $this->getObject()->get('historyid'), 'required' => false)),
      'userid'            => new sfValidatorInteger(),
      'username'          => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'cash'              => new sfValidatorInteger(),
      'currentcash'       => new sfValidatorInteger(),
      'description'       => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'gameid'            => new sfValidatorInteger(array('required' => false)),
      'transactiontypeid' => new sfValidatorInteger(array('required' => false)),
      'time'              => new sfValidatorDateTime(array('required' => false)),
      'money'             => new sfValidatorInteger(array('required' => false)),
      'cp'                => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'iscoin'            => new sfValidatorInteger(array('required' => false)),
      'cardtype'          => new sfValidatorInteger(array('required' => false)),
      'shortcode'         => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'telco'             => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'status'            => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'History';
  }

}
