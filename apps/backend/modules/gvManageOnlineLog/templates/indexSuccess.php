<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gvManageOnlineLog/assets') ?>
<?php include_partial('gvManageOnlineLog/header') ?>



<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('gvManageOnlineLog/list_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            
            <div class="span12">
            <h1 style="display: inline"><?php echo __('GvManageOnlineLog List', array(), 'messages') ?></h1>
            </div>
            <div class="row-fluid">
                <div class="span9">
                                  <?php include_partial('gvManageOnlineLog/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
                                </div>
                <div class="span3">
                    <div class="pull-right"><?php #include_partial('gvManageOnlineLog/list_actions', array('helper' => $helper)) ?></div>
                </div>
                <div class="span12">
                    <!-- ID Vẽ biểu đồ online -->
                    <div id="piechart_user_online" style="width: 100%; height: 500px"></div>
                </div>
            </div>
            

            <?php include_partial('gvManageOnlineLog/flashes') ?>
            
            <div id="sf_admin_header">
                <?php include_partial('gvManageOnlineLog/list_header', array('pager' => $pager)) ?>
            </div>

            <div id="sf_admin_content">
                <form class="form-inline" id="list-form" action="<?php echo url_for('online_log_collection', array('action' => 'batch')) ?>" method="post">
                    <b>Lượng CCU ở thời điểm hiện tại</b>
                    <div class="sf_admin_list">
                        <table class="datatable table table-bordered table-striped" id="table_gv_manage_online_log" style="margin-top: 5px !important;">
                            <tr class="sf_admin_row">
                                <?php foreach ($arr_game as $name => $numOnline) {?>
                                <td class="sf_admin_text" style="background-color: #d1d1e6"><?php echo VtHelper::truncate($name, 50, '...', true)?>
                                    <p style="color: red"><?php echo $numOnline?></p>
                                </td>
                                <?php }?>
                            </tr>
                        </table>
                <?php #include_partial('gvManageOnlineLog/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

                <div>
                    <?php #include_partial('gvManageOnlineLog/list_batch_actions', array('helper' => $helper)) ?>
                </div>
                                    </form>
                
<!--                <form class="form-inline" method="get" action="--><?php //echo url_for('online_log') ?><!--">-->
<!--                    <div class="well pull-right">-->
<!--                      --><?php //echo __('Số bản ghi/trang: ')?>
<!--                        --><?php //$select = new sfWidgetFormChoice(array(
//                                        'multiple' => false,
//                                        'expanded' => false,
//                                        'choices' => array('10' => __('10', null, 'tmcTwitterBootstrapPlugin'), 20 => 20, 30 => 30, 50 => 50, 100 => 100)
//                                    ),
//                                    array('class' => 'input-medium')); echo $select->render('max_per_page', $sf_user->getAttribute('gvManageOnlineLog.max_per_page', null, 'admin_module')) ?>
<!--                        <input type="submit" class="btn btn-inverse btn-small" value="--><?php //echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?><!--" />-->
<!--                    </div>-->
<!--                </form>-->
                <div class="clearfix"></div>
            </div>
            <?php #include_partial('gvManageOnlineLog/list_footer', array('pager' => $pager)) ?>
        </div>
    </div>
</div>

<?php include_partial('gvManageOnlineLog/footer') ?>
<script type="text/javascript" src="/css/jsapi.css"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var formatter = new google.visualization.NumberFormat({
            pattern: '###,###'
        });

        //Hình 3: Thông tin nhà phát triển đăng ký tài khoản
        var array_online_log = new Array(["<?php echo __('Thời gian') ?>", "<?php echo __('Online') ?>"]);
        <?php foreach($arr_log as $time => $value):?>
            array_online_log.push(['<?php echo $time;  ?>', Number('<?php echo $value?>')]);
        <?php endforeach ?>
        var data_online_log = google.visualization.arrayToDataTable(array_online_log);
        formatter.format(data_online_log, 1);
        var options_online_log = {
            title: '<?php echo __('CCU') ?>',
            is3D: true,
            hAxis: {title: 'CCU gamevina',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };
        var chart_online_log = new google.visualization.ColumnChart(document.getElementById('piechart_user_online'));
        chart_online_log.draw(data_online_log, options_online_log);
    }
</script>
