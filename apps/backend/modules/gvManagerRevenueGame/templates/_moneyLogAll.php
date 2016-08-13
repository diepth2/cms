<?php
// Vẽ biểu đồ mặc định 7 ngày
$dataDate = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
$dataDate2 = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
$dataRevenue = array();     // Mảng lưu chuỗi thu nhập
$dataRequest = array();     // Mảng lưu chuỗi request
//
$daystr = array();
for($i=1; $i<=date("d");$i++){
    $daystr = mktime(0, 0, 0, date("m")  , date("d")-(date("d")-$i), date("Y"));
    $dataDate['d'.$i] = '"'.date("Y-m-d", $daystr).'"';
    $dataDate2['d'.$i] = date("Y-m-d", $daystr);
}
//
//    $data = array();
//    for($i=1; $i<=date("d"); $i++){
//        foreach($apiRequestGroupByDate as $valRequestByDevId){
//            $dt1 = '"'. date_format(date_create($valRequestByDevId['created_at']),'Y-m-d' ).'"';
//            if($dt1 == $dataDate['d'.$i]){
//                $dataRevenue['d'.$i] = $valRequestByDevId['sumRevenue'];
//                $dataRequest['d'.$i] = $valRequestByDevId['sumRequest'];
//            }
//        }
//        if(!isset($dataRevenue['d'.$i])){$dataRevenue['d'.$i] = 0;}
//        if(!isset($dataRequest['d'.$i])){$dataRequest['d'.$i] = 0;}
//        //
//        $data[] = "{date:".$dataDate['d'.$i].", revenu:".$dataRevenue['d'.$i].", request:".$dataRequest['d'.$i]."}";
//    }
//
$arrRevenueTotal2 = array();    // Mảng lưu thu nhập theo cột trong bảng
$arrRevenueGoldTotal2 = array();    // Mảng lưu số lần yêu cầu theo cột trong bảng
foreach ($dataDate2 as $valDate2){
    $arrRevenue2 = array();     // Mảng lưu thu nhập theo ô trong bảng
    $arrRequest2 = array();     // Mảng lưu số lần yêu cầu theo ô trong bảng
    foreach ($listRevenueGroupByDateFromTo as $valReques2) {
        $date_created = date_format(date_create($valReques2['DATE']),'Y-m-d' );
        if ($date_created == $valDate2) {
            $arrRevenue2[] = $valReques2['sumTaxValue'];
        }
    }
    foreach ($listRevenueGoldGroupByDateFromTo as $valReques2) {
        $date_created = date_format(date_create($valReques2['DATE']),'Y-m-d' );
        if ($date_created == $valDate2) {
            $arrRevenueGold2[] = $valReques2['sumTaxValue'];
        }
    }
    // Mảng tính tổng theo cột
    $arrRevenueTotal2[] = array_sum($arrRevenue2);
    $arrRevenueGoldTotal2[] = array_sum($arrRevenueGold2);

}
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid " id="inspect-summary-div">
                <div class="span3">
                    <p style="font-size: 20px;"><?php echo __('Tổng phế cash') ?></p>
                    <span style="font-size: 25px;"><?php echo VtHelper::number_format(array_sum($arrRevenueTotal2)). __(' VND'); ?> </span>
                    <table class="table" style="margin-top: 10px;">
                        <tr><td><?php echo __('Hôm nay') ?></td><td style="text-align: center"><?php echo VtHelper::number_format($revenuCashToday[0]['sumTaxValue']);?> <?php echo __('XU')?></td></tr>
                        <tr><td><?php echo __('Hôm quá') ?></td><td style="text-align: center"><?php echo VtHelper::number_format($revenuCashYesterday[0]['sumTaxValue']);?> <?php echo __('XU')?></td></tr>
                        <tr><td><?php echo __('Tháng này') ?></td><td style="text-align: center"><?php echo VtHelper::number_format($revenuCashThisMonth[0]['sumTaxValue']);?> <?php echo __('XU')?></td></tr>
                        <tr><td></td><td></td></tr>
                    </table>
                </div>
                <div class="span3">
                    <p style="font-size: 20px;"><?php echo __('Tổng phế gold')?></p>
                    <span style="font-size: 25px;"><?php echo VtHelper::number_format(array_sum($arrRevenueGoldTotal2)); ?></span>

                    <table class="table" style="margin-top: 10px;">
                        <tr><td style="text-align: center"><?php echo VtHelper::number_format($revenuGoldToday[0]['sumTaxValue']);?></td></tr>
                        <tr><td style="text-align: center"><?php echo VtHelper::number_format($revenuGoldYesterday[0]['sumTaxValue']);?></td></tr>
                        <tr><td style="text-align: center"><?php echo VtHelper::number_format($revenuGoldThisMonth[0]['sumTaxValue']);?></td></tr>
                        <tr><td></td></tr>
                    </table>
                </div>
            </div>
            <hr>
            <!-- Lựa chọn tìm kiếm -->
            <div class="row-fluid" style="margin-bottom: 20px;">
                <div class="span12">
                    <div class="span6" style="text-align: left; margin-left: 0px;">
                        <select name="filterType" id="filter-type" style="margin-left: 10px; width: 130px;">
                            <option value="1">CASH</option>
                            <option value="0">GOLD</option>
                        </select>
                            <select name="filtergame" id="filter-game" style="margin-left: 10px; width: 130px;">
								<option value="">Tất cả Game</option>
								<?php foreach($list_games as $valGame): ?>
									<option value="<?php echo $valGame['gameid'] ?>"><?php echo ($valGame['name']) ?></option>
								<?php endforeach ?>
							</select>
							<select name="filteros" id="filter-os" style="margin-left: 10px; width: 130px;">
								<option value="0">Tất cả phiên bản</option>
								<?php foreach($list_os as $os): ?>
									<option value="<?php echo $os['clientId'] ?>"><?php echo ($os['name']) ?></option>
								<?php endforeach ?>
							</select>
                            <select name="filterPartner" id="filter-partner" style="margin-left: 10px; width: 130px;">
                                <option value="0">Tất cả đối tác</option>
                                <?php foreach($list_partners as $partner): ?>
                                    <option value="<?php echo $partner['partnerid'] ?>"><?php echo ($partner['partnername']) ?></option>
                                <?php endforeach ?>
                            </select>
                            <a href="javascript:;" class="btn btn-primary vtt-p-white" style="margin-left: 10px; " id="search_log" role="button" ><?php echo __("Tìm kiếm") ?></a>
                    </div>
					<div style="text-align: center;">
						<input type="text" name="dateFrom" id="date-from" class="date vtt-center" style="width: 100px;" readonly value="">
						<input type="text" name="dateTo" id="date-to" class="date vtt-center" style="margin-left: 10px; width: 100px;" readonly value="">
						<select name="filterdate" id="filter-date" style="float: right; margin-left: 10px; width: 130px;">
							<option value="sevendaysago"><?php echo __('7 ngày qua')?></option>
							<option value="today"><?php echo __('Hôm nay')?></option>
							<option value="yesterday"><?php echo __('Hôm qua')?></option>
							<option value="thismonth"><?php echo __('Tháng này')?></option>
							<option value="previousmonth"><?php echo __('Tháng trước')?></option>
							<option value="all"><?php echo __('Toàn bộ thời gian')?></option>
							<option value="dateoption"><?php echo __('Tùy chọn ngày')?></option>
						</select>
						<?php
							$form = new BaseForm();
							if ($form->isCSRFProtected()):?>
								<input type="hidden" id="ajax_token" value="<?php echo $form->getCSRFToken() ?>" />
						<?php endif; ?>
					</div>
				</div>
            </div><!-- Lựa chọn tìm kiếm -->
