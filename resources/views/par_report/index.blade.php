@extends('layouts.master')

@section('title', 'MSCC')

@section('breadcrumbs', Breadcrumbs::render('par_report'))

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <strong>PAR Report</strong>
        <small>Chart</small>
      </div>
      <div class="card-body">
        <canvas id="par-pie-chart" width="400" height="400"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <div class="card-header">
        <strong>PAR Report</strong>
        <small>Summary</small>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            1-7 days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([1,7]), 2) }} %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            8-15 days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([8,15]), 2) }} %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            16-30 days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([16,30]), 2) }} %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            31-90 days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([31,90]), 2) }} %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            90-360 days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([91,360]), 2) }} %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Over days: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ number_format(App\Member::PAR([360,INF]), 2) }} %
            </span>
          </div>
        </div>
        <hr class="my-1">
        <div class="row">
          <div class="col-6">
            Total: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              100.00 %
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascripts')
<script>
  $(function() {
    let canvas = document.getElementById('par-pie-chart').getContext('2d')
    let parData = [];

    getPARReport();

    function getPARReport() {
      $.ajax({
        type:'GET',
        url:'/par_report/get_data',
        data:'_token = <?php echo csrf_token() ?>',
        success: (data) => {
          setChartData(data.chart);
          $()
        }
      })
    }

    function setChartData(data) {
      new Chart(canvas, {
        type: 'pie',
        data: {
          labels: ["1-7 days", "8-15 days", "16-30 days", "31-90 days", "90-360 days", "Over 360 days"],
          datasets: [{
            label: '# of Votes',
            data: data,
            backgroundColor: [
              'rgba(255, 99, 132, .75)',
              'rgba(54, 162, 235, .75)',
              'rgba(255, 206, 86, .75)',
              'rgba(75, 192, 192, .75)',
              'rgba(153, 102, 255, .75)',
              'rgba(255, 159, 64, .75)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true
        }
      })
    }
  })
</script>
@endsection