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
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <strong>PAR Report</strong>
        <small>Summary</small>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            Current (Active): 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([-INF,0]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([-INF,0]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            1-7 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([1,7]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([1,7]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            8-15 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([8,15]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([8,15]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            16-30 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([16,30]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([16,30]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            31-90 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([31,90]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([31,90]) / App\Member::totalBalance() * 100, 2)) %              
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            91-360 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([91,360]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([91,360]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            Over 360 days: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::PAR([361,INF]), 2))
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
              @convert(round(App\Member::PAR([361,INF]) / App\Member::totalBalance() * 100, 2)) %
            </span>
          </div>
        </div>
        <hr class="my-1">
        <div class="row">
          <div class="col-4">
            Total: 
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert(round(App\Member::totalBalance(), 2))
            </span>
          </div>
          <div class="col-4">
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
          labels: ["Current (active)", "1-7 days", "8-15 days", "16-30 days", "31-90 days", "90-360 days", "Over 360 days"],
          datasets: [{
            label: '# of Votes',
            data: data,
            backgroundColor: [
              'rgba(127, 127, 127, 0.75)',
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