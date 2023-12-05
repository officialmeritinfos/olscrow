<div class="pricing-area">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($packages as $package)

                <div class="col-lg-4 col-md-6">
                    <div class="single-pricing-card">
                        <div class="pricing-bar">
                            <span>{{$package->title}}  </span>
                            <p>{!! $package->description !!}</p>
                        </div>

                        <div class="price-list">
                            <ul>
                                @if(!empty($package->amount) || $package->amount!=0)
                                    <li>
                                        <i class="ri-check-line"></i>
                                        <b>Short-time:</b>
                                        {{$package->currency}}{{number_format($package->amount)}}
                                    </li>
                                @endif
                                @if(!empty($package->overnight) || $package->overnight!=0)
                                    <li>
                                        <i class="ri-check-line"></i>
                                        <b>Overnight:</b>
                                        {{$package->currency}}{{number_format($package->overnight)}}
                                    </li>
                                @endif
                                @if(!empty($package->weekend) || $package->weekend!=0)
                                    <li>
                                        <i class="ri-check-line"></i>
                                        <b>Weekend:</b>
                                        {{$package->currency}}{{number_format($package->weekend)}}
                                    </li>
                                @endif
                            </ul>

                            <a href="#" class="default-btn">
                                Choose plan
                            </a>
                            <p style="font-size: 10px; margin-top: 1rem;">
                                Please ensure that the Escort is online before booking an order; alternatively, you can book
                                for a different date and time and we will notify the Escort.
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>

