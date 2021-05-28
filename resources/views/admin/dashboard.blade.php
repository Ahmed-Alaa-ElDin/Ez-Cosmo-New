@extends('layouts.master')

@section('admin-home')
    active
@endsection

@section('style')
    <style>
        #topTenReviewers a.active {
            background-color: #f39c12;
        }

        #topTenVisitors a.active {
            background-color: #dd4b39;
        }

        a.active {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua shadow">
                    <div class="inner">
                        <h3>{{ $productsNum }}</h3>

                        <p>All Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green shadow">
                    <div class="inner">
                        <h3>{{ $usersNum }}</h3>

                        <p>All Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow shadow">
                    <div class="inner">
                        <h3>{{ $reviewsNum }}</h3>

                        <p>Total Reviews</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red shadow">
                    <div class="inner">
                        <h3>{{ $visitsNum }}</h3>

                        <p>Total Visits</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable mb-3">
                <div class="card text-center shadow">
                    <div class="card-header bg-green text-white font-bold">
                        New Users &amp; Products
                    </div>
                    <div class="card-block pt-3 px-1">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tenDaysUsers" role="tab">Last 10 Days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#lastYear" role="tab">Last Year</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tenDaysUsers" role="tabpanel">
                                <div class="nav-tabs-custom p-3 m-0">
                                    <canvas id="tenDayStatUsers"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane" id="lastYear" role="tabpanel">
                                <div class="nav-tabs-custom p-3 m-0">
                                    <canvas id="twelveMonthStatUsers"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>

            </section>
            <!-- /.Left col -->

            <!-- Right col -->
            <section class="col-lg-6 connectedSortable mb-3">
                <div class="card text-center shadow">
                    <div class="card-header bg-red text-white font-bold">
                        Visits &amp; Reviews
                    </div>
                    <div class="card-block pt-3 px-1">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tenDaysVisits" role="tab">Last 10 Days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#lastYearVisits" role="tab">Last Year</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tenDaysVisits" role="tabpanel">
                                <div class="nav-tabs-custom p-3 m-0">
                                    <canvas id="tenDayStatVisits"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane" id="lastYearVisits" role="tabpanel">
                                <div class="nav-tabs-custom p-3 m-0">
                                    <canvas id="twelveMonthStatVisits"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>

            </section>
            <!-- /.Right col -->

            {{-- Last 10 Section --}}
            <section class="col-lg-6 connectedSortable mb-3">
                <div class="card text-center shadow">
                    <div class="card-header bg-aqua font-bold">
                        Last 10
                    </div>
                    <div class="card-block pt-3 pb-2 px-2">
                        {{-- Top Tabs --}}
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#lastTenProducts" role="tab">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#lastTenUsers" role="tab">Users</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane pt-2 active" id="lastTenProducts" role="tabpanel">
                                <table class="w-100 table-striped table-bordered table-hover">
                                    <thead class="bg-aqua">
                                        <tr >
                                            <th class="py-2">#</th>
                                            <th>Name</th>
                                            <th>Brand</th>
                                            <th>Created on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lastTenProducts as $product)
                                        <tr>
                                            <th class="py-2">{{$loop->iteration}}</th>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->brand->name}}</td>
                                            <td>{{date('Y/m/d',strtotime($product->created_at))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane pt-2 " id="lastTenUsers" role="tabpanel">
                                <table class="w-100 table-striped table-bordered table-hover">
                                    <thead class="bg-green">
                                        <tr >
                                            <th class="py-2">#</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Joined on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lastTenUsers as $person)
                                        <tr>
                                            <th class="py-2">{{$loop->iteration}}</th>
                                            <td>{{$person->first_name}} {{$person->last_name}}</td>
                                            <td>{{$person->country->name}}</td>
                                            <td>{{date('Y/m/d',strtotime($person->created_at))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.nav-tabs-custom -->
                        {{-- /.Top Tabs --}}
                    </div>
                </div>

            </section>
            
            {{-- Top 10 Section --}}
            <section class="col-lg-6 connectedSortable mb-3">
                <div class="card text-center shadow">
                    <div class="card-header bg-yellow font-bold">
                        Top 10
                    </div>
                    <div class="card-block pt-3 px-2">
                        {{-- Top Tabs --}}
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#topTenReviewers" role="tab">Reviewers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#topTenVisitors" role="tab">Visitors</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane pt-2 active" id="topTenReviewers" role="tabpanel">
                                {{-- Child Taps for Reviewers --}}
                                <ul class="nav nav-pills nav-pills flex justify-center" role="tablist">
                                    <li class="nav-item mx-3">
                                        <a class="nav-link active" data-toggle="tab" href="#topTenReviewersDaily" role="tab">Last Week</a>
                                    </li>
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" data-toggle="tab" href="#topTenReviewersMonthly" role="tab">Last Year</a>
                                    </li>
                                </ul>
        
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane table-responsive p-2 active" id="topTenReviewersDaily" role="tabpanel">
                                        {{-- Top Ten Reviewers Weekly --}}
                                        <table class="w-100 table-striped table-bordered table-hover">
                                            <thead class="bg-yellow">
                                                <tr >
                                                    <th class="py-2">#</th>
                                                    <th>Name</th>
                                                    <th>Country</th>
                                                    <th>No. of Visits</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topTenReviewersWeek as $person)
                                                <tr>
                                                    <th class="py-2">{{$loop->iteration}}</th>
                                                    <td>{{$person['name']}}</td>
                                                    <td>{{$person['country']}}</td>
                                                    <td>{{$person['reviews']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-responsive p-2" id="topTenReviewersMonthly" role="tabpanel">
                                        {{-- Top Ten Reviewers Yearly --}}
                                        <table class="w-100 table-striped table-bordered table-hover">
                                            <thead class="bg-yellow">
                                                <tr >
                                                    <th class="py-2">#</th>
                                                    <th>Name</th>
                                                    <th>Country</th>
                                                    <th>No. of Visits</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topTenReviewersYear as $person)
                                                <tr>
                                                    <th class="py-2">{{$loop->iteration}}</th>
                                                    <td>{{$person['name']}}</td>
                                                    <td>{{$person['country']}}</td>
                                                    <td>{{$person['reviews']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- /.Child Taps for Reviewers --}}
                            </div>

                            <div class="tab-pane pt-2 " id="topTenVisitors" role="tabpanel">
                                {{-- Child Taps for Visitors --}}
                                <ul class="nav nav-pills flex justify-center " role="tablist">
                                    <li class="nav-item mx-3">
                                        <a class="nav-link active" data-toggle="tab" href="#topTenVisitorsDaily" role="tab">Last Week</a>
                                    </li>
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" data-toggle="tab" href="#topTenVisitorsMonthly" role="tab">Last Year</a>
                                    </li>
                                </ul>
        
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane table-responsive p-2 active" id="topTenVisitorsDaily" role="tabpanel">
                                        {{-- Top Ten Visitors Daily --}}
                                        <table class="w-100 table-striped table-bordered table-hover">
                                            <thead class="bg-red">
                                                <tr >
                                                    <th class="py-2">#</th>
                                                    <th>Name</th>
                                                    <th>Country</th>
                                                    <th>No. of Visits</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topTenVisitsWeek as $person)
                                                <tr>
                                                    <th class="py-2">{{$loop->iteration}}</th>
                                                    <td>{{$person->first_name}} {{$person->last_name}}</td>
                                                    <td>{{$person->country->name}}</td>
                                                    <td>{{$person->visit_num}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-responsive p-2" id="topTenVisitorsMonthly" role="tabpanel">
                                        {{-- Top Ten Visitors Yearly --}}
                                        <table class="w-100 table-striped table-bordered table-hover">
                                            <thead class="bg-red">
                                                <tr >
                                                    <th class="py-2">#</th>
                                                    <th>Name</th>
                                                    <th>Country</th>
                                                    <th>No. of Visits</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topTenVisitsYear as $person)
                                                <tr>
                                                    <th class="py-2">{{$loop->iteration}}</th>
                                                    <td>{{$person->first_name}} {{$person->last_name}}</td>
                                                    <td>{{$person->country->name}}</td>
                                                    <td>{{$person->visit_num}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- /.Child Taps for Visitors --}}
                            </div>
                        </div>
                        <!-- /.nav-tabs-custom -->
                        {{-- /.Top Tabs --}}
                    </div>
                </div>

            </section>

        </div>
        <!-- /.row (main row) -->
    </section>
@endsection

@section('script')

    {{-- NO. of new user and product / day for 10 days & / month for a year --}}

    {{-- 1- for 10 days --}}
    var ctx = $('#tenDayStatUsers').get(0).getContext('2d');
    var tenDayStatUsers = new Chart(ctx, {
    type: 'line',
    data: {
    labels : [
    @foreach ($days as $day)
        "{{ $day }}" ,
    @endforeach
    ],
    datasets: [
    {
    label: 'New Products',
    data: [{{ implode(',', $productsPerDays) }}],
    fill: true,
    borderColor: '#49c0ef',
    backgroundColor:'#00c0ef57',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    {
    label: 'New Users',
    data: [{{ implode(',', $usersPerDays) }}],
    fill: true,
    borderColor: '#54a75a',
    backgroundColor:'#54a75a69',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    ]
    },
    options: {
    normalized: true
    }
    });

    {{-- 2- for a Year --}}
    var ctx = $('#twelveMonthStatUsers').get(0).getContext('2d');
    var twelveMonthStatUsers = new Chart(ctx, {
    type: 'line',
    data: {
    labels : [
    @foreach ($months as $month)
        "{{ $month }}" ,
    @endforeach
    ],
    datasets: [
    {
    label: 'New Products',
    data: [{{ implode(',', $productsPerMonths) }}],
    fill: true,
    borderColor: '#49c0ef',
    backgroundColor:'#00c0ef57',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    {
    label: 'New Users',
    data: [{{ implode(',', $usersPerMonths) }}],
    fill: true,
    borderColor: '#54a75a',
    backgroundColor:'#54a75a69',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    ]
    },
    options: {
    normalized: true
    }
    });

    {{-- NO. of Visits and New Reviews / day for 10 days & / month for a year --}}

    {{-- 1- Last 10 Days --}}
    var ctx = $('#tenDayStatVisits').get(0).getContext('2d');
    var tenDayStatVisits = new Chart(ctx, {
    type: 'line',
    data: {
    labels : [
    @foreach ($days as $day)
        "{{ $day }}" ,
    @endforeach
    ],
    datasets: [
    {    
        label: 'New Reviews',
        data: [{{ implode(',', $reviewsPerDays) }}],
        fill: true,
        borderColor: '#f39c12',
        backgroundColor:'#f39c1280',
        tension: 0.3,
        borderJoinStyle: "round",
        },
    {
        label: 'No. Visits',
        data: [{{ implode(',', $visitsPerDays) }}],
        fill: true,
        borderColor: '#dd4b38',
        backgroundColor:'#dd4b429e',
        tension: 0.3,
        borderJoinStyle: "round",
        },
    ]
    },
    options: {
    normalized: true
    }
    });

    {{-- 2- for a Year --}}
    var ctx = $('#twelveMonthStatVisits').get(0).getContext('2d');
    var twelveMonthStatVisits = new Chart(ctx, {
    type: 'line',
    data: {
    labels : [
    @foreach ($months as $month)
        "{{ $month }}" ,
    @endforeach
    ],
    datasets: [
    {
    label: 'New Reviews',
    data: [{{ implode(',', $reviewsPerMonths) }}],
    fill: true,
    borderColor: '#f39c12',
    backgroundColor:'#f39c1280',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    {
    label: 'New Users',
    data: [{{ implode(',', $visitsPerMonths) }}],
    fill: true,
    borderColor: '#dd4b38',
    backgroundColor:'#dd4b429e',
    tension: 0.3,
    borderJoinStyle: "round",
    },
    ]
    },
    options: {
    normalized: true
    }
    });


@endsection
