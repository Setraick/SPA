<!DOCTYPE html>
<html>
<head>
  
</div>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard" style="color:#ffffff">Back</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <br>
    <h1>Users List</h1>
    <br><br><br>
    <div class="container">    
        <a class="btn btn-sm btn-success float-right" href="{{route('admin.users.create')}}"_role="button">create</a>
        <div class="card" >
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit', $user->id)}}"_role="button">edit</a>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-user-form-{{$user->id}}').submit()">
                                DELETE
                            </button>
                            <form id="delete-user-form-{{$user->id}}" action="{{ route('admin.users.destroy',$user->id)}}" method="POST" STYLE="display:none">
                                @csrf
                                @method("DELETE")
                            </form>
                        </td>
                    </tr>
                @endforeach        
            </tbody>
            </table>
            {{$users->links()}} 
        </div>
    </div>

 
<script>

</script>
<style>
    h1 {
  text-align: center;
    }
    .navbar-custom {
            background-color: #ff6f2c;

        }
</style>
</body>
</html>