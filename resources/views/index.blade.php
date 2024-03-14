<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('sitecontent/css/stylesheet.css') }}"/>

        <script type="text/javascript">
            function show(showid, hideid){
                $elementToDisplay = document.getElementById(showid).style.display = 'block'
                $elementToHide = document.getElementById(hideid).style.display = 'none'
                 
            }

        </script>
    </head>
    <body class="">
        <div class="pageWrapper" >
            
            <div class="row mt-5">
                <div class="col-md-8 col-sm-12 centered">
                    <div class="nav-links d-flex flex-row justify-content-between">
                        <div>
                            <a class="nav-buttons btn btn-primary" href="{{ route('upload.export') }}">export to spreadsheet</a>
                        </div>
    
                        <div>
                            <button type="button" class="btn btn-success" onclick="show('formImport', 'chartBody')">Import data</button>
                        </div>
                    </div>
                </div>
                @if($errors->any())

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        @endif

                        @if(Session::has('message'))
                            <div class="alert {{ Session::get('message-color') }} alert-dismissible fade show " role="alert">
                                <strong>{{ Session::get('message') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                        @endif
                
            </div>
            <div class="row" style="display: none" id="formImport">
                <div class="col-md-8 col-sm-12 centered">
                    <div class="d-block">
                        <h3 class="h3">Upload Excel Sheet here for analysis</h3>
                        
                       <form method="post" action="{{ route('upload.import') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row form-row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Upload Excel File</label>
                                        <input type="file" class="form-control" name="excelfile" />
                                    </div>
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
            <div class="row" id="chartBody">
                <div class="col-md-8 col-sm-12 centered">
                    <div class="chartWarpper">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                        <div>
                            <canvas id="myChart2"></canvas>
                        </div>

                        <div>
                            <canvas id="myChart3"></canvas>
                        </div>
                        <div>
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-12 centered">
                    <table class="table table-striped">
                                    
                        <thead>
                            <tr >
                                <td>Name</td>
                                <td>Email </td>
                                <td>Country</td>
                                <td>State</td>
                                <td>gender</td>
                                <td>age</td>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr >
                                <td>
                                    
                                    <span title="" >{{ $user->name }}</span>
                                </td>
                                <td>
                                    <span title="" >{{ $user->email }}</span>
                                </td>
                                <td><span title="" >{{ $user->country }}</span></td>
                                <td><span title="" >{{ $user->state }}</span></td>
                                <td><span title="" >{{ $user->gender }}</span></td>
                                <td><span title="" >{{ $user->age }}</span></td>
                                
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                    <div class="rows pagination-row">
                        <div class="grey-text page-number">
                            
                        </div>
                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    {{$users->links()}}
                                </ul>
                                </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    (async function() {

        let women = {{ $gender['female']->count() }};
        let men = {{ $gender['male']->count()  }};

        let agelessthan18 = {{ $agelessthan18 }};
        let agelessthan25 =  {{$agelessthan25  }};
        let agelessthan40 = {{ $agelessthan40 }};
        let agelessthan60 = {{ $agelessthan60 }};
        let agelessthan100 = {{ $agelessthan100 }};



        const ctx1 = document.getElementById('myChart');
        const ctx2 = document.getElementById('myChart2');
        const ctx13 = document.getElementById('myChart3');
        const ctx4 = document.getElementById('myChart4');


        const data = [
            { year: 2010, count: 10 },
            { year: 2011, count: 20 },
            { year: 2012, count: 15 },
            { year: 2013, count: 25 },
            { year: 2014, count: 22 },
            { year: 2015, count: 30 },
            { year: 2016, count: 28 },
        ];

        const genderData = [
            {gender: 'Female', count: women},
            {gender: 'Male', count: men},
        ];

        const ageData = [
            {age: '0 - 17', count: agelessthan18},
            {age: '18 - 24', count: agelessthan25},
            {age: '25 - 39', count: agelessthan40},
            {age: '40 - 59', count: agelessthan60},
            {age: '60 - 100', count: agelessthan100},
            
        ];

        // initial bar chart
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ageData.map(row => row.age),
                datasets: [
                {
                    label: 'User Data By Age',
                    data: ageData.map(row => row.count)
                }
                ]
            }
            }
        );

        // initiate line chart
        new Chart(ctx13, {
            type: 'line',
            data: {
                labels: data.map(row => row.year),
                datasets: [
                {
                    label: 'Acquisitions by year',
                    data: data.map(row => row.count)
                }
                ]
            }
            }
        );

        // initiate doughnut piechart
        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: ageData.map(row => row.age),
                datasets: [
                {
                    label: 'Users Age Data',
                    data: ageData.map(row => row.count)
                }
                ]
            }
            }
        );
        

        // initiate pie chart for gender data
        new Chart(ctx2, {
            type: 'pie',
            data: {
            labels: genderData.map(row => row.gender),
            datasets: [{
                label: 'Number of registered users',
                data: genderData.map(row => row.count),
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });

    })();
    
    
   

    

    </script>
</body>
</html>