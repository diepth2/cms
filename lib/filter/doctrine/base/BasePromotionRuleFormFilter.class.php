<?php

/**
 * PromotionRule filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePromotionRuleFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'starttime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'endtime'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'card'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sms'             => new sfWidgetFormFilterInput(),
      'isactive'        => new sfWidgetFormFilterInput(),
      'title'           => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'specialcard'     => new sfWidgetFormFilterInput(),
      'tierprice'       => new sfWidgetFormFilterInput(),
      'cp'              => new sfWidgetFormFilterInput(),
      'highspecialcard' => new sfWidgetFormFilterInput(),
      'hightierprice'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'starttime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'endtime'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'card'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sms'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'isactive'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'           => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'specialcard'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tierprice'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cp'              => new sfValidatorPass(array('required' => false)),
      'highspecialcard' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hightierprice'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('promotion_rule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PromotionRule';
  }

  public function getFields()
  {
    return array(
      'promotionruleid' => 'Number',
      'starttime'       => 'Date',
      'endtime'         => 'Date',
      'card'            => 'Number',
      'sms'             => 'Number',
      'isactive'        => 'Number',
      'title'           => 'Text',
      'description'     => 'Text',
      'specialcard'     => 'Number',
      'tierprice'       => 'Number',
      'cp'              => 'Text',
      'highspecialcard' => 'Number',
      'hightierprice'   => 'Number',
    );
  }
}
