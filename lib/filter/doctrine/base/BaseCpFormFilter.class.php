<?php

/**
 * Cp filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCpFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cpid'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cpname'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'createdtime'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modifiedtime' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cashcurrency' => new sfWidgetFormFilterInput(),
      'goldcurrency' => new sfWidgetFormFilterInput(),
      'homepage'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'noticetext'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'privatekey'   => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'cpid'         => new sfValidatorPass(array('required' => false)),
      'cpname'       => new sfValidatorPass(array('required' => false)),
      'createdtime'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modifiedtime' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cashcurrency' => new sfValidatorPass(array('required' => false)),
      'goldcurrency' => new sfValidatorPass(array('required' => false)),
      'homepage'     => new sfValidatorPass(array('required' => false)),
      'noticetext'   => new sfValidatorPass(array('required' => false)),
      'privatekey'   => new sfValidatorPass(array('required' => false)),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('cp_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cp';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'cpid'         => 'Text',
      'cpname'       => 'Text',
      'createdtime'  => 'Date',
      'modifiedtime' => 'Date',
      'cashcurrency' => 'Text',
      'goldcurrency' => 'Text',
      'homepage'     => 'Text',
      'noticetext'   => 'Text',
      'privatekey'   => 'Text',
      'status'       => 'Number',
    );
  }
}
