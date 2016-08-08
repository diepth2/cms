<?php

/**
 * PasswordUpdate filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePasswordUpdateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'           => new sfWidgetFormFilterInput(),
      'username'         => new sfWidgetFormFilterInput(),
      'log'              => new sfWidgetFormFilterInput(),
      'updatetime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'mysql_user'       => new sfWidgetFormFilterInput(),
      'oldpass'          => new sfWidgetFormFilterInput(),
      'newpass'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'         => new sfValidatorPass(array('required' => false)),
      'log'              => new sfValidatorPass(array('required' => false)),
      'updatetime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'mysql_user'       => new sfValidatorPass(array('required' => false)),
      'oldpass'          => new sfValidatorPass(array('required' => false)),
      'newpass'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('password_update_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PasswordUpdate';
  }

  public function getFields()
  {
    return array(
      'passwordupdateid' => 'Number',
      'userid'           => 'Number',
      'username'         => 'Text',
      'log'              => 'Text',
      'updatetime'       => 'Date',
      'mysql_user'       => 'Text',
      'oldpass'          => 'Text',
      'newpass'          => 'Text',
    );
  }
}
