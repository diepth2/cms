<?php

/**
 * History filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'          => new sfWidgetFormFilterInput(),
      'cash'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'currentcash'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gameid'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'transactiontypeid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'money'             => new sfWidgetFormFilterInput(),
      'cp'                => new sfWidgetFormFilterInput(),
      'title'             => new sfWidgetFormFilterInput(),
      'iscoin'            => new sfWidgetFormFilterInput(),
      'cardtype'          => new sfWidgetFormFilterInput(),
      'shortcode'         => new sfWidgetFormFilterInput(),
      'telco'             => new sfWidgetFormFilterInput(),
      'status'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'          => new sfValidatorPass(array('required' => false)),
      'cash'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currentcash'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'       => new sfValidatorPass(array('required' => false)),
      'gameid'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transactiontypeid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'time'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'money'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cp'                => new sfValidatorPass(array('required' => false)),
      'title'             => new sfValidatorPass(array('required' => false)),
      'iscoin'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cardtype'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shortcode'         => new sfValidatorPass(array('required' => false)),
      'telco'             => new sfValidatorPass(array('required' => false)),
      'status'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'History';
  }

  public function getFields()
  {
    return array(
      'historyid'         => 'Number',
      'userid'            => 'Number',
      'username'          => 'Text',
      'cash'              => 'Number',
      'currentcash'       => 'Number',
      'description'       => 'Text',
      'gameid'            => 'Number',
      'transactiontypeid' => 'Number',
      'time'              => 'Date',
      'money'             => 'Number',
      'cp'                => 'Text',
      'title'             => 'Text',
      'iscoin'            => 'Number',
      'cardtype'          => 'Number',
      'shortcode'         => 'Text',
      'telco'             => 'Text',
      'status'            => 'Number',
    );
  }
}
