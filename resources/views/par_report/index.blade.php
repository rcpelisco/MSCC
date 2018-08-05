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
          setChartData(data);
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