<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseVtpEmailFormFilter
 *
 * @author ngoctv1
 */
class gvManageUserRegisterFormFiltersAdmin extends BaseUserFormFilter
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $arr_type = array_merge(array('' => $i18n->__("Tất cả")), ClientTypeTable::getListClientTypeForSelectBox());
        $arr_cp = array_merge(array('' => $i18n->__("Tất cả")), PartnerTable::getListPartnerForSelectBox());

        $this->setWidgets(array(
            'clientId' => new sfWidgetFormChoice(array('choices' => $arr_type), array('add_empty' => true)),
            'ip'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'cp' => new sfWidgetFormChoice(array('choices' => $arr_cp), array('add_empty' => true)),

            'registedtime' => new sfWidgetFormFilterInput(array('with_empty' => false), array('readonly' => true)),


        ));

        $this->setValidators(array(
            'clientId' => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($arr_type))),
            'ip'     => new sfValidatorPass(array('required' => false)),
            'cp' => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($arr_type))),
            'registedtime' => new sfValidatorDateRange(array('required' => false,
                'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')),
                'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            ));

        $this->widgetSchema->setNameFormat('gv_user_register_filters[%s]');
        $this->widgetSchema['registedtime']->setLabel($i18n->__("Thời gian đăng ký"));
        $this->widgetSchema['clientId']->setLabel($i18n->__("Bản build"));

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

    }

    public function doBuildQuery(array $values) {
        $query = parent::doBuildQuery($values);
        $alias = $query->getRootAlias();
        if (array_key_exists('registedtime', $values)) {
            $text = trim($values['registedtime']['text']);
            $dateArr = explode('-', $text);
            if (count($dateArr) == 2) {
                $date1 = trim($dateArr[0]);
                $date1Arr = explode('/', $date1);
                $date1Str = '';
                if (count($date1Arr) == 3) {
                    $date1Str = $date1Arr[2] . '-' . $date1Arr[1] . '-' . $date1Arr[0] . ' 00:00:00';
                }
                $date2 = trim($dateArr[1]);
                $date2Arr = explode('/', $date2);
                $date2Str = '';
                if (count($date2Arr) == 3) {
                    $date2Str = $date2Arr[2] . '-' . $date2Arr[1] . '-' . $date2Arr[0] . ' 23:59:59';
                }
                $query->andWhere($alias. '.registedtime BETWEEN ? AND ?', array($date1Str, $date2Str));
            }
        }
        if(array_key_exists('clientId', $values) && $values['clientId'] != ''){
            $query->andWhere("g.clientId = ?", $values["clientId"] );
        }
        // var_dump($values);die;
        if(array_key_exists('cp', $values)&& $values['cp'] != ''){
            $query->andWhere("g.cp = ?",$values["cp"] );
        }
        $query->select("p.partnerName as parter_name, c.name as os_build, g.deviceIdentify as imei,". $alias . ".*");
        $query->leftJoin($alias. ".UserInfo g");
        $query->leftJoin("g.Partner p");
        $query->leftJoin("g.ClientType c");
        $query->orderBy($alias.  ".registedtime desc");
        return $query;
    }

}
