<?php
//
$dataDate = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
$dataDate2 = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
$dataRevenue = array();     // Mảng lưu chuỗi thu nhập
$dataRequest = array();     // Mảng lưu chuỗi request
//
switch($filter_date){
    case('all'):
        /* Toàn bộ thời gian tính từ ngày kích hoạt tài khoản đến hiện tại
         * Khi login thành công: ta gán ngày bắt đầu = ngày kích hoạt tài khoản
         * */
        $daystr = array();
        if($date_active != NULL){
            $date_start1 = $date_active;
        }else{
            $date_start1 = date('Y-m-d');
        }
        $delta = (int)((strtotime(date('Y-m-d'))-strtotime($date_start1))/86400);
        for($i=0; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-($delta-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=0; $i<=$delta; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        break;
    case('today'):
        $daystr = array();
        for($i=1; $i<=3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(2-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=3; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        //
        break;
    case('yesterday'):
        $daystr = array();
        for($i=1; $i<=3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(3-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=3; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        //
        break;
    case('sevendaysago'):
        $daystr = array();
        for($i=1; $i<=7;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(7-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=7; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        //
        break;
    case('thirtydaysago'):
        $daystr = array();
        for($i=1; $i<=30;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(30-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=30; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        //
        break;
    case('thismonth'):
        $daystr = array();
        $delta = (int)(date('d'));
        for($i=1; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m"), $i, date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=$delta; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        break;
    case('previousmonth'):
        $daystr = array();
        $delta = (int)((mktime(0, 0, 0, date("m"), 1, date("Y")) - mktime(0, 0, 0, date("m")-1, 1, date("Y")))/86400);
        for($i=1; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")-1, $i, date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=$delta; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        break;
    case('dateoption'):
        /*B1: Tính số ngày giữa 2 thời điểm
         *B2: Tách ngày, tháng, năm từ ngày đầu tiên
         *B3: Chạy vòng for để gán mảng từng ngày kể từ ngày đầu tiên
         *B4: Duyệt mảng dữ liệu, so sánh ngày để lấy giá trị Revenue & Request
         * Nếu ko có ngày tương ứng thì gán bằng 0
         * */
        $delta = (int)((strtotime($dateto)-strtotime($datefrom))/86400);
        $d = date_format(date_create($datefrom),'d' );
        $m = date_format(date_create($datefrom),'m' );
        $y = date_format(date_create($datefrom),'Y' );
        //
        $daystr = array();
        for($i=1; $i <= ($delta+1); $i++){
            $daystr = mktime(0, 0, 0, $m , $d+$i-1, $y);
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i <= ($delta+1); $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        //
        break;
    default:
        $daystr = array();
        for($i=1; $i<=7;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(7-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
            $dataDate2['d'.$i] = date("Y-m-d", $daystr);
        }
        //
        $data = array();
        for($i=1; $i<=7; $i++){
            foreach($listRevenueGroupByDateFromTo as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
}
//
$arrRevenueTotal2 = array();    // Mảng lưu thu nhập theo cột trong bảng
$arrRequestTotal2 = array();    // Mảng lưu Tổng phế GOLD theo cột trong bảng
foreach ($dataDate2 as $valDate2){
    $arrRevenue2 = array();     // Mảng lưu thu nhập theo ô trong bảng
    $arrRequest2 = array();     // Mảng lưu Tổng phế GOLD theo ô trong bảng
    foreach ($listRevenueGroupByDateFromTo as $valRevenue2) {
        $date_created = date_format(date_create($valRevenue2['DATE']),'Y-m-d' );
        if ($date_created == $valDate2) {
            $arrRevenue2[] = $valRevenue2['sumTaxValue'];
            //$arrRequest2[] = $valRevenue2['sumRequest'];
        }
    }
    // Mảng tính tổng theo cột
    $arrRevenueTotal2[] = array_sum($arrRevenue2);
  //  $arrRequestTotal2[] = array_sum($arrRequest2);
}
?>

<div class="span3">
    <p style="font-size: 20px;"><?php echo __('Tổng phế CASH') ?></p>
    <span style="font-size: 25px;"><?php echo VtHelper::number_format(array_sum($arrRevenueTotal2)). __(' VND'); ?> </span>

    <table class="table" style="margin-top: 10px;">
        <tr><td><?php echo __('Hôm qua') ?></td><td style="text-align: center"><?php echo $revenuYesterday;?> <?php echo __('VND')?></td></tr>
        <tr><td><?php echo __('Tháng này') ?></td><td style="text-align: center"><?php echo $revenuThisMonth;?> <?php echo __('VND')?></td></tr>
        <tr><td><?php echo __('Tháng trước') ?></td><td style="text-align: center"><?php echo $revenuPreviousMonth;?> <?php echo __('VND')?></td></tr>
        <tr><td></td><td></td></tr>
    </table>
</div>
<div class="span3">
    <p style="font-size: 20px;"><?php echo __('Tổng phế GOLD')?></p>
    <span style="font-size: 25px;"><?php echo VtHelper::number_format(array_sum($arrRequestTotal2)); ?></span>

    <table class="table" style="margin-top: 10px;">
        <tr><td style="text-align: center"><?php echo $requestYesterday;?></td></tr>
        <tr><td style="text-align: center"><?php echo $requestThisMonth;?></td></tr>
        <tr><td style="text-align: center"><?php echo $requestPreviousMonth;?></td></tr>
        <tr><td></td></tr>
    </table>
</div>