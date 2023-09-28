@extends('backend.layout.app')

@section('style')
@endsection


@section('content')

    {{-- <div class="pagetitle" style="margin-bottom: 20px;">
        <h1>Users List</h1>
    </div> --}}


    <section class="section">
        <div class="row">


          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Edit User</h5>

                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">
                    @csrf


                  <div class="col-12">
                    <label for="inputNanme4" class="form-label">Your Name</label>
                    <input type="text" value="{{ $getRecord->name}}" name="name" required class="form-control" id="inputNanme4">
                    <div style="color:red;">{{$errors->first('name')}}</div>
                  </div>


                  <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" value="{{ $getRecord->email}}" name="email" required class="form-control" id="inputEmail4">
                    <div style="color:red;">{{$errors->first('email')}}</div>
                  </div>


                  <div class="col-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="text"  name="password" class="form-control" id="inputPassword4">
                    <p style="margin-bottom: 0px; margin-top: 5px; font-size:14px; ">Want to change password? please fill in new password</p>
                    <div style="color:red;">{{$errors->first('password')}}</div>
                  </div>

                  <div class="col-12">
                    <label for="inputPassword4" class="form-label">Status</label>
                   <select name="" id="" class="form-control" name="status">
                        <option {{ ($getRecord->status == 1) ? 'selected' : ''}} value="1">Active</option>
                        <option {{ ($getRecord->status == 0) ? 'selected' : ''}} value="0">Inactive</option>
                   </select>
                  </div>



                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>

                  </div>
                </form><!-- Vertical Form -->

              </div>
            </div>






          </div>
        </div>
      </section>


    @endsection


@section('script')
@endsection
