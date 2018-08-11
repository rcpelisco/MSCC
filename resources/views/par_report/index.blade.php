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
        @foreach($report as $category)
        @if($loop->last)
        <hr class="my-1">
        @endif
        <div class="row">
          <div class="col-4">
            {{ $category['label'] }}
          </div>
          <div class="col-4">
            &#8369;
            <span class="pull-right">
              @convert($category['data'])
            </span>
          </div>
          <div class="col-4">
            <span class="pull-right">
            @if(App\Member::totalBalance() > 0)
              @convert($category['percentage']) %
            @endif
            </span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@include('par_report.modal.borrowers_on_par')
@endsection

@section('javascripts')
<script>
$(function() {
  let canvas = $('#par-pie-chart')
  let chart = undefined
  let chartData = []

  getPARReport();

  function getPARReport() {
    chartData.backgroundColor = {!!
      $report->reject(function($value) {
        return $value['label'] == 'Total: ';
      })->pluck('backgroundColor')
    !!}

    chartData.data = {{ 
      $report->reject(function($value) {
        return $value['label'] == 'Total: ';
      })->pluck('data') 
    }}

    chartData.label = {!!
      $report->reject(function($value) {
        return $value['label'] == 'Total: ';
      })->pluck('label') 
    !!}

    chartData.members = {!!
      $report->reject(function($value) {
        return $value['label'] == 'Total: ';
      })->pluck('members') 
    !!}

    setChartData(chartData)
  }

  canvas.click(function(e) {
    let item = chart.getElementAtEvent(e)[0]
    if(item) {
      let members = ''
      chartData.members[item._index].forEach(function(item) {
        members += '<li class="list-group-item">' + item + '</li>'
      })
      $('#borrowersOnPARModal .list-group').html(members)
      $('#borrowersOnPARModal').modal()
    }
  })

  function setChartData(data) {
    chart = new Chart(canvas, {
      type: 'pie',
      data: {
        labels: data.label,
        datasets: [{
          label: 'PAR Report',
          data: data.data,
          backgroundColor: data.backgroundColor,
          borderWidth: 1
        }],
        onClick: function() {
          alert(1)
        },
      },
      options: {
        responsive: true
      }
    })
  }
})
</script>
@endsection