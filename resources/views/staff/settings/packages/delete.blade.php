@extends('staff.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24">
            <h4 class="mt-1">Delete Package</h4><hr/>

            <form class="row g-3" id="package" action="{{route('staff.settings.packages.delete')}}"
                  method="post">
                @csrf
                <div class="col-md-6 mt-3" style="display: none;">
                    <label for="inputPassword4" class="form-label">
                        ID<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="id" class="form-control form-control-lg" id="inputPassword4"
                           value="{{$package->id}}"/>
                </div>
                <div class="col-md-12 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Pin<sup class="text-danger">*</sup>
                    </label>
                    <input type="password" name="pin" class="form-control form-control-lg" id="inputPassword4" placeholder="Enter account pin to proceed"
                           maxlength="6" minlength="6"/>
                </div>

                <div class="col-12 text-center mt-5">
                    <button type="submit" class="default-btn submit rounded-pill">
                        Delete
                    </button>
                </div>
            </form>
        </div>

    </div>

    @push('js')
        <script src="{{asset('requests/staff/packages.js')}}"></script>
    @endpush
@endsection
