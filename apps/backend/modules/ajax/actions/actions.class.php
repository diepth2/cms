<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author diepth2
 */
class ajaxActions extends sfActions{
    //put your code here
    // Biểu đồ bên trang chủ Publisher + Đối soát

    public function executeLoadChartData(sfWebRequest $request)
    {
        $this->checkLoginForAjax();
        //
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $token = $request->getParameter('token',0);
        if ($form->getCSRFToken() != $token){
            return $this->renderText(json_encode(array('notice' => $i18n->__('Giá trị token không hợp lệ.'))));
        }
        $this->filter_date = $request->getParameter('filter_date');
        //
        $filter_date =  $request->getParameter('filter_date');
        $filter_type =  $request->getParameter('filter_type');
        $filter_game =  $request->getParameter('filter_game');
        $filter_os = $request->getParameter('filter_os');

        //
        $datefrom = null;
        $dateto = null;
        if($this->filter_date == 'dateoption'){
            $datefrom = $request->getParameter('date_from');
            $dateto = $request->getParameter('date_to');
            if($datefrom != '' && $dateto != ''){
                $datefrom = date_format(date_create($datefrom),'Y-m-d' );
                $dateto = date_format(date_create($dateto),'Y-m-d' );
            }
            $this->datefrom = $datefrom;
            $this->dateto = $dateto;
        }
        $this->listRevenueGroupByDateFromTo = MoneyLogTable::getRevenueGroupByDateFromTo($filter_game, $datefrom, $dateto, $filter_type, $filter_os);

    }

    // Phân trang thống kế bên  phế game phân trang
    public function executeLoadStatisticDataInspectPagination(sfWebRequest $request)
    {
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $token = $request->getParameter('token',0);
        if ($form->getCSRFToken() != $token){
            return $this->renderText(json_encode(array('notice' => $i18n->__('Giá trị token không hợp lệ.'))));
        }

        $this->filter_date = $request->getParameter('filter_date');
      //  $date_active = date_format(date_create(VtPublisherInfoTable::getMinDateActive()),'Y-m-d');

        $filter_date =  $request->getParameter('filter_date');
        $filter_type =  $request->getParameter('filter_type');
        $filter_game =  $request->getParameter('filter_game');
        $filter_os = $request->getParameter('filter_os');
        //
        $this->pageId = $request->getParameter('pageId');
        //
        switch($this->filter_date){
            case'sevendaysago':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d")-6, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
            case'today':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr1);
                break;
            case'yesterday':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr1);
                break;
            case'thismonth':
                $daystr1 = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d");
                break;
            case'previousmonth':
                $daystr1 = mktime(0, 0, 0, date("m")-1, 1, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m"), 1, date("Y")) - 86400;
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
            case'all':
                $datefrom = '';
                $dateto = date("Y-m-d");
                break;
            case'dateoption':
                // Lấy thời gian từ việc chọn: mặc định khi chưa chọn thì lấy toàn bộ thời gian
                $datefrom = $request->getParameter('date_from');
                $dateto = $request->getParameter('date_to');
                if($datefrom != '' && $dateto != ''){
                    $datefrom = date_format(date_create($datefrom),'Y-m-d' );
                    $dateto = date_format(date_create($dateto),'Y-m-d' );
                }
                break;
            default:
                $daystr1 = mktime(0, 0, 0, date("m")  , date("d")-6, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
        }
        $this->datefrom = $datefrom;
        $this->dateto = $dateto;
        $this->date_active = '';
        // Mảng DL từ bảng Request
        $this->revenuGoldToday = MoneyLogTable::getTotalRevenuByDay(null, null, TypeGame::GOLD_MODE,  null, date('Y-m-d'));
        $this->revenuCashToday = MoneyLogTable::getTotalRevenuByDay(null, null, TypeGame::CASH_MODE,  null, date('Y-m-d'));

        $this->revenuGoldYesterday = MoneyLogTable::getTotalRevenuByDay(null, null, TypeGame::GOLD_MODE,  null, date('Y-m-d', time() - 24*3600));
        $this->revenuCashYesterday = MoneyLogTable::getTotalRevenuByDay(null, null, TypeGame::CASH_MODE,  null, date('Y-m-d', time() - 24*3600));

        $this->revenuGoldThisMonth = MoneyLogTable::getTotalRevenuByMonth(null, TypeGame::GOLD_MODE, null,  date('Y-m'));
        $this->revenuCashThisMonth = MoneyLogTable::getTotalRevenuByMonth(null, TypeGame::CASH_MODE, null, date('Y-m'));

        // Biểu đồ
        $this->revenuGoldByDate = MoneyLogTable::getMoneyGroupByDate($gameId = null, TypeGame::GOLD_MODE, $os_type = null);
        $this->revenuCashByDate = MoneyLogTable::getMoneyGroupByDate($gameId = null, TypeGame::CASH_MODE, $os_type = null);


        $this->listRevenueGroupByDateFromTo = MoneyLogTable::getRevenueGroupByDateFromTo($filter_game, $datefrom, $dateto, $filter_type, $filter_os);
        // Mảng DL API từ bảng vt_api_item để hiển thị ở bảng
        $this->list_games = GameTable::getListGame($filter_game);
        $this->list_os = ClientTypeTable::getListOs($filter_os);
    }
    // Thống kê bên Đối soát phế game
    public function executeLoadStatisticDataInspect(sfWebRequest $request)
    {
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $token = $request->getParameter('token',0);
        if ($form->getCSRFToken() != $token){
            return $this->renderText(json_encode(array('notice' => $i18n->__('Giá trị token không hợp lệ.'))));
        }
    }


