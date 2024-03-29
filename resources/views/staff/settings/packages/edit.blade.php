@extends('staff.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24">
            <h4 class="mt-1">Package Information</h4><hr/>

            <form class="row g-3" id="package" action="{{route('staff.settings.packages.update')}}"
                  method="post">
                @csrf
                <div class="col-md-12 mt-3">
                    <label for="inputEmail4" class="form-label">
                        Name<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" class="form-control form-control-lg" id="inputEmail4" name="name"
                    value="{{$package->name}}"/>
                </div>
                <div class="col-md-12 mt-3">
                    <label for="inputEmail4" class="form-label">
                        Description<sup class="text-danger">*</sup>
                    </label>
                    <textarea type="text" class="form-control form-control-lg" rows="4" id="inputEmail4" name="description">{{$package->description}}</textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Month Amount<sup class="text-danger">*</sup>
                    </label>
                    <input type="number" step="0.01" name="monthAmount" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$package->monthAmount}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Annual Amount<sup class="text-danger">*</sup>
                    </label>
                    <input type="number" step="0.01" name="annualAmount" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$package->annualAmount}}"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Fee(%)<sup class="text-danger">*</sup>
                    </label>
                    <input type="number" step="0.01" name="fee" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$package->fee}}"/>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="isRecommended" value="1"
                        {{($package->isRecommended==1)?'checked':''}}>
                        <label class="form-check-label" for="gridCheck">
                            Is Recommended
                        </label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isFree" name="isFree" value="1"
                            {{($package->isFree==1)?'checked':''}}>
                        <label class="form-check-label" for="isFree">
                            Is Free?
                        </label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hasFeatured" name="hasFeatured" value="1"
                            {{($package->hasFeatured==1)?'checked':''}}>
                        <label class="form-check-label" for="hasFeatured">
                            Has Featured?
                        </label>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Featured Duration<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="featuredDuration" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$package->featuredDuration}}"/>
                </div>
                <div class="col-md-6 mt-3" style="display: none;">
                    <label for="inputPassword4" class="form-label">
                        ID<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="id" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$package->id}}"/>
                </div>

                <div class="col-md-6 mt-3">
                    <label for="inputEmail4" class="form-label">Status<sup class="text-danger">*</sup></label>
                    <select name="status" class="form-control selectize" id="inputEmail4"
                            required>
                        <option value="">Select Status</option>
                        <option value="1" {{($package->status==1)?'selected':''}}>ACTIVE</option>
                        <option value="2" {{($package->status!=1)?'selected':''}}>INACTIVE</option>
                    </select>
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
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>

    @push('js')
        <script src="{{asset('requests/staff/packages.js')}}"></script>
    @endpush
@endsection
