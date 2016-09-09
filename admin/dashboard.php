<?php include( dirname(__FILE__). '/includes/admin-header.php'); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include( ABSPATH. 'admin/includes/admin-left-sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?= count_table('posts'); ?></h3>
                                <p>Posts writed</p>
                            </div>
                            <div class="icon">
                                <i class="ion-compose"></i>
                            </div>
                            <a href="<?= ADMINURL; ?>posts.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?= count_table('comments'); ?></h3>
                                <p>Comments recieved</p>
                            </div>
                            <div class="icon">
                                <i class="ion-chatboxes"></i>
                            </div>
                            <a href="<?= ADMINURL; ?>comments.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?= count_table('users'); ?></h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion-person-stalker"></i>
                            </div>
                            <a href="<?= ADMINURL; ?>users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?= count_table('categories'); ?></h3>
                                <p>Created categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion-ios-albums-outline"></i>
                            </div>
                            <a href="<?= ADMINURL; ?>categories.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Posts</h3>
                                <div class="box-tools pull-right">
                                     <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin" id="widget-latest-posts">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php latest_posts_widget(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="<?= ADMINURL; ?>posts.php?source=add_post" class="btn btn-sm btn-info btn-flat pull-left">Add New Post</a>
                                <a href="<?= ADMINURL; ?>posts.php" class="btn btn-sm btn-default btn-flat pull-right">View All Posts</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>

                        <!-- Chat box -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Members</h3>
                                <div class="box-tools pull-right">
                                    <span class="label label-danger">8 New Members</span>
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user1-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Alexander Pierce</a>
                                        <span class="users-list-date">Today</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user8-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Norman</a>
                                        <span class="users-list-date">Yesterday</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user7-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Jane</a>
                                        <span class="users-list-date">12 Jan</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user6-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">John</a>
                                        <span class="users-list-date">12 Jan</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user2-160x160.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Alexander</a>
                                        <span class="users-list-date">13 Jan</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user5-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Sarah</a>
                                        <span class="users-list-date">14 Jan</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user4-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Nora</a>
                                        <span class="users-list-date">15 Jan</span>
                                    </li>
                                    <li>
                                        <img src="<?= ADMINURL; ?>images/user3-128x128.jpg" alt="User Image">
                                        <a class="users-list-name" href="#">Nadia</a>
                                        <span class="users-list-date">15 Jan</span>
                                    </li>
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="<?= ADMINURL; ?>users.php" class="uppercase">View All Users</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">

                        <!-- Map box -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Users Activity</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height: 234px; width: 479px;" width="479" height="234"></canvas>
                                </div>
                            </div>

                        </div>
                        <!-- /.box -->
                        
                        <!-- TO DO List -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">To Do List</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="todo-list">
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <!-- checkbox -->
                                        <input type="checkbox" value="" name="">
                                        <!-- todo text -->
                                        <span class="text">Design a nice theme</span>
                                        <!-- Emphasis label -->
                                        <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <input type="checkbox" value="" name="">
                                        <span class="text">Make the theme responsive</span>
                                        <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <input type="checkbox" value="" name="">
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <input type="checkbox" value="" name="">
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <input type="checkbox" value="" name="">
                                        <span class="text">Check your messages and notifications</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                        <input type="checkbox" value="" name="">
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                        <div class="tools">
                                            <i class="fa fa-edit"></i>
                                            <i class="fa fa-trash-o"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix no-border">
                               <div class="box-tools pull-left">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                                <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                            </div>
                        </div>
                        <!-- /.box -->

                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- COUNTER -->
        <script>
            jQuery(document).ready(function ($) {
                $('.small-box > .inner > h3').counterUp();
            });
        </script>
        <!-- LINE CHART -->
        <script src="<?= ADMINURL; ?>plugins/chartjs/Chart.min.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true
                    , //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false
                    , //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)"
                    , //Number - Width of the grid lines
                    scaleGridLineWidth: 1
                    , //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true
                    , //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true
                    , //Boolean - Whether the line is curved between points
                    bezierCurve: true
                    , //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3
                    , //Boolean - Whether to show a dot for each point
                    pointDot: false
                    , //Number - Radius of each point dot in pixels
                    pointDotRadius: 4
                    , //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1
                    , //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20
                    , //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true
                    , //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2
                    , //Boolean - Whether to fill the dataset with a color
                    datasetFill: true
                    , //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                    , //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true
                    , //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                };
                var areaChartData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"]
                    , datasets: [
                        {
                            label: "Electronics"
                            , fillColor: "rgba(210, 214, 222, 1)"
                            , strokeColor: "rgba(210, 214, 222, 1)"
                            , pointColor: "rgba(210, 214, 222, 1)"
                            , pointStrokeColor: "#c1c7d1"
                            , pointHighlightFill: "#fff"
                            , pointHighlightStroke: "rgba(220,220,220,1)"
                            , data: [65, 59, 80, 81, 56, 55, 40]
                    }
                        , {
                            label: "Digital Goods"
                            , fillColor: "rgba(60,141,188,0.9)"
                            , strokeColor: "rgba(60,141,188,0.8)"
                            , pointColor: "#3b8bba"
                            , pointStrokeColor: "rgba(60,141,188,1)"
                            , pointHighlightFill: "#fff"
                            , pointHighlightStroke: "rgba(60,141,188,1)"
                            , data: [28, 48, 40, 19, 86, 27, 90]
                    }
                  ]
                };
                var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                var lineChart = new Chart(lineChartCanvas);
                var lineChartOptions = areaChartOptions;
                lineChartOptions.datasetFill = false;
                lineChart.Line(areaChartData, lineChartOptions);
            });
        </script>
        <?php include( ABSPATH. 'admin/includes/admin-footer.php'); ?>