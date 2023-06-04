@extends('dashboardLayout')

@section('title')
    Home
@endsection

@section('top-nav')
    @if(session('loginowner'))
    <p class="alert alert-success">{{ session('loginowner') }}</p>
    @elseif(session('loginsupplier'))
    <p class="alert alert-success">{{ session('loginsupplier') }}</p>
    @endif
    <h2 class="page-title">
    {{-- Selamat Datang, {{ Auth::guard('supplier')->user()->name }} --}}
    @if(Auth::guard('owner')->check())
        Selamat Datang, {{Auth::guard('owner')->user()->name}}
    @elseif(Auth::guard('supplier')->check())
        Selamat Datang, {{Auth::guard('supplier')->user()->name}}
    @endif
    </h2>
    <div class="page-pretitle">
        <p><span id='date-time'></span>.</p>
    </div>
    <div class="container-fluid">
        <div class="d-flex flex-column bd-highlight mb-3">
            <div class="d-flex flex-row justify-content-between bd-highlight mb-3">
                <div class="d-flex flex-row justify-content-around align-items-center rounded-3" style="width: 250px; height: 150px; background-color: white">
                    <span class="nav-link-title">
                        Rp. {{$incomeTotal}}
                      </span>
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="20" height="20" viewBox="0 0 20 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                         </svg>
                      </span>
                </div>
                <div class="d-flex flex-row justify-content-around align-items-center rounded-3" style="width: 250px; height: 150px; background-color: white">
                    <span class="nav-link-title">
                        Rp. {{$outcomeTotal}}
                      </span>
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="20" height="20" viewBox="0 0 20 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                         </svg>
                      </span>
                </div>
                <div class="d-flex flex-row justify-content-around align-items-center rounded-3" style="width: 250px; height: 150px; background-color: white">
                    <span class="nav-link-title">
                        Rp. {{$total}}
                      </span>
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="20" height="20" viewBox="0 0 20 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                         </svg>
                      </span>
                </div>
            </div>
            <div class="d-flex flex-row bd-highlight mb-3" style="width: 100%; height: 100%;">
                <div class="d-flex flex-row justify-content-around align-items-center rounded-3" style="width: 100%; height: 100%; background-color: white">
                    <div class="card rounded-3 w-100">
                        <div class="card-body">
                            <div id="grafik"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <script type="text/javascript">
        var pendapatan = @json($group_total);
        var bulan = @json($bulan_total);
        console.log(bulan);
        Highcharts.chart('grafik', {
            title: {
                text: 'Arus Kas Bulanan'
            },
            xAxis: {
                categories: bulan
            },
            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Perbulan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Nominal Pendapatan Perbulan',
                data: pendapatan
            }]
        });
    </script>
@endsection


