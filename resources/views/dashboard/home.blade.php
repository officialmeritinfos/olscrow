@extends('dashboard.layout.base')
@section('content')
    <div class="today-card-area pt-24">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">Today's Money</span>
                            <h6>$63,000 <span>+55%</span></h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">Today's Active Users</span>
                            <h6>$2,300 <span>+3%</span></h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/images/icon/user.png')}}" alt="Images">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">New Clients</span>
                            <h6>+3,462 <span class="hot">-2%</span></h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">Sales Of This Week</span>
                            <h6>$103,450% <span>+5%</span></h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overview-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="chart-wrap">
                        <div class="sales-overview d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="overview-content">
                                    Sales Overview
                                    <i class="ri-arrow-up-line"></i>
                                    <span class="more">4% More in 2021</span>
                                </h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <ul>
                                    <li>
                                        <span>This Month</span>
                                        <h6 class="this-month">$86,589</h6>
                                    </li>
                                    <li>
                                        <span>Last Month</span>
                                        <h6>$86,589</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div id="ana_dash_1"></div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="active-user">
                        <div id="stacked-column-chart-2"></div>

                        <div class="active-user-content-wrap">
                            <h6 class="active-user-content">
                                Active Users
                                <i class="ri-arrow-up-line"></i>
                                <span class="more">4% More in 2021</span>
                            </h6>

                            <div class="row justify-content-center">
                                <div class="col-lg-3 col-sm-6 col-md-3">
                                    <div class="active-single-item">
                                        <p>
                                            <img src="{{asset('dashboard/images/icon/user-2.png')}}" alt="Images">
                                            Users
                                            <span>340 K</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-md-3">
                                    <div class="active-single-item">
                                        <p>
                                            <img src="{{asset('dashboard/images/icon/curser.png')}}" alt="Images">
                                            Click
                                            <span>500 M</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-md-3">
                                    <div class="active-single-item">
                                        <p>
                                            <img src="{{asset('dashboard/images/icon/discount-2.png')}}" alt="Images">
                                            Sales
                                            <span>435 $</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-md-3">
                                    <div class="active-single-item">
                                        <p>
                                            <img src="{{asset('dashboard/images/icon/items.png')}}" alt="Images">
                                            Items
                                            <span>12,350</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="analytics-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="activity-timeline" data-simplebar>
                        <h3>Activity Timeline</h3>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="ri-add-line"></i>
                                    <h6>Activity Timeline</h6>
                                    <p>Bonbon macaroon jelly beans gummi bears jelly…..</p>
                                    <span>25 Mins Ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ri-information-line"></i>
                                    <h6>Email Newsletter</h6>
                                    <p>Cupcake gummi bears soufflé caramels candy</p>
                                    <span>15 Days Ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ri-check-line"></i>
                                    <h6>Plan Webinar</h6>
                                    <p>Candy ice cream cake. Halvah gummi bears</p>
                                    <span>20 Days Ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ri-check-line"></i>
                                    <h6>Launch Website</h6>
                                    <p>Candy ice cream cake. Halvah gummi bears Cupcake...</p>
                                    <span>25 Mins Ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ri-add-line"></i>
                                    <h6>Marketing</h6>
                                    <p>Bonbon macaroon jelly beans gummi bears jelly…..</p>
                                    <span>28 Days Ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ri-add-line"></i>
                                    <h6>Activity Timeline</h6>
                                    <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                    <span>25 Mins Ago</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="analytics-wrap">
                        <h3>Sales Analytics</h3>

                        <div id="stacked-column-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest-transaction-area">
        <div class="container-fluid">
            <div class="table-responsive" data-simplebar>
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th scope="col">ORDER ID</th>
                        <th scope="col">CUSTOMER</th>
                        <th scope="col">DATE</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">PAYMENT METHOD</th>
                        <th scope="col">VIEW DETAILS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT001
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-1.png')}}" alt="Images">
                            Adam Smith
                        </td>
                        <td>
                            01 Jun, 2021 - 10:32 AM
                        </td>
                        <td class="bold">
                            $ 450.00
                        </td>
                        <td class="status">
                            <i class="ri-checkbox-circle-line"></i>
                            Paid
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/mastercard.png')}}" alt="Images">
                            Mastercard
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT002
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-2.png')}}" alt="Images">
                            Victor James
                        </td>
                        <td>
                            01 Jun, 2021 - 11:12 AM
                        </td>
                        <td class="bold">
                            $ 311.50
                        </td>
                        <td class="status canceled">
                            <i class="ri-close-circle-line"></i>
                            Canceled
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/visa.png')}}" alt="Images">
                            Visa
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT003
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-3.png')}}" alt="Images">
                            Anna Belly
                        </td>
                        <td>
                            01 Jun, 2021 - 10:32 AM
                        </td>
                        <td class="bold">
                            $ 250.75
                        </td>
                        <td class="status refunded">
                            <i class="ri-exchange-dollar-line"></i>
                            Refunded
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/paypal.png')}}" alt="Images">
                            PayPal
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT004
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-4.png')}}" alt="Images">
                            John Karahan
                        </td>
                        <td>
                            02 Jun, 2021 - 11:12 AM
                        </td>
                        <td class="bold">
                            $ 592.10
                        </td>
                        <td class="status">
                            <i class="ri-checkbox-circle-line"></i>
                            Paid
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/mastercard.png')}}" alt="Images">
                            Mastercard
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT005
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-5.png')}}" alt="Images">
                            Emmeli Smith
                        </td>
                        <td>
                            01 Jun, 2021 - 09:32 AM
                        </td>
                        <td class="bold">
                            $ 115.50
                        </td>
                        <td class="status">
                            <i class="ri-checkbox-circle-line"></i>
                            Paid
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/mastercard.png')}}" alt="Images">
                            Mastercard
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT006
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-6.png')}}" alt="Images">
                            Jonathon Ronan
                        </td>
                        <td>
                            01 Jun, 2021 - 12:32 PM
                        </td>
                        <td class="bold">
                            $ 450.00
                        </td>
                        <td class="status">
                            <i class="ri-checkbox-circle-line"></i>
                            Paid
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/paypal.png')}}" alt="Images">
                            PayPal
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT007
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-7.png')}}" alt="Images">
                            Adnan Hyder
                        </td>
                        <td>
                            01 Jun, 2021 - 11:32 AM
                        </td>
                        <td class="bold">
                            $ 311.50
                        </td>
                        <td class="status canceled">
                            <i class="ri-checkbox-circle-line"></i>
                            Canceled
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/mastercard.png')}}" alt="Images">
                            Mastercard
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT008
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-8.png')}}" alt="Images">
                            Adnan Smith
                        </td>
                        <td>
                            01 Jun, 2021 - 09:32 AM
                        </td>
                        <td class="bold">
                            $ 250.75
                        </td>
                        <td class="status">
                            <i class="ri-checkbox-circle-line"></i>
                            Paid
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/mastercard.png')}}" alt="Images">
                            Mastercard
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    #3SDT002
                                </label>
                            </div>
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/customer-2.png')}}" alt="Images">
                            Victor James
                        </td>
                        <td>
                            01 Jun, 2021 - 11:12 AM
                        </td>
                        <td class="bold">
                            $ 311.50
                        </td>
                        <td class="status canceled">
                            <i class="ri-checkbox-circle-line"></i>
                            Canceled
                        </td>
                        <td>
                            <img src="{{asset('dashboard/images/customer/visa.png')}}" alt="Images">
                            Visa
                        </td>
                        <td>
                            <a href="order-details" class="read-more">
                                View Details
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="target-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="target-chart mb-0 mb-m-24">
                        <h3>Target</h3>
                        <div id="target-chart"></div>

                        <ul>
                            <li>Weekly</li>
                            <li>Monthly</li>
                            <li>Yearly</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="social-media mb-0 mb-m-24">
                        <h3>Sales From Social Media</h3>

                        <div class="row align-items-center mb20 color-facebook">
                            <div class="col-lg-2">
                                <i class="ri-facebook-fill"></i>
                            </div>
                            <div class="col-lg-8">
                                <span class="bar"></span>
                            </div>
                            <div class="col-lg-2">
                                <span class="counter">340K</span>
                            </div>
                        </div>

                        <div class="row align-items-center mb20 color-twitter">
                            <div class="col-lg-2">
                                <i class="ri-twitter-fill"></i>
                            </div>
                            <div class="col-lg-8">
                                <span class="bar"></span>
                            </div>
                            <div class="col-lg-2">
                                <span class="counter">340K</span>
                            </div>
                        </div>

                        <div class="row align-items-center mb20 color-instagram">
                            <div class="col-lg-2">
                                <i class="ri-instagram-fill"></i>
                            </div>
                            <div class="col-lg-8">
                                <span class="bar"></span>
                            </div>
                            <div class="col-lg-2">
                                <span class="counter">340K</span>
                            </div>
                        </div>

                        <div class="row align-items-center mb20 color-youtube">
                            <div class="col-lg-2">
                                <i class="ri-youtube-fill"></i>
                            </div>
                            <div class="col-lg-8">
                                <span class="bar"></span>
                            </div>
                            <div class="col-lg-2">
                                <span class="counter">340K</span>
                            </div>
                        </div>

                        <ul class="social-text">
                            <li>Facebook</li>
                            <li>Twitter</li>
                            <li class="mb-0">Instagram</li>
                            <li class="mb-0">Youtube</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="country-chart mb-0">
                        <h3>Country Base Clients</h3>
                        <div id="country-chart"></div>

                        <ul>
                            <li>United States</li>
                            <li>Canada</li>
                            <li class="mb-0">Asian Country</li>
                            <li class="mb-0">Others</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-1"></div>

    <div class="footer-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="copy-right">
                        <p>Copyright @2022 Dashli. Designed By <a href="https://envytheme.com/" target="_blank">EnvyTheme</a></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="social-link">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com/" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/" target="_blank">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vimeo.com/" target="_blank">
                                    <i class="ri-vimeo-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
