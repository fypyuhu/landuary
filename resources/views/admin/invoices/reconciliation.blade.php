@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Reconciliation Report</h1>

                <ul>
                    <li>
                        <a href="/admin"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li>Reconciliation Report
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="row no-rightmargin" id="adjustment">
        <div class="col s12">
            <fieldset>
                <legend>Invoice(s):</legend>
                <div class="row">
                    <div class="col m6 s12">
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Select Customer:</label>
                                <select name="customer" id="customer" class="dropdown">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label> From:</label>
                                <div name="from_date" id="from_date"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>To:</label>
                                <div name="to_date" id="to_date" class="datepicker"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <button type="button" class="waves-effect btn" onclick="drawChart()">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="chart"></div>
                </div>
            </fieldset>
        </div>
    </div>
</section>

<!-- /Main Content -->
@endsection

@section('js')

<script>
    $(document).ready(function () {
        var oneWeekAgo = new Date();
        oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
        $('#from_date').jqxDateTimeInput({value: new Date(oneWeekAgo), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
        $(".dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $(".datepicker").jqxDateTimeInput({width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
    });
    google.load("visualization", "1.1", {packages: ["bar"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        $('.loading').show();
        post_data=new Object();
        post_data.customer=$("#customer").val();
        post_data.start_date=$("#from_date").val();
        post_data.end_date=$("#to_date").val();
        var jsonData = $.ajax({
          url: "/admin/weight-data",
          dataType: "json",
          data:post_data,
          async: false
          }).responseText;
        var data = new google.visualization.DataTable(jsonData);

        var options = {
            chart: {
                title:$("#customer").val()+ ' Weight Reconciliation',
                subtitle: 'From '+$('#from_date').val()+' to '+$('#to_date').val(),
            }
        };

        var chart = new google.charts.Bar($('#chart')[0]);

        chart.draw(data, options);
        $('.loading').hide();
    }
</script>
@endsection