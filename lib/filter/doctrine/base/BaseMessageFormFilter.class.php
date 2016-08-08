<?php

/**
 * Message filter form base class.
 *
 * @package    Vt_Portals
 * @subpackage filter
 * @author     diepth2
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMessageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'senderuserid'      => new sfWidgetFormFilterInput(),
      'senderusername'    => new sfWidgetFormFilterInput(),
      'recipientuserid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recipientusername' => new sfWidgetFormFilterInput(),
      'title'             => new sfWidgetFormFilterInput(),
      'body'              => new sfWidgetFormFilterInput(),
      'senttime'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'readed'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'attachitemid'      => new sfWidgetFormFilterInput(),
      'attachitemquatity' => new sfWidgetFormFilterInput(),
      'expiredtime'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'parentid'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'senderuserid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'senderusername'    => new sfValidatorPass(array('required' => false)),
      'recipientuserid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'recipientusername' => new sfValidatorPass(array('required' => false)),
      'title'             => new sfValidatorPass(array('required' => false)),
      'body'              => new sfValidatorPass(array('required' => false)),
      'senttime'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'status'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'readed'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'attachitemid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'attachitemquatity' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expiredtime'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'parentid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('message_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Message';
  }

  public function getFields()
  {
    return array(
      'messageid'         => 'Number',
      'senderuserid'      => 'Number',
      'senderusername'    => 'Text',
      'recipientuserid'   => 'Number',
      'recipientusername' => 'Text',
      'title'             => 'Text',
      'body'              => 'Text',
      'senttime'          => 'Date',
      'status'            => 'Number',
      'readed'            => 'Number',
      'attachitemid'      => 'Number',
      'attachitemquatity' => 'Number',
      'expiredtime'       => 'Date',
      'parentid'          => 'Number',
    );
  }
}
