<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
      <section>
        <div class="container">
            <div class="col-md-10 m-auto">
                <br>
                <h1 class="text-center mt-10">Flight Search</h1>
                <form action="{{ route('flight.search') }}" method="POST">
                    @csrf
                    @if (isset($message))
                        <div class="alert alert-success">{{$message}}</div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">{{session('warning')}}</div>
                    @endif
                    <table class="table">
                      @foreach ($errors->all() as $error)
                          <li class="alert alert-danger">{{ $error }}</li>
                      @endforeach
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Flight Number</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="flight_number">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="time" class="form-control" id="exampleInputPassword1" name="time">
                    </div>
                    <div class="mb-3 form-check">
                    </div>
                    <button type="submit" class="btn btn-primary">Search Flights</button>
                </form>
            </div>
        </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>