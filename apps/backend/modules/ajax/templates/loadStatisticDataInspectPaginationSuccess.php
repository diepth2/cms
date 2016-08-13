<?php
$dataDate = array();        // Mảng lưu chuỗi ngày tháng Y-m-d
switch($filter_date){
    case('all'):
        /* Toàn bộ thời gian tính từ ngày kích hoạt tài khoản đến hiện tại
         * Khi login thành công: ta gán ngày bắt đầu = ngày kích hoạt tài khoản
         * */
        $daystr = '';
        $daystr = array();
        if($date_active != NULL){
            $date_start1 = $date_active;
        }else{
            $date_start1 = date('Y-m-d');
        }
        $date_start2 = date_format(date_create($date_start1),'Y-m-d' );
        $delta = (int)((strtotime(date('Y-m-d'))-strtotime($date_start2))/86400);
        for($i=0; $i<=$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-($delta-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('today'):
        $daystr = '';
        $daystr = array();
        for($i=0; $i<3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(1-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('yesterday'):
        $daystr = '';
        $daystr = array();
        for($i=0; $i<3;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(2-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('sevendaysago'):
        $daystr = '';
        $daystr = array();
        for($i=0; $i<7;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(6-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('thirtydaysago'):
        $daystr = '';
        $daystr = array();
        for($i=0; $i<30;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(29-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('thismonth'):
        $daystr = '';
        $daystr = array();
        $delta = (int)(date('d'));
        for($i=0; $i<$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m"), $i+1, date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    case('previousmonth'):
        $daystr = '';
        $daystr = array();
        $delta = (int)((mktime(0, 0, 0, date("m"), 1, date("Y")) - mktime(0, 0, 0, date("m")-1, 1, date("Y")))/86400);
        for($i=0; $i<$delta;$i++){
            $daystr = mktime(0, 0, 0, date("m")-1, $i+1, date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
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
        $daystr = '';
        $daystr = array();
        for($i=0; $i < ($delta+1); $i++){
            $daystr = mktime(0, 0, 0, $m , $d+$i, $y);
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        //
        break;
    default:
        $daystr = '';
        $daystr = array();
        for($i=0; $i<7;$i++){
            $daystr = mktime(0, 0, 0, date("m")  , date("d")-(6-$i), date("Y"));
            $dataDate['d'.$i] = date("d-m-Y", $daystr);
        }
        break;
}
?>

<?php
$form = new BaseForm();
if ($form->isCSRFProtected()):?>
    <input type="hidden" id="ajax_token" value="<?php echo $form->getCSRFToken() ?>" />
<?php endif; ?>
<div  style="padding: 10px; overflow-x: scroll">
    <div >
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th style="text-align: center; width: 50px"><?php echo __('STT') ?></th>
                <th style="text-align: center; width: 120px"><?php echo __('Ngày') ?></th>
                <th style="text-align: center; width: 200px"><?php echo __('Thu nhập (VND)') ?></th>
                <?php foreach ($list_games as $game): ?>
                    <th style="text-align: center;"><?php echo $game['name'] ?></th>
                <?php endforeach ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $iSN = 0;
            $arrRevenueTotal = array();             // Tính tổng các Revenue
            $arrRevenueTotalByCols = array();       // Tính tổng Request
            $dataDate = array_reverse($dataDate);   // Đảo mảng ngày từ Min->Max thành Max->Min
            //
            $count = count($dataDate);
            $page = (int)(!isset($_REQUEST['pageId']) ? 1 : $_REQUEST['pageId']);
            $page = ($page == 0 ? 1 : $page);
            $recordsPerPage = 7;
            $start = ($page - 1) * $recordsPerPage;
            $adjacents = "2";
            $prev = $page - 1;
            $next = $page + 1;
            $lastpage = ceil($count / $recordsPerPage);
            $lpm1 = $lastpage - 1;
            $pagination = "";
            if ($lastpage > 1) {
                $pagination .= "<div class='pagination-be'>";
                if ($page > 1)
                    $pagination .= "<a href=\"#page=" . ($prev) . "\" onClick='changePagination(" . ($prev) . ");'>&laquo;&nbsp;</a>";
                else
                    $pagination .= "<span class='disabled'>&laquo;&nbsp;</span>";
                if ($lastpage < 7 + ($adjacents * 2)) {
                    for ($counter = 1; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class='current'>$counter</span>";
                        else
                            $pagination .= "<a href=\"#page=" . ($counter) . "\" onClick='changePagination(" . ($counter) . ");'>$counter</a>";

                    }
                } elseif ($lastpage > 5 + ($adjacents * 2)) {
                    if ($page < 1 + ($adjacents * 2)) {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                            if ($counter == $page)
                                $pagination .= "<span class='current'>$counter</span>";
                            else
                                $pagination .= "<a href=\"#page=" . ($counter) . "\" onClick='changePagination(" . ($counter) . ");'>$counter</a>";
                        }
                        $pagination .= "...";
                        $pagination .= "<a href=\"#page=" . ($lpm1) . "\" onClick='changePagination(" . ($lpm1) . ");'>$lpm1</a>";
                        $pagination .= "<a href=\"#page=" . ($lastpage) . "\" onClick='changePagination(" . ($lastpage) . ");'>$lastpage</a>";

                    } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                        $pagination .= "<a href=\"#page=\"1\"\" onClick='changePagination(1);'>1</a>";
                        $pagination .= "<a href=\"#page=\"2\"\" onClick='changePagination(2);'>2</a>";
                        $pagination .= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<span class='current'>$counter</span>";
                            else
                                $pagination .= "<a href=\"#page=" . ($counter) . "\" onClick='changePagination(" . ($counter) . ");'>$counter</a>";
                        }
                        $pagination .= "..";
                        $pagination .= "<a href=\"#page=" . ($lpm1) . "\" onClick='changePagination(" . ($lpm1) . ");'>$lpm1</a>";
                        $pagination .= "<a href=\"#page=" . ($lastpage) . "\" onClick='changePagination(" . ($lastpage) . ");'>$lastpage</a>";
                    } else {
                        $pagination .= "<a href=\"#page=\"1\"\" onClick='changePagination(1);'>1</a>";
                        $pagination .= "<a href=\"#page=\"2\"\" onClick='changePagination(2);'>2</a>";
                        $pagination .= "..";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                            if ($counter == $page)
                                $pagination .= "<span class='current'>$counter</span>";
                            else
                                $pagination .= "<a href=\"#page=" . ($counter) . "\" onClick='changePagination(" . ($counter) . ");'>$counter</a>";
                        }
                    }
                }
                if ($page < $counter - 1)
                    $pagination .= "<a href=\"#page=" . ($next) . "\" onClick='changePagination(" . ($next) . ");'> &raquo;</a>";
                else
                    $pagination .= "<span class='disabled'> &raquo;</span>";

                $pagination .= "</div>";
            }

            //foreach ($dataDate as $valDate): $iSN += 1;
            $maxRec = $count;
            if($start+$recordsPerPage >= $count){
                $maxRec = $count;
            }else{
                $maxRec = $start+$recordsPerPage;
            }
            for($i= $start; $i < $maxRec; $i++):
                $valDate = $dataDate['d'.$i];
                ?>
                <tr>
                    <!-- STT -->
                    <td style="text-align: center"><?php echo ($i+1) ?></td>
                    <!-- Ngày - Tháng - Năm -->
                    <td style="text-align: center"><a href="javascript:;" class="detail_log"><?php echo $valDate ?></a></td>
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
                            $arrRevenueTotalByCols[$game['gameid']][$valDate] = array_sum($arrRevenueTotalByCell);
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
            <?php
            if (count($dataDate) == 0) {
                ?>
                <tr>
                    <td colspan="8"><?php echo __('Không có dữ liệu nào!') ?></td>
                </tr>
            <?php } else { ?>
                <tr style="font-weight: bold">
                    <td colspan="2" style="text-align: center"><?php echo __('Tổng cộng') ?></td>
                    <td style="text-align: center">
                        <?php
                        echo VtHelper::number_format(array_sum($arrRevenueTotal));
                        ?>
                    </td>
                    <?php
                    foreach ($list_games as $game): ?>
                        <td style="text-align: center">
                            <?php
                            echo VtHelper::number_format(array_sum($arrRevenueTotalByCols[$game['gameid']]));
                            ?>
                        </td>
                    <?php
                    endforeach;
                    ?>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>

<div class="row-fluid">
    <div class="vtt-center"><?php echo $pagination; ?></div>
</div>


<script type="text/javascript">
    $(".detail_log").click(function(e){
        var filter_date = $("#filter-date").val();
        var filter_type = $("#filter-type").val();
        var filter_game = $("#filter-game").val();
        var filter_partner = $("#filter-partner").val();
        var filter_os = $("#filter-os").val();
        var filter_date = $(this).text();
        var _link = "<?php #echo url_for("vt_log_api_request")?>" + "?filter_publisher=" + filter_publisher
            + "&filter_app=" + filter_app+ "&date_from=" + filter_date+ "&date_to=" + filter_date;
        if(e.button == 1){//middle mouse
            window.open(_link,'_blank');
        }else{
            window.location.href = _link;
        }
    });
    function changePagination(pageId) {
        var filter_date = $("#filter-date").val();
        var filter_type = $("#filter-type").val();
        var filter_game = $("#filter-game").val();
        var filter_partner = $("#filter-partner").val();
        var filter_os = $("#filter-os").val();
        var filter_partner = $("#filter-partner").val();
        var date_from = $("#date-from").val();
        var date_to = $("#date-to").val();
        var url = '<?php echo url_for('ajax_load_statistic_data_inspect_pagination') ?>';
        var csrf_value = $("#ajax_token").val();
        $.ajax({
            type: "POST",
            url: url,
            data:
            {
                pageId: pageId,
                filter_os: filter_os,
                filter_date: filter_date,
                filter_type: filter_type,
                filter_game: filter_game,
                filter_partner: filter_partner,
                date_from: date_from,
                date_to: date_to,
                token: csrf_value
            },
            cache: false,
            success: function (result) {
                $("#statisticdiv").html(result);
            }
        });
    }
</script>

