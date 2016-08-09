<?php

require_once dirname(__FILE__).'/../lib/gvManagerUserRegisterGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/gvManagerUserRegisterGeneratorHelper.class.php';

/**
 * gvManagerUserRegister actions.
 *
 * @package    Vt_Portals
 * @subpackage gvManagerUserRegister
 * @author     diepth2
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gvManagerUserRegisterActions extends autoGvManagerUserRegisterActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
        {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page'))
        {
            $this->setPage($request->getParameter('page'));
        }
        else
        {
            $this->setPage(1);
        }

        // max per page
        if ($request->getParameter('max_per_page'))
        {
            $this->setMaxPerPage($request->getParameter('max_per_page'));
        }

        $this->sidebar_status = $this->configuration->getListSidebarStatus();
        $this->pager = $this->getPager();

        //Start - thongnq1 - 03/05/2013 - fix loi xoa du lieu tren trang danh sach
        if ($request->getParameter('current_page'))
        {
            $current_page = $request->getParameter('current_page');
            $this->setPage($current_page);
            $this->pager = $this->getPager();
        }
        //end thongnq1

        $this->sort = $this->getSort();
        $this->total_by_os = UserInfoTable::getTotalUserByOs();

        $day = 60*60*24; $day_7 = time() - 6*$day;
        $register_info = UserTable::getRegisterInfo(date("Y-m-d", $day_7) . "00:00:00");
        $created_at = array();
        foreach($register_info as $date){
            $created_at[$date['date']] = $date['count'];
        }

        $sevent_day = array();
        for($i=0; $i<7; $i++) {
            $sevent_day[date("d/m/Y", $day_7 + $i* $day)] = array(
                isset($created_at[date("Y-m-d", $day_7 + $i* $day)]) ? $created_at[date("Y-m-d", $day_7 + $i* $day)]: 0);
        }
        $this->sevent_day = $sevent_day;
    }
}
