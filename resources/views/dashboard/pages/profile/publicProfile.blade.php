@extends('dashboard.layout.base')
@section('content')

    <div class="container-fluid">

        @empty($profile)
            <div class="ui-kit-cards grid mb-24">
                <h4 class="mt-1">Bio Information</h4><hr/>

                <form class="row g-3" id="editOrder" action="{{route('user.profile.public.set')}}"
                      method="post">
                    @csrf
                    <div class="col-md-6 mt-3">
                        <label for="inputEmail4" class="form-label">
                            Education<sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="What is your level of education"></i>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="inputEmail4" name="education">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label">
                            Occupation<sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="What do you do for a living e.g trader, student etc"></i>
                        </label>
                        <input type="text" name="occupation" class="form-control form-control-lg" id="inputPassword4">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputAddress" class="form-label">
                            Short bio <sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="Just a brief intro of your profile. Something catchy"></i>
                        </label>
                        <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="shortBio"></textarea>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputAddress" class="form-label">
                            About <sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="Tell your client(s) who you are and what they should expect from you."></i>
                        </label>
                        <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="about"></textarea>
                    </div>
                    <hr/>
                    <h4 class="mt-24">Body Details</h4>

                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Body Build<sup class="text-danger">*</sup></label>
                        <select name="build" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Body build</option>
                            @foreach($builds as $build)
                                <option value="{{$build->id}}">{{$build->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Bust size<sup class="text-danger">*</sup></label>
                        <select name="bustSize" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Bust size</option>
                            @foreach($busts as $bust)
                                <option value="{{$bust->id}}">{{$bust->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Ethnicity<sup class="text-danger">*</sup></label>
                        <select name="ethnicity" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Ethnicity</option>
                            @foreach($ethnics as $ethnic)
                                <option value="{{$ethnic->id}}">{{$ethnic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Height<sup class="text-danger">*</sup></label>
                        <select name="height" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Height</option>
                            @foreach($heights as $height)
                                <option value="{{$height->id}}">{{$height->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Weight<sup class="text-danger">*</sup></label>
                        <select name="weight" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Weight</option>
                            @foreach($weights as $weight)
                                <option value="{{$weight->id}}">{{$weight->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Looks<sup class="text-danger">*</sup></label>
                        <select name="look" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select look</option>
                            @foreach($looks as $look)
                                <option value="{{$look->id}}">{{$look->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputEmail4" class="form-label">Sexual Orientation<sup class="text-danger">*</sup></label>
                        <select name="sexualOrientation" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select orientation</option>
                            <option>Heterosexual(straight)</option>
                            <option>Bisexual</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="inputCity" class="form-label">Languages<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control form-control-lg selectizeAdd" id="inputCity" name="languages[]">
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Availability for Incall<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="incall" id="gridRadios1" value="1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="incall" id="gridRadios2" value="2">
                            <label class="form-check-label" for="gridRadios2">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Availability for Outcall<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outcall" id="outcall" value="1" checked>
                            <label class="form-check-label" for="outcall">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outcall" id="outcall" value="2">
                            <label class="form-check-label" for="outcall">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Smoker<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="smoker" id="smoker" value="1" checked>
                            <label class="form-check-label" for="smoker">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="smoker" id="smoker" value="2">
                            <label class="form-check-label" for="smoker">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="default-btn submit rounded-pill">
                            Update profile
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="ui-kit-cards grid mb-24">
                <h4 class="mt-1">Bio Information</h4><hr/>

                <form class="row g-3" id="editOrder" action="{{route('user.profile.public.set')}}"
                      method="post">
                    @csrf
                    <div class="col-md-6 mt-3">
                        <label for="inputEmail4" class="form-label">
                            Education<sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="What is your level of education"></i>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="inputEmail4" name="education" value="{{$profile->education}}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputPassword4" class="form-label">
                            Occupation<sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="What do you do for a living e.g trader, student etc"></i>
                        </label>
                        <input type="text" name="occupation" class="form-control form-control-lg" id="inputPassword4"
                        value="{{$profile->occupation}}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputAddress" class="form-label">
                            Short bio <sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="Just a brief intro of your profile. Something catchy"></i>
                        </label>
                        <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="shortBio">{{$profile->shortBio}}</textarea>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputAddress" class="form-label">
                            About <sup class="text-danger">*</sup>
                            <i class="ri-information-fill" data-bs-toggle="tooltip" title="Tell your client(s) who you are and what they should expect from you."></i>
                        </label>
                        <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="about">{{$profile->about}}</textarea>
                    </div>
                    <hr/>
                    <h4 class="mt-24">Body Details</h4>

                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Body Build<sup class="text-danger">*</sup></label>
                        <select name="build" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Body build</option>
                            @foreach($builds as $build)
                                @if($build->id ==$profile->build)
                                    <option value="{{$build->id}}" selected>{{$build->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$build->id}}">{{$build->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Bust size<sup class="text-danger">*</sup></label>
                        <select name="bustSize" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Bust size</option>
                            @foreach($busts as $bust)
                                @if($bust->id ==$profile->bustSize)
                                    <option value="{{$bust->id}}" selected>{{$bust->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$bust->id}}">{{$bust->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Ethnicity<sup class="text-danger">*</sup></label>
                        <select name="ethnicity" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Ethnicity</option>
                            @foreach($ethnics as $ethnic)
                                @if($ethnic->id ==$profile->ethnicity)
                                    <option value="{{$ethnic->id}}" selected>{{$ethnic->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$ethnic->id}}">{{$ethnic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Height<sup class="text-danger">*</sup></label>
                        <select name="height" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Height</option>
                            @foreach($heights as $height)
                                @if($height->id ==$profile->height)
                                    <option value="{{$height->id}}" selected>{{$height->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$height->id}}">{{$height->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Weight<sup class="text-danger">*</sup></label>
                        <select name="weight" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select Weight</option>
                            @foreach($weights as $weight)
                                @if($weight->id ==$profile->weight)
                                    <option value="{{$weight->id}}" selected>{{$weight->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$weight->id}}">{{$weight->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputEmail4" class="form-label">Looks<sup class="text-danger">*</sup></label>
                        <select name="look" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select look</option>
                            @foreach($looks as $look)
                                @if($look->id ==$profile->looks)
                                    <option value="{{$look->id}}" selected>{{$look->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$look->id}}">{{$look->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputEmail4" class="form-label">Sexual Orientation<sup class="text-danger">*</sup></label>
                        <select name="sexualOrientation" class="form-control selectize" id="inputEmail4"
                                required>
                            <option value="">Select orientation</option>
                            <option {{($profile->sexualOrientation=='Heterosexual(straight)')?'selected':''}}>Heterosexual(straight)</option>
                            <option {{($profile->sexualOrientation=='Bisexual')?'selected':''}}>Bisexual</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="inputCity" class="form-label">Languages<sup class="text-danger">*</sup></label>
                        @php
                            $langs =  explode(',',$profile->languages)
                        @endphp
                        <select type="text" class="form-control form-control-lg selectizeAdd" id="inputCity" name="languages[]" multiple>
                            @foreach($langs as $lang)
                                <option value="{{$lang}}" selected>{{$lang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Availability for Incall<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="incall" id="gridRadios1" value="1" {{($profile->incall==1)?'checked':''}}>
                            <label class="form-check-label" for="gridRadios1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="incall" id="gridRadios2" value="2" {{($profile->incall!=1)?'checked':''}}>
                            <label class="form-check-label" for="gridRadios2">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Availability for Outcall<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outcall" id="outcall" value="1" {{($profile->outcall==1)?'checked':''}}>
                            <label class="form-check-label" for="outcall">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outcall" id="outcall" value="2" {{($profile->outcall!=1)?'checked':''}}>
                            <label class="form-check-label" for="outcall">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">Smoker<sup class="text-danger">*</sup></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="smoker" id="smoker" value="1" {{($profile->smoker==1)?'checked':''}}>
                            <label class="form-check-label" for="smoker">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="smoker" id="smoker" value="2" {{($profile->smoker!=1)?'checked':''}}>
                            <label class="form-check-label" for="smoker">
                                No
                            </label>
                        </div>

                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="default-btn submit rounded-pill">
                            Update profile
                        </button>
                    </div>
                </form>
            </div>
        @endempty
    </div>

    @push('js')
        <script src="{{asset('requests/dashboard/orders.js')}}"></script>
    @endpush
@endsection
