<?php

require_once dirname(__FILE__).'/../lib/gvManageMoneyLogGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/gvManageMoneyLogGeneratorHelper.class.php';

/**
 * gvManageMoneyLog actions.
 *
 * @package    Vt_Portals
 * @subpackage gvManageMoneyLog
 * @author     ngoctv1
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gvManageMoneyLogActions extends autoGvManageMoneyLogActions
{
//    public function executeIndex(sfWebRequest $request)
//    {
//        $this->sidebar_status = $this->configuration->getListSidebarStatus();
//        $this->pager = $this->getMoneyLogList();
//    }
//    protected function getMoneyLogList()
//    {
//        $query = $this->buildQuery();
//        $query = MoneyLogTable::getInstance()->createQuery('a');
//        $query->select("COUNT(mo.*), mo.insertedTime, mo.gameId, SUM(mo.taxValue)");
//        $query->from("(select * from money_log where changeGold > 0) mo");
//        $query->where('type=?',VtCommonEnum::MainMenu);
//        $query->andWhere('portal_id=?',sfContext::getInstance()->getUser()->getAttribute('portal',0));
//        $query->andWhere('lang=?',sfContext::getInstance()->getUser()->getCulture());
//        $query->orderby('priority asc');
//        $arrCat= $query->execute();
//
//        $arrResult=array();
//
//        foreach ($arrCat as $cat){
//            $strTab='';
//            if ($cat->level>0){
//                for ($i=0;$i<$cat->level;$i++){
//                    $strTab=$strTab.'...';
//                }
//            }
//            $arrResult[$cat->id] = $strTab. $cat->name;
//        }
//
//        return $arrResult;
//    }
}
