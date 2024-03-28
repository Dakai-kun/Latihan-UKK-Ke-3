@extends('layout.dashboard')
@section('content')

<section>
    <div class="row">
        <div class="col-lg-8">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Form</h5>
                    
                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{route('user.update', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="col-6">
                            <label for="inputName4" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName4" name="name" value="{{$user->name}}">
                        </div>
                        <div class="col-6">
                            <label for="inputUsername4" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsername4" name="username" value="{{$user->username}}">
                        </div>
                        <div class="col-6">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email" value="{{$user->email}}">
                        </div>
                        <div class="col-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="password" value="{{$user->email}}">
    </div>
    <div class="col-md-12">
                  <label for="inputState" class="form-label">Role</label>
                  <select id="inputState" class="form-select" name="role">
                    <option selected>Choose...</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                  </select>
                </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form><!-- Vertical Form -->
    
</div>
</div>
</div>
</section>
@endsection