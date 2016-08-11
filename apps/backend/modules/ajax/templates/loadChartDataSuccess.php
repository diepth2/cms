<?php
//
$dataDate = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
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
        //$date_start2 = date_format(date_create($date_start1),'Y-m-d' );
        $delta = (int)((strtotime(date('Y-m-d'))-strtotime($date_start1))/86400);
        for($i=0; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-($delta-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
        }
        //
        $data = array();
        for($i=0; $i<=$delta; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                    //// $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
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
        // for($i=1; $i<=3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
            $dataDate['d'] = '"'.date("Y-m-d", $daystr).'"';
        // }
        //
        $data = array();
        // for($i=1; $i<=3; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d']){
                    $dataRevenue['d'] = $valRevenuetByDevId['sumTaxValue'];
                    //$dataRequest['d'] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'])){$dataRevenue['d'] = 0;}
            if(!isset($dataRequest['d'])){$dataRequest['d'] = 0;}
            //
            $data[] = "{date:".$dataDate['d'].", revenu:".$dataRevenue['d'].", request:".$dataRequest['d']."}";
        // }
        //
        break;
    case('yesterday'):
        $daystr = array();
        // for($i=1; $i<=3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
            $dataDate['d'] = '"'.date("Y-m-d", $daystr).'"';
        // }
        //
        $data = array();
        // for($i=1; $i<=3; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d']){
                    $dataRevenue['d'] = $valRevenuetByDevId['sumTaxValue'];
                   // $dataRequest['d'] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'])){$dataRevenue['d'] = 0;}
            if(!isset($dataRequest['d'])){$dataRequest['d'] = 0;}
            //
            $data[] = "{date:".$dataDate['d'].", revenu:".$dataRevenue['d'].", request:".$dataRequest['d']."}";
        // }
        //
        break;
    case('sevendaysago'):
        $daystr = array();
        for($i=1; $i<=7;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(7-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
        }
        //
        $data = array();
        for($i=1; $i<=7; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                   // // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
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
    case('thirtydaysago'):
        $daystr = array();
        for($i=1; $i<=30;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(30-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
        }
        //
        $data = array();
        for($i=1; $i<=30; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                  //  // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
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
        }
        //
        $data = array();
        for($i=1; $i<=$delta; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                  //  // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
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
        }
        //
        $data = array();
        for($i=1; $i<=$delta; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                //    // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
        break;
    case('dayoption'):
        /* Toàn bộ thời gian tính từ ngày kích hoạt tài khoản đến hiện tại
         * */
        $daystr = array();
        if($this->session->userdata('date_active') != NULL){
            $date_start1 = $this->session->userdata('date_active');
        }else{
            $date_start1 = date('Y-m-d');
        }
        $date_start2 = date_format(date_create($date_start1),'Y-m-d' );
        $delta = (int)((strtotime(date('Y-m-d'))-strtotime($date_start2))/86400);
        for($i=0; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-($delta-$i), date("Y"));
            $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
        }
        //
        $data = array();
        for($i=0; $i<=$delta; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                  //  // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
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
        }
        //
        $data = array();
        for($i=1; $i <= ($delta+1); $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                   // // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
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
        }
        //
        $data = array();
        for($i=1; $i<=7; $i++){
            foreach($apiRequestGroupByDate as $valRevenuetByDevId){
                $dt1 = '"'. date_format(date_create($valRevenuetByDevId['DATE']),'Y-m-d' ).'"';
                if($dt1 == $dataDate['d'.$i]){
                    $dataRevenue['d'.$i] = $valRevenuetByDevId['sumTaxValue'];
                 //   // $dataRequest['d'.$i] = $valRevenuetByDevId['sumRequest'];
                    //break;
                }
            }
            if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
            if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
            //
            $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
        }
}
?>

<script type="text/javascript">
    var chart;
    var chartData = [];
    //
        // Generate some random data first
        chartData = [<?php echo implode(',', $data) ?>];
        // Serial chart
        chart = new AmCharts.AmSerialChart();
        chart.pathToImages = "/js/amcharts/images/";
        chart.dataProvider = chartData;
        chart.categoryField = "date";
        chart.dataDateFormat = "YYYY-MM-DD";
        // Format truc Y
        chart.numberFormatter = {
            precision:0,
            decimalSeparator:".",
            thousandsSeparator:","
        };
        // listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
        chart.addListener("dataUpdated", zoomChart);
        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
        categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
        categoryAxis.minorGridEnabled = true;
        categoryAxis.axisColor = "#DADADA";
        categoryAxis.twoLineMode = true;
        categoryAxis.dateFormats = [{
            period: 'DD',
            format: 'DD'
        }, {
            period: 'WW',
            format: 'DD'
        }, {
            period: 'MM',
            format: 'MM'
        }, {
            period: 'YYYY',
            format: 'YYYY'
        }];

        // First value axis (on the left)
        var valueAxis1 = new AmCharts.ValueAxis();
        valueAxis1.axisColor = "#FF6600";
        valueAxis1.axisThickness = 2;
        valueAxis1.gridAlpha = 0;
        chart.addValueAxis(valueAxis1);

        // Second value axis (on the right)
        var valueAxis2 = new AmCharts.ValueAxis();
        valueAxis2.position = "right"; // this line makes the axis to appear on the right
        valueAxis2.axisColor = "#FCD202";
        valueAxis2.gridAlpha = 0;
        valueAxis2.axisThickness = 2;
        chart.addValueAxis(valueAxis2);

        // Graphs
        // First graph
        var graph1 = new AmCharts.AmGraph();
        graph1.valueAxis = valueAxis1; // we have to indicate which value axis should be used
        graph1.title = "<?php echo __('Thu nhập ước tính (VND):') ?>";
        graph1.valueField = "revenu";
        graph1.bullet = "round";
        graph1.hideBulletsCount = 30;
        graph1.bulletBorderThickness = 1;
        chart.addGraph(graph1);

        // Second graph
        var graph2 = new AmCharts.AmGraph();
        graph2.valueAxis = valueAxis2; // we have to indicate which value axis should be used
        graph2.title = "<?php echo __('Tổng phế GOLD:') ?>";
        graph2.valueField = "request";
        graph2.bullet = "square";
        graph2.hideBulletsCount = 30;
        graph2.bulletBorderThickness = 1;
        chart.addGraph(graph2);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0.1;
        chartCursor.fullWidth = true;
        chart.addChartCursor(chartCursor);
        chartCursor.categoryBalloonDateFormat = 'DD-MM-YYYY';

        // SCROLLBAR
        var chartScrollbar = new AmCharts.ChartScrollbar();
        chart.addChartScrollbar(chartScrollbar);

        // LEGEND
        var legend = new AmCharts.AmLegend();
        legend.marginLeft = 0;
        legend.useGraphSettings = true;
        chart.addLegend(legend);
        legend.valueWidth = 100

        // WRITE
        chart.write("chartdiv");
    //
    function zoomChart() {
        //chart.zoomToIndexes(0, 3);
    }
</script>