@extends('staff.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24">
            <h4 class="mt-1">Staff Information</h4><hr/>

            <form class="row g-3" id="addStaff" action="{{route('staff.staff.create')}}"
                  method="post">
                @csrf
                <div class="col-md-6 mt-3">
                    <label for="inputEmail4" class="form-label">
                        Name<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" class="form-control form-control-lg" id="inputEmail4" name="name"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Email<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="email" class="form-control form-control-lg" id="inputPassword4"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Username<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="username" class="form-control form-control-lg" id="inputPassword4"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Password<sup class="text-danger">*</sup>
                    </label>
                    <input type="password" name="password" class="form-control form-control-lg" id="inputPassword4"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Role<sup class="text-danger">*</sup>
                    </label>
                    <select type="text" name="role" class="form-control form-control-lg" id="inputPassword4">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Pin<sup class="text-danger">*</sup>
                    </label>
                    <input type="password" name="pin" class="form-control form-control-lg" id="inputPassword4" placeholder="Enter account pin to proceed"/>
                </div>

                <div class="col-12 text-center mt-5">
                    <button type="submit" class="default-btn submit rounded-pill">
                        Add Staff
                    </button>
                </div>
            </form>
        </div>

    </div>

    @push('js')
        <script src="{{asset('requests/staff/staff.js')}}"></script>
    @endpush
@endsection
