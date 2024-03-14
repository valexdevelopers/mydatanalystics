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
    </head>
    <body class="">
        <div class="pageWrapper" >
            
            <div class="row">
                <div class="col-md-8 col-sm-12 centered">
                    <div class="nav-links d-flex flex-row justify-content-between">
                        
    
                        <div>
                            <a href="" class="btn btn-success">back data</a>
                        </div>
                    </div>
                </div>
                
                
            </div>
        {{-- {{ dd($allusers) }} --}}
            <div class="row">
                <div class="col-md-8 col-sm-12 centered">
                    <div class="d-block">
                        <h3 class="h3">Upload Excel Sheet here for analysis</h3>
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

            
        </div>
        
     
</body>
</html>