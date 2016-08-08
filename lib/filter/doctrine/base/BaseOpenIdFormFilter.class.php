<?php

/**
 * OpenId filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpenIdFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'channel'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'openid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'displayname' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'channel'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'createdtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'openid'      => new sfValidatorPass(array('required' => false)),
      'displayname' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('open_id_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OpenId';
  }

  public function getFields()
  {
    return array(
      'userid'      => 'Number',
      'channel'     => 'Number',
      'createdtime' => 'Date',
      'openid'      => 'Text',
      'displayname' => 'Text',
    );
  }
}
