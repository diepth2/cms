<?php

/**
 * CmsUser filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCmsUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'         => new sfWidgetFormFilterInput(),
      'create_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modified_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'email'             => new sfWidgetFormFilterInput(),
      'phone'             => new sfWidgetFormFilterInput(),
      'mobile'            => new sfWidgetFormFilterInput(),
      'gender'            => new sfWidgetFormFilterInput(),
      'date_of_birth'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'birth_place'       => new sfWidgetFormFilterInput(),
      'first_name'        => new sfWidgetFormFilterInput(),
      'middle_name'       => new sfWidgetFormFilterInput(),
      'last_name'         => new sfWidgetFormFilterInput(),
      'status'            => new sfWidgetFormFilterInput(),
      'password'          => new sfWidgetFormFilterInput(),
      'dept_id'           => new sfWidgetFormFilterInput(),
      'address'           => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'verification_code' => new sfWidgetFormFilterInput(),
      'cp'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_name'         => new sfValidatorPass(array('required' => false)),
      'create_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'modified_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'email'             => new sfValidatorPass(array('required' => false)),
      'phone'             => new sfValidatorPass(array('required' => false)),
      'mobile'            => new sfValidatorPass(array('required' => false)),
      'gender'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_of_birth'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'birth_place'       => new sfValidatorPass(array('required' => false)),
      'first_name'        => new sfValidatorPass(array('required' => false)),
      'middle_name'       => new sfValidatorPass(array('required' => false)),
      'last_name'         => new sfValidatorPass(array('required' => false)),
      'status'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'password'          => new sfValidatorPass(array('required' => false)),
      'dept_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'address'           => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'verification_code' => new sfValidatorPass(array('required' => false)),
      'cp'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cms_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CmsUser';
  }

  public function getFields()
  {
    return array(
      'user_id'           => 'Number',
      'user_name'         => 'Text',
      'create_date'       => 'Date',
      'modified_date'     => 'Date',
      'email'             => 'Text',
      'phone'             => 'Text',
      'mobile'            => 'Text',
      'gender'            => 'Number',
      'date_of_birth'     => 'Date',
      'birth_place'       => 'Text',
      'first_name'        => 'Text',
      'middle_name'       => 'Text',
      'last_name'         => 'Text',
      'status'            => 'Number',
      'password'          => 'Text',
      'dept_id'           => 'Number',
      'address'           => 'Text',
      'description'       => 'Text',
      'verification_code' => 'Text',
      'cp'                => 'Text',
    );
  }
}
