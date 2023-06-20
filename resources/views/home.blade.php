@extends('layouts.app')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">


<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Acceuil /</span> Tableau de bord</h4>

<div class="row">
    <!-- Website Analytics -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title mb-0">Hello  {{ Auth::user()->name }}</h5>
              <p class="mb-2">Je suis votre assistant Dashboard</p>
              
            </div>
          </div>
          <div class="col-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="222" alt="view sales">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Website Analytics -->
  
    <!-- Sales Overview -->
    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <small class="d-block mb-1 text-muted">Sales Overview</small>
            <p class="card-text text-success">+18.2%</p>
          </div>
          <h4 class="card-title mb-1">$42.5k</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="d-flex gap-2 align-items-center mb-2">
                <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                <p class="mb-0">Order</p>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap">62.2%</h5>
              <small class="text-muted">6,440</small>
            </div>
            <div class="col-4">
              <div class="divider divider-vertical">
                <div class="divider-text">
                  <span class="badge-divider-bg bg-label-secondary">VS</span>
                </div>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                <p class="mb-0">Visits</p>
                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">25.5%</h5>
              <small class="text-muted">12,749</small>
            </div>
          </div>
          <div class="d-flex align-items-center mt-4">
            <div class="progress w-100" style="height: 8px;">
              <div class="progress-bar bg-info" style="width: 70%" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Sales Overview -->
  
    <!-- Revenue Generated -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body pb-0">
          <div class="card-icon">
            <span class="badge bg-label-success rounded-pill p-2">
              <i class="ti ti-credit-card ti-sm"></i>
            </span>
          </div>
          <h5 class="card-title mb-0 mt-2">97.5k</h5>
          <small>Revenue Generated</small>
        </div>
        <div id="revenueGenerated" style="min-height: 130px;"><div id="apexchartsvdua2i74" class="apexcharts-canvas apexchartsvdua2i74 apexcharts-theme-light" style="width: 330px; height: 130px;"><svg id="SvgjsSvg1219" width="330" height="130" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1221" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1220"><clipPath id="gridRectMaskvdua2i74"><rect id="SvgjsRect1226" width="336" height="132" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskvdua2i74"></clipPath><clipPath id="nonForecastMaskvdua2i74"></clipPath><clipPath id="gridRectMarkerMaskvdua2i74"><rect id="SvgjsRect1227" width="334" height="134" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1232" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1233" stop-opacity="0.6" stop-color="rgba(40,199,111,0.6)" offset="0"></stop><stop id="SvgjsStop1234" stop-opacity="0.1" stop-color="rgba(212,244,226,0.1)" offset="1"></stop><stop id="SvgjsStop1235" stop-opacity="0.1" stop-color="rgba(212,244,226,0.1)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1225" x1="0" y1="0" x2="0" y2="130" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="130" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1238" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1239" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1248" class="apexcharts-grid"><g id="SvgjsG1249" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1251" x1="0" y1="0" x2="330" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1252" x1="0" y1="26" x2="330" y2="26" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1253" x1="0" y1="52" x2="330" y2="52" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1254" x1="0" y1="78" x2="330" y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1255" x1="0" y1="104" x2="330" y2="104" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1256" x1="0" y1="130" x2="330" y2="130" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1250" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1258" x1="0" y1="130" x2="330" y2="130" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1257" x1="0" y1="1" x2="0" y2="130" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1228" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1229" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1236" d="M 0 130L 0 104C 19.25 104 35.75 60.66666666666663 55 60.66666666666663C 74.25 60.66666666666663 90.75 78 110 78C 129.25 78 145.75 34.66666666666663 165 34.66666666666663C 184.25 34.66666666666663 200.75 69.33333333333331 220 69.33333333333331C 239.25 69.33333333333331 255.75 17.333333333333314 275 17.333333333333314C 294.25 17.333333333333314 310.75 34.66666666666663 330 34.66666666666663C 330 34.66666666666663 330 34.66666666666663 330 130M 330 34.66666666666663z" fill="url(#SvgjsLinearGradient1232)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskvdua2i74)" pathTo="M 0 130L 0 104C 19.25 104 35.75 60.66666666666663 55 60.66666666666663C 74.25 60.66666666666663 90.75 78 110 78C 129.25 78 145.75 34.66666666666663 165 34.66666666666663C 184.25 34.66666666666663 200.75 69.33333333333331 220 69.33333333333331C 239.25 69.33333333333331 255.75 17.333333333333314 275 17.333333333333314C 294.25 17.333333333333314 310.75 34.66666666666663 330 34.66666666666663C 330 34.66666666666663 330 34.66666666666663 330 130M 330 34.66666666666663z" pathFrom="M -1 364L -1 364L 55 364L 110 364L 165 364L 220 364L 275 364L 330 364"></path><path id="SvgjsPath1237" d="M 0 104C 19.25 104 35.75 60.66666666666663 55 60.66666666666663C 74.25 60.66666666666663 90.75 78 110 78C 129.25 78 145.75 34.66666666666663 165 34.66666666666663C 184.25 34.66666666666663 200.75 69.33333333333331 220 69.33333333333331C 239.25 69.33333333333331 255.75 17.333333333333314 275 17.333333333333314C 294.25 17.333333333333314 310.75 34.66666666666663 330 34.66666666666663" fill="none" fill-opacity="1" stroke="#28c76f" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskvdua2i74)" pathTo="M 0 104C 19.25 104 35.75 60.66666666666663 55 60.66666666666663C 74.25 60.66666666666663 90.75 78 110 78C 129.25 78 145.75 34.66666666666663 165 34.66666666666663C 184.25 34.66666666666663 200.75 69.33333333333331 220 69.33333333333331C 239.25 69.33333333333331 255.75 17.333333333333314 275 17.333333333333314C 294.25 17.333333333333314 310.75 34.66666666666663 330 34.66666666666663" pathFrom="M -1 364L -1 364L 55 364L 110 364L 165 364L 220 364L 275 364L 330 364"></path><g id="SvgjsG1230" class="apexcharts-series-markers-wrap" data:realIndex="0"></g></g><g id="SvgjsG1231" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1259" x1="0" y1="0" x2="330" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1260" x1="0" y1="0" x2="330" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1261" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1262" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1263" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1224" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1247" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1222" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 65px;"></div></div></div>
      <div class="resize-triggers"><div class="expand-trigger"><div style="width: 331px; height: 248px;"></div></div><div class="contract-trigger"></div></div></div>
    </div>
    <!--/ Revenue Generated -->
  
    <!-- Earning Reports -->
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
          <div class="card-title mb-0">
            <h5 class="mb-0">Earning Reports</h5>
            <small class="text-muted">Weekly Earnings Overview</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
              <a class="dropdown-item" href="javascript:void(0);">View More</a>
              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
            </div>
          </div>
          <!-- </div> -->
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-4 d-flex flex-column align-self-end">
              <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                <h1 class="mb-0">$468</h1>
                <div class="badge rounded bg-label-success">+4.2%</div>
              </div>
              <small class="text-muted">You informed of this week compared to last week</small>
            </div>
            <div class="col-12 col-md-8" style="position: relative;">
              <div id="weeklyEarningReports" style="min-height: 202px;"><div id="apexchartsmgxnx304" class="apexcharts-canvas apexchartsmgxnx304 apexcharts-theme-light" style="width: 416px; height: 202px;"><svg id="SvgjsSvg1264" width="416" height="202" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1266" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1265"><linearGradient id="SvgjsLinearGradient1269" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1270" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1271" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1272" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskmgxnx304"><rect id="SvgjsRect1274" width="430" height="162.73" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskmgxnx304"></clipPath><clipPath id="nonForecastMaskmgxnx304"></clipPath><clipPath id="gridRectMarkerMaskmgxnx304"><rect id="SvgjsRect1275" width="430" height="166.73" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1273" width="0" height="162.73" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1269)" class="apexcharts-xcrosshairs" y2="162.73" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1294" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1295" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1297" font-family="Public Sans" x="30.428571428571427" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1298">Mo</tspan><title>Mo</title></text><text id="SvgjsText1300" font-family="Public Sans" x="91.28571428571428" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1301">Tu</tspan><title>Tu</title></text><text id="SvgjsText1303" font-family="Public Sans" x="152.14285714285714" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1304">We</tspan><title>We</title></text><text id="SvgjsText1306" font-family="Public Sans" x="213" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1307">Th</tspan><title>Th</title></text><text id="SvgjsText1309" font-family="Public Sans" x="273.85714285714283" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1310">Fr</tspan><title>Fr</title></text><text id="SvgjsText1312" font-family="Public Sans" x="334.71428571428567" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1313">Sa</tspan><title>Sa</title></text><text id="SvgjsText1315" font-family="Public Sans" x="395.5714285714285" y="191.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family: &quot;Public Sans&quot;;"><tspan id="SvgjsTspan1316">Su</tspan><title>Su</title></text></g></g><g id="SvgjsG1319" class="apexcharts-grid"><g id="SvgjsG1320" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1322" x1="0" y1="0" x2="426" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1323" x1="0" y1="32.546" x2="426" y2="32.546" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1324" x1="0" y1="65.092" x2="426" y2="65.092" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1325" x1="0" y1="97.638" x2="426" y2="97.638" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1326" x1="0" y1="130.184" x2="426" y2="130.184" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1327" x1="0" y1="162.73" x2="426" y2="162.73" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1321" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1329" x1="0" y1="162.73" x2="426" y2="162.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1328" x1="0" y1="1" x2="0" y2="162.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1276" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1277" class="apexcharts-series" rel="1" seriesName="seriesx1" data:realIndex="0"><path id="SvgjsPath1281" d="M 18.865714285714283 158.73L 18.865714285714283 101.63799999999999Q 18.865714285714283 97.63799999999999 22.865714285714283 97.63799999999999L 37.99142857142857 97.63799999999999Q 41.99142857142857 97.63799999999999 41.99142857142857 101.63799999999999L 41.99142857142857 101.63799999999999L 41.99142857142857 158.73Q 41.99142857142857 162.73 37.99142857142857 162.73L 22.865714285714283 162.73Q 18.865714285714283 162.73 18.865714285714283 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 18.865714285714283 158.73L 18.865714285714283 101.63799999999999Q 18.865714285714283 97.63799999999999 22.865714285714283 97.63799999999999L 37.99142857142857 97.63799999999999Q 41.99142857142857 97.63799999999999 41.99142857142857 101.63799999999999L 41.99142857142857 101.63799999999999L 41.99142857142857 158.73Q 41.99142857142857 162.73 37.99142857142857 162.73L 22.865714285714283 162.73Q 18.865714285714283 162.73 18.865714285714283 158.73z" pathFrom="M 18.865714285714283 158.73L 18.865714285714283 158.73L 41.99142857142857 158.73L 41.99142857142857 158.73L 41.99142857142857 158.73L 41.99142857142857 158.73L 41.99142857142857 158.73L 18.865714285714283 158.73" cy="97.63799999999999" cx="79.72285714285714" j="0" val="40" barHeight="65.092" barWidth="23.125714285714285"></path><path id="SvgjsPath1283" d="M 79.72285714285714 158.73L 79.72285714285714 60.95549999999999Q 79.72285714285714 56.95549999999999 83.72285714285714 56.95549999999999L 98.84857142857142 56.95549999999999Q 102.84857142857142 56.95549999999999 102.84857142857142 60.95549999999999L 102.84857142857142 60.95549999999999L 102.84857142857142 158.73Q 102.84857142857142 162.73 98.84857142857142 162.73L 83.72285714285714 162.73Q 79.72285714285714 162.73 79.72285714285714 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 79.72285714285714 158.73L 79.72285714285714 60.95549999999999Q 79.72285714285714 56.95549999999999 83.72285714285714 56.95549999999999L 98.84857142857142 56.95549999999999Q 102.84857142857142 56.95549999999999 102.84857142857142 60.95549999999999L 102.84857142857142 60.95549999999999L 102.84857142857142 158.73Q 102.84857142857142 162.73 98.84857142857142 162.73L 83.72285714285714 162.73Q 79.72285714285714 162.73 79.72285714285714 158.73z" pathFrom="M 79.72285714285714 158.73L 79.72285714285714 158.73L 102.84857142857142 158.73L 102.84857142857142 158.73L 102.84857142857142 158.73L 102.84857142857142 158.73L 102.84857142857142 158.73L 79.72285714285714 158.73" cy="56.95549999999999" cx="140.57999999999998" j="1" val="65" barHeight="105.7745" barWidth="23.125714285714285"></path><path id="SvgjsPath1285" d="M 140.57999999999998 158.73L 140.57999999999998 85.365Q 140.57999999999998 81.365 144.57999999999998 81.365L 159.70571428571427 81.365Q 163.70571428571427 81.365 163.70571428571427 85.365L 163.70571428571427 85.365L 163.70571428571427 158.73Q 163.70571428571427 162.73 159.70571428571427 162.73L 144.57999999999998 162.73Q 140.57999999999998 162.73 140.57999999999998 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 140.57999999999998 158.73L 140.57999999999998 85.365Q 140.57999999999998 81.365 144.57999999999998 81.365L 159.70571428571427 81.365Q 163.70571428571427 81.365 163.70571428571427 85.365L 163.70571428571427 85.365L 163.70571428571427 158.73Q 163.70571428571427 162.73 159.70571428571427 162.73L 144.57999999999998 162.73Q 140.57999999999998 162.73 140.57999999999998 158.73z" pathFrom="M 140.57999999999998 158.73L 140.57999999999998 158.73L 163.70571428571427 158.73L 163.70571428571427 158.73L 163.70571428571427 158.73L 163.70571428571427 158.73L 163.70571428571427 158.73L 140.57999999999998 158.73" cy="81.365" cx="201.43714285714285" j="2" val="50" barHeight="81.365" barWidth="23.125714285714285"></path><path id="SvgjsPath1287" d="M 201.43714285714285 158.73L 201.43714285714285 93.5015Q 201.43714285714285 89.5015 205.43714285714285 89.5015L 220.56285714285713 89.5015Q 224.56285714285713 89.5015 224.56285714285713 93.5015L 224.56285714285713 93.5015L 224.56285714285713 158.73Q 224.56285714285713 162.73 220.56285714285713 162.73L 205.43714285714285 162.73Q 201.43714285714285 162.73 201.43714285714285 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 201.43714285714285 158.73L 201.43714285714285 93.5015Q 201.43714285714285 89.5015 205.43714285714285 89.5015L 220.56285714285713 89.5015Q 224.56285714285713 89.5015 224.56285714285713 93.5015L 224.56285714285713 93.5015L 224.56285714285713 158.73Q 224.56285714285713 162.73 220.56285714285713 162.73L 205.43714285714285 162.73Q 201.43714285714285 162.73 201.43714285714285 158.73z" pathFrom="M 201.43714285714285 158.73L 201.43714285714285 158.73L 224.56285714285713 158.73L 224.56285714285713 158.73L 224.56285714285713 158.73L 224.56285714285713 158.73L 224.56285714285713 158.73L 201.43714285714285 158.73" cy="89.5015" cx="262.2942857142857" j="3" val="45" barHeight="73.2285" barWidth="23.125714285714285"></path><path id="SvgjsPath1289" d="M 262.2942857142857 158.73L 262.2942857142857 20.272999999999996Q 262.2942857142857 16.272999999999996 266.2942857142857 16.272999999999996L 281.42 16.272999999999996Q 285.42 16.272999999999996 285.42 20.272999999999996L 285.42 20.272999999999996L 285.42 158.73Q 285.42 162.73 281.42 162.73L 266.2942857142857 162.73Q 262.2942857142857 162.73 262.2942857142857 158.73z" fill="rgba(115,103,240,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 262.2942857142857 158.73L 262.2942857142857 20.272999999999996Q 262.2942857142857 16.272999999999996 266.2942857142857 16.272999999999996L 281.42 16.272999999999996Q 285.42 16.272999999999996 285.42 20.272999999999996L 285.42 20.272999999999996L 285.42 158.73Q 285.42 162.73 281.42 162.73L 266.2942857142857 162.73Q 262.2942857142857 162.73 262.2942857142857 158.73z" pathFrom="M 262.2942857142857 158.73L 262.2942857142857 158.73L 285.42 158.73L 285.42 158.73L 285.42 158.73L 285.42 158.73L 285.42 158.73L 262.2942857142857 158.73" cy="16.272999999999996" cx="323.15142857142854" j="4" val="90" barHeight="146.457" barWidth="23.125714285714285"></path><path id="SvgjsPath1291" d="M 323.15142857142854 158.73L 323.15142857142854 77.2285Q 323.15142857142854 73.2285 327.15142857142854 73.2285L 342.27714285714285 73.2285Q 346.27714285714285 73.2285 346.27714285714285 77.2285L 346.27714285714285 77.2285L 346.27714285714285 158.73Q 346.27714285714285 162.73 342.27714285714285 162.73L 327.15142857142854 162.73Q 323.15142857142854 162.73 323.15142857142854 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 323.15142857142854 158.73L 323.15142857142854 77.2285Q 323.15142857142854 73.2285 327.15142857142854 73.2285L 342.27714285714285 73.2285Q 346.27714285714285 73.2285 346.27714285714285 77.2285L 346.27714285714285 77.2285L 346.27714285714285 158.73Q 346.27714285714285 162.73 342.27714285714285 162.73L 327.15142857142854 162.73Q 323.15142857142854 162.73 323.15142857142854 158.73z" pathFrom="M 323.15142857142854 158.73L 323.15142857142854 158.73L 346.27714285714285 158.73L 346.27714285714285 158.73L 346.27714285714285 158.73L 346.27714285714285 158.73L 346.27714285714285 158.73L 323.15142857142854 158.73" cy="73.2285" cx="384.0085714285714" j="5" val="55" barHeight="89.5015" barWidth="23.125714285714285"></path><path id="SvgjsPath1293" d="M 384.0085714285714 158.73L 384.0085714285714 52.81899999999999Q 384.0085714285714 48.81899999999999 388.0085714285714 48.81899999999999L 403.1342857142857 48.81899999999999Q 407.1342857142857 48.81899999999999 407.1342857142857 52.81899999999999L 407.1342857142857 52.81899999999999L 407.1342857142857 158.73Q 407.1342857142857 162.73 403.1342857142857 162.73L 388.0085714285714 162.73Q 384.0085714285714 162.73 384.0085714285714 158.73z" fill="#7367f029" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskmgxnx304)" pathTo="M 384.0085714285714 158.73L 384.0085714285714 52.81899999999999Q 384.0085714285714 48.81899999999999 388.0085714285714 48.81899999999999L 403.1342857142857 48.81899999999999Q 407.1342857142857 48.81899999999999 407.1342857142857 52.81899999999999L 407.1342857142857 52.81899999999999L 407.1342857142857 158.73Q 407.1342857142857 162.73 403.1342857142857 162.73L 388.0085714285714 162.73Q 384.0085714285714 162.73 384.0085714285714 158.73z" pathFrom="M 384.0085714285714 158.73L 384.0085714285714 158.73L 407.1342857142857 158.73L 407.1342857142857 158.73L 407.1342857142857 158.73L 407.1342857142857 158.73L 407.1342857142857 158.73L 384.0085714285714 158.73" cy="48.81899999999999" cx="444.8657142857142" j="6" val="70" barHeight="113.911" barWidth="23.125714285714285"></path><g id="SvgjsG1279" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1280" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1282" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1284" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1286" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1288" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1290" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1292" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG1278" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1330" x1="0" y1="0" x2="426" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1331" x1="0" y1="0" x2="426" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1332" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1333" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1334" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1317" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)"><g id="SvgjsG1318" class="apexcharts-yaxis-texts-g"></g></g><g id="SvgjsG1267" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 101px;"></div></div></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 441px; height: 203px;"></div></div><div class="contract-trigger"></div></div></div>
          </div>
          <div class="border rounded p-3 mt-2">
            <div class="row gap-4 gap-sm-0">
              <div class="col-12 col-sm-4">
                <div class="d-flex gap-2 align-items-center">
                  <div class="badge rounded bg-label-primary p-1"><i class="ti ti-currency-dollar ti-sm"></i></div>
                  <h6 class="mb-0">Earnings</h6>
                </div>
                <h4 class="my-2 pt-1">$545.69</h4>
                <div class="progress w-75" style="height:4px">
                  <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="d-flex gap-2 align-items-center">
                  <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                  <h6 class="mb-0">Profit</h6>
                </div>
                <h4 class="my-2 pt-1">$256.34</h4>
                <div class="progress w-75" style="height:4px">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="col-12 col-sm-4">
                <div class="d-flex gap-2 align-items-center">
                  <div class="badge rounded bg-label-danger p-1"><i class="ti ti-brand-paypal ti-sm"></i></div>
                  <h6 class="mb-0">Expense</h6>
                </div>
                <h4 class="my-2 pt-1">$74.19</h4>
                <div class="progress w-75" style="height:4px">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Earning Reports -->
  
    <!-- Support Tracker -->
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="mb-0">Support Tracker</h5>
            <small class="text-muted">Last 7 Days</small>
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
              <a class="dropdown-item" href="javascript:void(0);">View More</a>
              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
              <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                <h1 class="mb-0">164</h1>
                <p class="mb-0">Total Tickets</p>
              </div>
              <ul class="p-0 m-0">
                <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                  <div class="badge rounded bg-label-primary p-1"><i class="ti ti-ticket ti-sm"></i></div>
                  <div>
                    <h6 class="mb-0 text-nowrap">New Tickets</h6>
                    <small class="text-muted">142</small>
                  </div>
                </li>
                <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                  <div class="badge rounded bg-label-info p-1"><i class="ti ti-circle-check ti-sm"></i></div>
                  <div>
                    <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                    <small class="text-muted">28</small>
                  </div>
                </li>
                <li class="d-flex gap-3 align-items-center pb-1">
                  <div class="badge rounded bg-label-warning p-1"><i class="ti ti-clock ti-sm"></i></div>
                  <div>
                    <h6 class="mb-0 text-nowrap">Response Time</h6>
                    <small class="text-muted">1 Day</small>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-12 col-sm-8 col-md-12 col-lg-8" style="position: relative;">
              <div id="supportTracker" style="min-height: 257.9px;"><div id="apexchartsut5h099f" class="apexcharts-canvas apexchartsut5h099f apexcharts-theme-light" style="width: 416px; height: 257.9px;"><svg id="SvgjsSvg1335" width="416" height="257.9" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1337" class="apexcharts-inner apexcharts-graphical" transform="translate(41, -10)"><defs id="SvgjsDefs1336"><clipPath id="gridRectMaskut5h099f"><rect id="SvgjsRect1339" width="342" height="375" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskut5h099f"></clipPath><clipPath id="nonForecastMaskut5h099f"></clipPath><clipPath id="gridRectMarkerMaskut5h099f"><rect id="SvgjsRect1340" width="340" height="377" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1345" x1="1" y1="0" x2="0" y2="1"><stop id="SvgjsStop1346" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="0.3"></stop><stop id="SvgjsStop1347" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="0.7"></stop><stop id="SvgjsStop1348" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1356" x1="1" y1="0" x2="0" y2="1"><stop id="SvgjsStop1357" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="0.3"></stop><stop id="SvgjsStop1358" stop-opacity="0.6" stop-color="rgba(115,103,240,0.6)" offset="0.7"></stop><stop id="SvgjsStop1359" stop-opacity="0.6" stop-color="rgba(115,103,240,0.6)" offset="1"></stop></linearGradient></defs><g id="SvgjsG1341" class="apexcharts-radialbar"><g id="SvgjsG1342"><g id="SvgjsG1343" class="apexcharts-tracks"><g id="SvgjsG1344" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 91.53845410946391 259.1233220103534 A 118.9530487804878 118.9530487804878 0 1 1 259.1233220103534 244.46154589053606" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="22.632926829268296" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 91.53845410946391 259.1233220103534 A 118.9530487804878 118.9530487804878 0 1 1 259.1233220103534 244.46154589053606"></path></g></g><g id="SvgjsG1350"><g id="SvgjsG1355" class="apexcharts-series apexcharts-radial-series" seriesName="CompletedxTask" rel="1" data:realIndex="0"><path id="SvgjsPath1360" d="M 91.53845410946391 259.1233220103534 A 118.9530487804878 118.9530487804878 0 1 1 286.9530487804878 168" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient1356)" stroke-opacity="1" stroke-linecap="butt" stroke-width="22.632926829268296" stroke-dasharray="10" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="230" data:value="85" index="0" j="0" data:pathOrig="M 91.53845410946391 259.1233220103534 A 118.9530487804878 118.9530487804878 0 1 1 286.9530487804878 168"></path></g><circle id="SvgjsCircle1351" r="102.63658536585366" cx="168" cy="168" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1352" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1353" font-family="Public Sans" x="168" y="148" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="600" fill="#a5a3ae" class="apexcharts-text apexcharts-datalabel-label" style="font-family: &quot;Public Sans&quot;;">Completed Task</text><text id="SvgjsText1354" font-family="Public Sans" x="168" y="194" text-anchor="middle" dominant-baseline="auto" font-size="38px" font-weight="600" fill="#5d596c" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">85%</text></g></g></g></g><line id="SvgjsLine1361" x1="0" y1="0" x2="336" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1362" x1="0" y1="0" x2="336" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1338" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 441px; height: 307px;"></div></div><div class="contract-trigger"></div></div></div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Support Tracker -->
  

  

  

  
    
    <!--/ Projects table -->
  </div>

</div>
    


@endsection



@push('extra-js')


@endpush


@push('extra-modal')


@endpush