    // Tính tổng theo lựa chọn bên Đối soát-- phế game
    public function executeLoadSummaryDataInspect(sfWebRequest $request)
    {
        $i18n = sfContext::getInstance()->getI18N();
        $form = new BaseForm();
        $token = $request->getParameter('token',0);
        if ($form->getCSRFToken() != $token){
            return $this->renderText(json_encode(array('notice' => $i18n->__('Giá trị token không hợp lệ.'))));
        }
        $this->filter_date = $request->getParameter('filter_date');

        $filter_date =  $request->getParameter('filter_date');
        $filter_type =  $request->getParameter('filter_type');
        $filter_game =  $request->getParameter('filter_game');
        $filter_os = $request->getParameter('filter_os');

        //
        switch($this->filter_date){
            case'sevendaysago':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d")-6, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
            case'today':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                // $daystr2 = mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr1);
                break;
            case'yesterday':
                $daystr1 = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
                // $daystr2 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr1);
                break;
            case'thismonth':
                $daystr1 = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d");
                break;
            case'previousmonth':
                $daystr1 = mktime(0, 0, 0, date("m")-1, 1, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m"), 1, date("Y")) - 86400;
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
            case'all':
                $datefrom = '';
                $dateto = date("Y-m-d");
                break;
            case'dateoption':
                // Lấy thời gian từ việc chọn: mặc định khi chưa chọn thì lấy toàn bộ thời gian
                $datefrom = $request->getParameter('date_from');
                $dateto = $request->getParameter('date_to');
                if($datefrom != '' && $dateto != ''){
                    $datefrom = date_format(date_create($datefrom),'Y-m-d' );
                    $dateto = date_format(date_create($dateto),'Y-m-d' );
                }
                //$this->datefrom = $datefrom;
                //$this->dateto = $dateto;
                break;
            default:
                $daystr1 = mktime(0, 0, 0, date("m")  , date("d")-6, date("Y"));
                $daystr2 = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
                $datefrom = date("Y-m-d", $daystr1);
                $dateto = date("Y-m-d", $daystr2);
                break;
        }
        $this->datefrom = $datefrom;
        $this->dateto = $dateto;
        $this->date_active = '';
        // Mảng DL từ bảng App join với bảng Platform
        //$this->listAppByPublisher = VtAppInfoTable::getListAppByPublisherActive();
        // Mảng DL từ bảng Request
       // $this->listRequestGroupByDateFromTo = VtLogApiRequestTable::getApiRequestGroupByDateFromTo($filter_publisher, $datefrom, $dateto, $idapp, $idapi);
        // Mảng DL API từ bảng vt_api_item để hiển thị ở bảng
       // $this->listApiItem = VtApiItemTable::getListItemm(0, $idapi);
        $this->listRevenueGroupByDateFromTo = MoneyLogTable::getRevenueGroupByDateFromTo(null, $datefrom, $dateto, $filter_type, null);

        $this->revenuYesterday = $request->getParameter('revenuYesterday');
        $this->revenuThisMonth = $request->getParameter('revenuThisMonth');
        $this->revenuPreviousMonth = $request->getParameter('revenuPreviousMonth');
        $this->requestYesterday = $request->getParameter('requestYesterday');
        $this->requestThisMonth = $request->getParameter('requestThisMonth');
        $this->requestPreviousMonth = $request->getParameter('requestPreviousMonth');
    }
    public function checkLoginForAjax()
    {
        if(!$this->getUser()->isAuthenticated()){
            $hostname = $this->generateUrl("dang_nhap");
            echo "<script>window.location.href = '".$hostname."';</script>";
            exit();
        }else{
            return false;
        }
    }
}


