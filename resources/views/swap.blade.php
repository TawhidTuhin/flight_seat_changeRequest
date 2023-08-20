<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
      <section>
        <div class="container">
            <div class="col-md-10 m-auto">
              <br>
                <h1 class="text-center mt-10">Flight Search Results</h1>
                @if(isset($warning))
                  <div class="alert alert-warning m-auto text-center">{{ $warning }}</div>
                @endif
                <div class="flight-details col-md-4">
                    <br>
                    <table class="table">
                        <tbody>
                          <tr>
                            <th colspan="2">Flight Number</th>
                            <td>{{ $data->flight_number }}</td>
                          </tr>
                          <tr>
                            <th colspan="2">Date</th>
                            <td>{{ $data->date }}</td>
                          </tr>
                          <tr>
                            <th colspan="2">Time</th>
                            <td>{{ $data->time }}</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
                <form action="{{ route('swap.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" value="{{$data->flight_number}}" name="flight_number">
                        <input type="hidden" value="{{$data->date}}" name="date">
                        <input type="hidden" value="{{$data->time}}" name="time">
                        <label for="exampleInputPassword1" class="form-label">Select Your Seat Number</label>
                        <select class="form-select" aria-label="Default select example" name="current_seat">
                            <option selected>Open this select menu</option>
                            <option value="2C">2C</option>
                            <option value="4A">4A</option>
                            <option value="3D">3D</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Swap Seat Number</label>
                        <select class="form-select" aria-label="Default select example" name="swap_seat">
                            <option selected>Open this select menu</option>
                            <option value="ANY">ANY</option>
                            <option value="2C">3D</option>
                            <option value="4A">4A</option>
                            <option value="3D">3D</option>
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
            
            <div class="col-md-10 m-auto">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">My seat</th>
                        <th scope="col">Swap To</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($swaps as $item)
                          <tr>
                            <td>{{ $item->current_seat }}</td>
                            <td>{{ $item->swap_set }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                              <form method="POST" action="{{ route('swap.delete', $item->id) }}">
                                  @csrf
                                  
                                  <button type="submit" class="btn btn-danger confirm-button" >Delete</button>
                              </form>
                            </td>
                              
                          </tr>
                        @endforeach 
                    </tbody>
                  </table>
                
            </div>
        </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

      $('.confirm-button').click(function(event) {
          var form =  $(this).closest("form");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this row?`,
              text: "It will gone forevert",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
              .then((willDelete) => {
                  if (willDelete) {
                      form.submit();
                  }
              });
      });
  
  </script>
</body>
</html>