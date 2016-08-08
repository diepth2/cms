<?php

/**
 * PluginVtAdvertise form.
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginVtAdvertiseForm extends BaseVtAdvertiseForm
{
  public function setup()
  {
    parent::setup();

    unset($this['id'], $this['created_at'], $this['updated_at']);
    $i18n = sfContext::getInstance()->getI18N();
    $maxSizeMb = intval(sfConfig::get('app_slide_maxsize', 5242880)) / 1024 / 1024;

    // validator Ten
    $this->validatorSchema['name'] = new sfValidatorString(array(
      'max_length' => 100,
      'required'   => true,
      'trim'       => true,
    ));

    //media_path
    $this->widgetSchema['media_path'] = new VtWidgetFormInputFile(array(
      'file_src'  => $this->getObject()->getMediaPath(),
      'is_image'  => true,
      'edit_mode' => $this->getObject()->getMediaPath(),));
    $this->validatorSchema['media_path'] = new sfValidatorFile(array(
      'max_size'   => sfConfig::get('app_slide_maxsize', 5242880),
      'mime_types' => array('application/x-shockwave-flash', 'image/jpeg', 'image/png', 'image/gif'), //you can set your own of course
      'path'       => sfConfig::get('sf_web_dir') . VtADVHelper::generatePath('adv'),
      'required'   => false,
    ), array('max_size' => $i18n->__('File is too large (maximum is %max_size%Mb)', array('%max_size%' => $maxSizeMb))));

    // them comment ho tro upload anh
//    $this->widgetSchema->setHelp('media_path', $i18n->__('Recommend: Image should be image-large,') .
//        '<br/>' . 'WEB :320xAuto, WAP: 240xAuto. ' . $i18n->__('File is not too large %max_size%Mb.', array('%max_size%' => $maxSizeMb)));

    $this->validatorSchema['url'] = new sfValidatorUrl(array('max_length' => 255, 'trim' => true, 'required' => false),
      array('max_length' => $i18n->__('Value is too long!')));

    //start_time & end_time
    $this->widgetSchema['start_time'] = new sfWidgetFormDateTimePicker(array('default' => 'now'), array('id' => 'start_time'));
    $this->validatorSchema['start_time'] = new sfValidatorDateTimePicker(array(
      'required'                => true,
      'date_format'             => '~(?P<day>\d{2})-(?P<month>\d{2})-(?P<year>\d{4}) (?P<hour>\d{2}):(?P<minute>\d{2})~',
      'date_output'             => 'd-m-Y',
      'datetime_output'         => 'd-m-Y H:i',
      'date_format_error'       => 'd-m-Y H:i',
      'date_format_range_error' => 'd-m-Y H:i'
    ));
    $this->widgetSchema['end_time'] = new sfWidgetFormDateTimePicker(array('default' => 'now'), array('id' => 'end_time'));
    $this->validatorSchema['end_time'] = new sfValidatorDateTimePicker(array(
      'required'                => true,
      'date_format'             => '~(?P<day>\d{2})-(?P<month>\d{2})-(?P<year>\d{4}) (?P<hour>\d{2}):(?P<minute>\d{2})~',
      'date_output'             => 'd-m-Y',
      'datetime_output'         => 'd-m-Y H:i',
      'date_format_error'       => 'd-m-Y H:i',
      'date_format_range_error' => 'd-m-Y H:i'
    ));

    //validate do uu tien
    $this->validatorSchema['priority'] = new sfValidatorNumber(array(
        'min'      => 0,
        'max'      => 999999,
        'required' => false,
      ),
      array('max'     => $i18n->__('"%value%" must be at most %max%.'),
            'min'     => $i18n->__('"%value%" must be at least %min%.'),
            'invalid' => $i18n->__('"%value%" is not an integer.'),
      )
    );

    // widget va validator vi tri quang cao
    $this->widgetSchema['location_list'] = new sfWidgetFormDoctrineChoice(array(
      'multiple' => true,
      'model'    => 'VtAdvertiseLocation',
      'method'   => 'getTemplate',
    ));
    $this->validatorSchema['location_list'] = new sfValidatorDoctrineChoice(array(
      'multiple' => true,
      'model'    => 'VtAdvertiseLocation',
      'required' => true
    ));

    //validate start_time & end_time
    $this->mergePostValidator(new sfValidatorSchemaCompare('start_time', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'end_time', array(), array('invalid' => $i18n->__('Start date must be before end date'))));

    // Set lai validator cho image_path khi tao moi
    $this->validatorSchema['media_path']->setOption('required', $this->isNew());
    $this->setDefault('is_active', false);

  }

  /**
   * Xu ly luu duong dan vao media path
   * @author dongvt1
   * @return $values
   */
  public function processValues($values)
  {
    $values = parent::processValues($values);
    $values['name'] = trim($values['name']);
    $values['url'] = trim($values['url']);
    if (substr($values['media_path'], 0, 1) != '/' && !empty($values['media_path'])) {
      $values['media_path'] = VtADVHelper::generatePath('adv') . $values['media_path'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    @$mimeType = finfo_file($finfo, sfConfig::get('sf_web_dir') . '/' . $values['media_path']);

    if ($mimeType == 'application/x-shockwave-flash') {
      $values['is_flash'] = 1;
    }
    return $values;
  }
}
