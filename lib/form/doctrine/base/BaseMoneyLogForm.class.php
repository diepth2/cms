<?php

/**
 * MoneyLog form base class.
 *
 * @method MoneyLog getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMoneyLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'logid'         => new sfWidgetFormInputHidden(),
      'uuid'          => new sfWidgetFormInputText(),
      'logstamp'      => new sfWidgetFormInputText(),
      'userid'        => new sfWidgetFormInputText(),
      'username'      => new sfWidgetFormInputText(),
      'transactionid' => new sfWidgetFormInputText(),
      'lastcash'      => new sfWidgetFormInputText(),
      'changecash'    => new sfWidgetFormInputText(),
      'currentcash'   => new sfWidgetFormInputText(),
      'lastgold'      => new sfWidgetFormInputText(),
      'changegold'    => new sfWidgetFormInputText(),
      'currentgold'   => new sfWidgetFormInputText(),
      'taxpercent'    => new sfWidgetFormInputText(),
      'taxvalue'      => new sfWidgetFormInputText(),
      'gameid'        => new sfWidgetFormInputText(),
      'insertedtime'  => new sfWidgetFormDateTime(),
      'cp'            => new sfWidgetFormTextarea(),
      'description'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'logid'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('logid')), 'empty_value' => $this->getObject()->get('logid'), 'required' => false)),
      'uuid'          => new sfValidatorString(array('max_length' => 50)),
      'logstamp'      => new sfValidatorInteger(),
      'userid'        => new sfValidatorInteger(),
      'username'      => new sfValidatorString(array('max_length' => 75, 'required' => false)),
      'transactionid' => new sfValidatorInteger(array('required' => false)),
      'lastcash'      => new sfValidatorInteger(),
      'changecash'    => new sfValidatorInteger(),
      'currentcash'   => new sfValidatorInteger(),
      'lastgold'      => new sfValidatorInteger(),
      'changegold'    => new sfValidatorInteger(),
      'currentgold'   => new sfValidatorInteger(),
      'taxpercent'    => new sfValidatorInteger(array('required' => false)),
      'taxvalue'      => new sfValidatorInteger(array('required' => false)),
      'gameid'        => new sfValidatorInteger(array('required' => false)),
      'insertedtime'  => new sfValidatorDateTime(array('required' => false)),
      'cp'            => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('money_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MoneyLog';
  }

}
