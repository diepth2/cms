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
class gvManageUserFormFiltersAdmin extends BaseUserFormFilter
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $this->setWidgets(array(
            'username'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'userId'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'displayname'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'mobile'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'device'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'lastLoginTime' => new sfWidgetFormFilterInput(array('with_empty' => false), array('readonly' => true)),


        ));

        $this->setValidators(array(
            'username'     => new sfValidatorPass(array('required' => false)),
            'userId'     => new sfValidatorPass(array('required' => false)),
            'displayname'  => new sfValidatorPass(array('required' => false)),
            'mobile'     => new sfValidatorPass(array('required' => false)),
            'device'      => new sfValidatorPass(array('required' => false)),
            'lastLoginTime' => new sfValidatorDateRange(array('required' => false,
                'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')),
                'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            ));

        $this->widgetSchema->setNameFormat('gv_user_filters[%s]');
        $this->widgetSchema['lastLoginTime']->setLabel($i18n->__("Lần cuối đăng nhập"));
        $this->widgetSchema['device']->setLabel($i18n->__("IME"));

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

    }

    public function doBuildQuery(array $values) {
        $query = parent::doBuildQuery($values);
        $alias = $query->getRootAlias();
        if (array_key_exists('lastLoginTime', $values)) {
            $text = trim($values['lastLoginTime']['text']);
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
                $query->andWhere('g.lastLoginTime BETWEEN ? AND ?', array($date1Str, $date2Str));
            }
        }
        $query->select("g.trustedIndex as trusted_index, g.device as device, 
            g.totalMatch as total_match, g.totalWin as total_win, (g.totalMatch - g.totalWin) as total_lost, g.cash as cash, g.gold as gold, ". $alias . ".*");
        $query->leftJoin($alias. ".UserInfo g");
       // $query->leftJoin($alias. ".LogPayment l");
       // $query->groupBy("l.money");

        return $query;
    }

}
