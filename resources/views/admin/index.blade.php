@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">

    <div class="row getting-started">
        <div class="row">
            <h4>Getting Started With Laundry | <span class="guide">Welcome Guide</span></h4>
        </div>
        <div class="row" style="margin-top:20px; margin-bottom:20px;">
            <div class="col m3 s12 video-box one">
                <div class="label">10 Carts</div>
                <div class="text">Ready to ship</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
            <div class="col m3 s12 video-box two">
                <div class="label">5 Invoices</div>
                <div class="text">Due this week</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
            <div class="col m3 s12 video-box three">
                <div class="label">Lorem Ipsum</div>
                <div class="text">Doller sit amet contexture</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
        </div>
    </div>

    <div class="row logo-sect">
    	@if ($user_profile->logo != '')
        <div class="logo-cont pull-left">
            <img src="https://www.truelancer.com/blog/wp-content/uploads/2014/12/afi.png" alt="{{$user->first_name}}" width="100%" height="100%" />
        </div>
        @endif
        <div class="pull-left">
            <h4>{{$user->first_name}}</h4>
            {{$date}}
        </div>
    </div>

    <div class="row graph-box">
        <h4>Income <a href="#" class="pull-right">Create an invoice</a></h4>
        <div class="row" style="margin-top:30px;">
            <div class="col m4 s12">
                <div class="row graph-bar gb-one"></div>
                <div class="row gb-detail">
                    $0<br />
                    Open Invoices
                </div>
            </div>
            <div class="col m4 s12">
                <div class="row graph-bar gb-two"></div>
                <div class="row gb-detail">
                    $0<br />
                    Over Due
                </div>
            </div>
            <div class="col m4 s12">
                <div class="row graph-bar gb-three"></div>
                <div class="row gb-detail">
                    $0<br />
                    Paid Last 30 Days
                </div>
            </div>
        </div>
    </div>

    <div class="row graph-box" id="profitChart" style="height:350px;">
    </div>


    <div class="row graph-box" id="company" style="height:400px;">
       
    </div>

</section>	
<!-- End Main Content -->
@endsection

@section('js')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages: ["corechart","bar"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Profit', 'in Dollars'],
        ['Mac', 200],
        ['Morgen', 340],
        ['Rosey', 490],
        ['Kaluse', 390],
        ['Kristain', 450],
        ['Emma', 190],
        ['Harry', 430],
        ['Donald', 134],
        ['Stephen', 50],
        ['Julia', 102],
    ]);

    var options = {
        title: 'Profit By Customer',
        is3D: true,
        backgroundColor:'#ecf0f4',
        chartArea:{left:20,top:20,width:'100%',height:'100%'}
    };

    var chart = new google.visualization.PieChart($('#profitChart')[0]);
    chart.draw(data, options);
    var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales', 'Expenses', 'Profit'],
          ['August', 1000, 400, 200],
          ['September', 1170, 460, 250],
          ['October', 660, 1120, 300],
          ['November', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: August-November',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: '100%',
          colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar($('#company')[0]);

        chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>
@endsection