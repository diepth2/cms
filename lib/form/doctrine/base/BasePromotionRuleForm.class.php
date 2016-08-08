<?php

/**
 * PromotionRule form base class.
 *
 * @method PromotionRule getObject() Returns the current form's model object
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePromotionRuleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'promotionruleid' => new sfWidgetFormInputHidden(),
      'starttime'       => new sfWidgetFormDateTime(),
      'endtime'         => new sfWidgetFormDateTime(),
      'card'            => new sfWidgetFormInputText(),
      'sms'             => new sfWidgetFormInputText(),
      'isactive'        => new sfWidgetFormInputText(),
      'title'           => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'specialcard'     => new sfWidgetFormInputText(),
      'tierprice'       => new sfWidgetFormInputText(),
      'cp'              => new sfWidgetFormInputText(),
      'highspecialcard' => new sfWidgetFormInputText(),
      'hightierprice'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'promotionruleid' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('promotionruleid')), 'empty_value' => $this->getObject()->get('promotionruleid'), 'required' => false)),
      'starttime'       => new sfValidatorDateTime(array('required' => false)),
      'endtime'         => new sfValidatorDateTime(array('required' => false)),
      'card'            => new sfValidatorInteger(array('required' => false)),
      'sms'             => new sfValidatorInteger(array('required' => false)),
      'isactive'        => new sfValidatorInteger(array('required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'specialcard'     => new sfValidatorInteger(array('required' => false)),
      'tierprice'       => new sfValidatorInteger(array('required' => false)),
      'cp'              => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'highspecialcard' => new sfValidatorInteger(array('required' => false)),
      'hightierprice'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('promotion_rule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PromotionRule';
  }

}