<!--            <div class="row-fluid" class="ui-talbe-body">-->
<!--                <div class="col-lg-12">-->
<!--                    <div style="border: 1px solid #ddd;">-->
<!--                        <div class="ui-table-header-chart">--><?php //echo __('Biểu đồ: Thu nhập ước tính và Số lần yêu cầu')?><!--</div>-->
<!--                        <div class="panel-body">-->
<!--                            <div id="chartdiv" style="width: 100%; height: 400px;"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div><!-- Bieu do -->
            <div class="row-fluid ui-talbe-body" style="margin-top: 25px; margin-bottom: 25px;">
                <div class="col-lg-12" ">
                    <div style="border: 1px solid #ddd;">
                        <div class="ui-table-header-chart"><?php echo __('Thống kê phế theo game')?></div>
                        <div class="panel-body" id="statisticdiv">
                            <div class="row-fluid" style="overflow-x: scroll;">
                                <div class="col-lg-12" style="padding: 10px;>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center; width: 30px"><?php echo __('STT') ?></th>
                                                <th style="text-align: center; width: 120px"><?php echo __('Ngày') ?></th>
                                                <th style="text-align: center; width: 200px"><?php echo __('Tổng phế') ?></th>
                                                <?php foreach($list_games  as $valgame): ?>
                                                    <th style="text-align: center;"><?php echo $valgame['name'] ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            for($i= 1; $i <= date("d"); $i++):
                                                $valDate = date_format(date_create($dataDate2['d'.$i]),'d-m-Y');
                                                ?>
                                                <tr>
                                                    <!-- STT -->
                                                    <td style="text-align: center"><?php echo $i ?></td>
                                                    <!-- Ngày - Tháng - Năm -->
                                                    <td style="text-align: center"><a href="javascript:" class="detail_log" value="<?php echo $valDate ?>"><?php echo $valDate ?></a></td>
                                                    <!-- Tổng thu nhập -->
                                                    <td style="text-align: center">
                                                        <?php
                                                        // Mảng tính tổng theo id của app
                                                        $arrRevenue = array();
                                                        $valDate = date_format(date_create($valDate),'Y-m-d' );
                                                        /* Duyệt toàn bộ bảng Request, nếu có ngày trùng với dải 7 ngày qua thì lưu vào mảng
                                                         * Tính tổng tại ô và tổng theo cột
                                                         * Tổng tại ô tương ứng với mỗi ngày
                                                         * Tổng theo cột tương ứng với cả 7 ngày
                                                         * */
                                                        foreach ($listRevenueGroupByDateFromTo as $valRevenue) {
                                                            $date_created = date_format(date_create($valRevenue['DATE']),'Y-m-d' );
                                                            if ($date_created == $valDate) {
                                                                $arrRevenue[] = $valRevenue['sumTaxValue'];
                                                            }
                                                        }
                                                        // Mảng tính tổng theo cột
                                                        $arrRevenueTotal[] = array_sum($arrRevenue);
                                                        // Hiển thị dữ liệu
                                                        if (array_sum($arrRevenue) == 0) {
                                                            echo '-';
                                                        } else {
                                                            echo VtHelper::number_format(array_sum($arrRevenue));
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php
                                                    foreach ($list_games as $game):?>
                                                        <td style="text-align: center">
                                                            <?php
                                                            $arrRevenueTotalByCell = array();
                                                            foreach ($listRevenueGroupByDateFromTo as $valRevenue) {
                                                                $date_created = date_format(date_create($valRevenue['DATE']),'Y-m-d' );
                                                                if ($date_created == $valDate && $valRevenue['gameid'] == $game['gameid']) {
                                                                    $arrRevenueTotalByCell[] = $valRevenue['sumTaxValue'];
                                                                }
                                                            }
                                                             // Mảng tính tổng theo cột
                                                            $arrRequestTotalByCols[$game['gameid']][$valDate] = array_sum($arrRevenueTotalByCell);
                                                            // Hiển thị dữ liệu
                                                            if (array_sum($arrRevenueTotalByCell) == 0) {
                                                                echo '-';
                                                            } else {
                                                                echo VtHelper::number_format(array_sum($arrRevenueTotalByCell));
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php
                                            endfor
                                            ?>
                                            <?php if (count($dataDate) == 0){ ?>
                                                <tr>
                                                    <td colspan="8"><?php echo __('Không có dữ liệu nào!') ?></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr style="font-weight: bold">
                                                    <td colspan="2" style="text-align: center"><?php echo __('Tổng cộng') ?></td>
                                                    <td style="text-align: center">
                                                        <?php echo VtHelper::number_format(array_sum($arrRevenueTotal)); ?>
                                                    </td>
<!--                                                    --><?php
//                                                    foreach ($listApiItem as $valApi): ?>
<!--                                                        <td style="text-align: center">-->
<!--                                                            --><?php //echo VtHelper::number_format(array_sum($arrRequestTotalByCols[$valApi['id']]));?>
<!--                                                        </td>-->
<!--                                                    --><?php
//                                                    endforeach;
//                                                    ?>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /Thong ke -->
        </div>
    </div>
</div>
<!-- Xu ly ajax ve bieu do -->
<script type="text/javascript">
    $(document).ready(function(){
        if($("#filter-date").val() != 'dateoption'){
            $("#date-from").attr('disabled', true);
            $("#date-to").attr('disabled', true);
        }

        // Thiết lập mặc định thời gian 7 ngày đã qua tính từ ngày hiện tại
        $("#date-from").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d")-6, date("Y")));?>');
        $("#date-to").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>');

        // Xử lý ajax khi chọn app, api, date type trong select-box
        var csrf_value = $("#ajax_token").val();
        ajaxSelectBoxChange("filter-date", csrf_value);
        ajaxSelectBoxChange("filter-app", csrf_value);
        ajaxSelectBoxChange("filter-api", csrf_value);

        // Xử lý ajax khi chọn ngày from-to
        ajaxSelectBoxDateChange("date-from", csrf_value);
        ajaxSelectBoxDateChange("date-to", csrf_value);

        //Xử lý khi click nút tìm kiếm
        $("#search_log").click(function(){
            ajaxSearchSubmit();
        });

        //Xử lý khi muốn xem chi tiết doanh thu cho của DEV
//        $(".detail_log").click(function(e){
//            var filter_publisher = $("#filter_publisher").val();
//            var filter_app = $("#filter-app").val();
//            var filter_api = $("#filter-api").val();
//            var filter_date = $(this).text();
//            var _link = "<?php //echo url_for("")?>//" + "?filter_publisher=" + filter_publisher
//                + "&filter_app=" + filter_app+ "&date_from=" + filter_date+ "&date_to=" + filter_date;
//            if(e.button == 1){//middle mouse
//                window.open(_link,'_blank');
//            }else{
//                window.location.href = _link;
//            }
//        });


    });

    // Hàm xử lý ajax khi chọn app, api, date type trong select-box
    function ajaxSelectBoxChange(idSelectBox, csrf_value) {
        $('#'+idSelectBox).change(function(){
            var filter_date = $("#filter-date").val();
            if(filter_date != 'dateoption'){
                $("#date-from").attr('disabled', true);
                $("#date-to").attr('disabled', true);
            }else{
                $("#date-from").attr('disabled', false);
                $("#date-to").attr('disabled', false);
            }
            // Thay đổi ngày dựa vào chọn lọc ngày
            switch(filter_date){
                case'sevendaysago':
                    $("#date-from").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d")-6, date("Y")));?>');
                    $("#date-to").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>');
                    break;
                case'today':
                    var dt1 = '<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>';
                    $("#date-from").val(dt1);
                    $("#date-to").val(dt1);
                    break;
                case'yesterday':
                    var dt1 = '<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));?>';
                    $("#date-from").val(dt1);
                    $("#date-to").val(dt1);
                    break;
                case'thismonth':
                    $("#date-from").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , 1, date("Y")));?>');
                    $("#date-to").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>');
                    break;
                case'previousmonth':
                    $("#date-from").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")-1 , 1, date("Y")));?>');
                    $("#date-to").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m") , 1, date("Y"))-86400);?>');
                    break;
                case'all':
                    $("#date-from").val('<?php #echo $date_active ?>');
                    $("#date-to").val('<?php echo date("d-m-Y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));?>');
                    break;
                case'dateoption':
                    if(idSelectBox == "filter-date"){
                        $("#date-from").val('');
                        $("#date-to").val('');
                    }
                    break;
                default:
            }
            ajaxSearchSubmit();
        });
    }//end of function ajaxSelectBoxChange

    // Hàm chung xử lý ajax khi chọn ngày from-to
    function ajaxSelectBoxDateChange(idSelectBoxDate, csrf_value){
        $("#"+idSelectBoxDate).change(function(){
            ajaxSearchSubmit();
        });
    }//end of function ajaxSelectBoxDateChange

    function ajaxSearchSubmit(){
        var csrf_value = $("#ajax_token").val();
        // biểu đồ
        var url = '<?php #echo url_for('ajax_load_chart_data') ?>';
        // thống kê theo ngày
        var url2 = '<?php echo url_for('ajax_load_statistic_data_inspect') ?>';
        var url3 = '<?php #echo url_for('ajax_load_summary_data_inspect') ?>';
        //
        var filter_date = $("#filter-date").val();
        var filter_type = $("#filter-type").val();
        var filter_game = $("#filter-game").val();
        var filter_os = $("#filter-os").val();
        var filter_partner = $("#filter-partner").val();
        var date_from = $("#date-from").val();
        var date_to = $("#date-to").val();
        //
        var revenuYesterday = '<?php #echo VtHelper::number_format($revenuYesterday[0]['sumRevenue']); ?>';
        var revenuThisMonth = '<?php #echo VtHelper::number_format($revenuThisMonth[0]['sumRevenue']); ?>';
        var revenuPreviousMonth = '<?php #echo VtHelper::number_format($revenuPreviousMonth[0]['sumRevenue']); ?>';
        var requestYesterday = '<?php #echo VtHelper::number_format($revenuYesterday[0]['sumRequest']); ?>';
        var requestThisMonth = '<?php #echo VtHelper::number_format($revenuThisMonth[0]['sumRequest']); ?>';
        var requestPreviousMonth = '<?php #echo VtHelper::number_format($revenuPreviousMonth[0]['sumRequest']); ?>';

        if(date_from != '' && date_to != ''){
            // Tổng hợp số liệu: Thu nhập và Số lần yêu cầu
//            $.ajax({
//                type: "POST",
//                url: url3,
//                data: {
//                    revenuYesterday: revenuYesterday,
//                    revenuThisMonth: revenuThisMonth,
//                    revenuPreviousMonth: revenuPreviousMonth,
//                    requestYesterday: requestYesterday,
//                    requestThisMonth: requestThisMonth,
//                    requestPreviousMonth: requestPreviousMonth,
//                    filter_date: filter_date,
//                    filter_type: filter_type,
//                    filter_game: filter_game,
//                    filter_os: filter_os,
//                    date_from: date_from,
//                    date_to: date_to,
//                    token: csrf_value
//                },
//                dataType: "text",
//                cache: false,
//                success: function(data){
//                    $("#inspect-summary-div").html(data);
//                }
//            });
//            // Biểu đồ
//            $.ajax({
//                type: "POST",
//                url: url,
//                data: {filter_type: filter_type, filter_date: filter_date, filter_game: filter_game, filter_os: filter_os, date_from: date_from, date_to: date_to, token: csrf_value },
//                dataType: "text",
//                cache: false,
//                success: function(data){
//                    $("#chartdiv").html(data);
//                }
//            });
            // Thống kê
            $.ajax({
                type: "GET",
                url: url2,
                data: { filter_type: filter_type, filter_date: filter_date, filter_game: filter_game, filter_os: filter_os,
                    filter_partner: filter_partner,  date_from: date_from, date_to: date_to, token: csrf_value },
                dataType: "text",
                cache: false,
                success: function(data){
                    $("#statisticdiv").html(data);
                }
            });
        }
    }

</script>

<!-- Xu ly ajax ve bieu do -->
