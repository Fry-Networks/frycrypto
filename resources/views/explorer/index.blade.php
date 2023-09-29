@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Peak Power</h4>
                                        <h3 class="fw-bold">0 W</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="sun"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Green Energy</h4>
                                        <h3 class="fw-bold">0 Wh</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="zap"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="background-color: rgb(230, 244, 235)">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Impact</h4>
                                        <h3 class="fw-bold">0 kg <span class="badge bg-success">CO <sub>2</sub></span>
                                        </h3>
                                    </div>
                                    <svg width="40" height="40" viewBox="0 0 28 29" fill="#00913a"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.6066 3.06866L12.1307 0L9.73531 1.9883L6.66665 1.4641L8.65494 3.85954L8.13075 6.9282L10.5262 4.93991L13.5948 5.4641L11.6066 3.06866Z"
                                            fill="#00913a" style="fill: currentcolor;"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M26.5722 4.49507C26.2214 3.34085 24.9079 3.0589 24.0553 3.59484C22.8437 4.35653 21.4208 4.93276 20.0059 5.46584C19.7995 5.54362 19.5914 5.62104 19.3834 5.69846L19.382 5.699C18.217 6.13251 17.0525 6.56589 16.1764 7.0588C13.7537 8.42183 12.1361 9.9958 11.1457 11.6639C10.2459 10.931 9.03227 10.2687 7.74617 9.81958C5.87853 9.16739 3.60806 8.8767 1.62855 9.66853L1.13165 9.8673L1.0214 10.391C0.545665 12.6507 0.528051 16.0804 2.12276 18.9938C3.76784 21.9992 7.02349 24.2636 12.6666 24.2636C12.7158 24.2636 12.7642 24.2601 12.8116 24.2532L12.819 24.2637H13.3337C17.0418 24.2637 19.9119 23.4849 22.0813 22.1389C24.2583 20.7883 25.6611 18.9087 26.4967 16.8318C28.1477 12.7278 27.5924 7.8518 26.5722 4.49507ZM11.5039 22.2266C11.0662 21.4269 10.673 20.5429 10.3817 19.6018C9.93491 18.7942 8.97668 17.902 7.85809 17.1148C6.70589 16.304 5.56091 15.7269 5.01736 15.5457C4.49341 15.3711 4.21025 14.8047 4.3849 14.2808C4.55955 13.7569 5.12587 13.4737 5.64981 13.6483C6.43959 13.9116 7.76127 14.6011 9.00908 15.4792C9.29297 15.679 9.58264 15.8951 9.86829 16.1254C9.86989 16.0537 9.8723 15.9819 9.87553 15.91C9.91059 15.1297 10.0419 14.3491 10.2853 13.5785C9.67099 12.9513 8.50938 12.2045 7.0868 11.7078C5.65158 11.2066 4.14127 11.0272 2.87733 11.3592C2.57905 13.2879 2.70037 15.8836 3.87714 18.0335C5.02105 20.1233 7.24616 21.9471 11.5039 22.2266ZM12.5536 19.7591C12.4694 19.5421 12.3913 19.3219 12.3202 19.0988C12.3061 19.0149 12.2811 18.9316 12.2444 18.8509C11.9754 17.9306 11.83 16.9674 11.8735 15.9997C11.9805 13.6187 13.24 11.0056 17.157 8.80187C17.884 8.39285 18.8691 8.02538 20.045 7.58675C20.2607 7.50627 20.4829 7.42338 20.7111 7.33741C22.0172 6.8453 23.4682 6.26799 24.7805 5.49449C25.6461 8.58982 25.9925 12.7264 24.6412 16.0853C23.9447 17.8166 22.7997 19.3396 21.0269 20.4394C19.4152 21.4394 17.2287 22.1239 14.2829 22.2446C14.3156 22.1458 14.3333 22.0401 14.3333 21.9304C14.3333 19.0733 15.7201 16.6413 17.556 14.7215C19.395 12.7985 21.6112 11.4706 23.0606 10.8495C23.5682 10.6319 23.8033 10.0441 23.5858 9.53643C23.3682 9.0288 22.7804 8.79365 22.2727 9.01121C20.6109 9.72341 18.1605 11.1956 16.1106 13.3392C14.494 15.0297 13.0812 17.1881 12.5536 19.7591Z"
                                              fill="#00913a" style="fill: currentcolor;"></path>
                                        <path
                                            d="M3.99998 24.6667L4.56566 26.101L5.99998 26.6667L4.56566 27.2324L3.99998 28.6667L3.43429 27.2324L1.99998 26.6667L3.43429 26.101L3.99998 24.6667Z"
                                            fill="#00913a" style="fill: currentcolor;"></path>
                                        <path
                                            d="M24.8 24L25.4142 22.5858L24 23.2L22.5858 22.5858L23.2 24L22.5858 25.4142L24 24.8L25.4142 25.4142L24.8 24Z"
                                            fill="#00913a" style="fill: currentcolor;"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Peak Power</h4>
                                        <h3 class="fw-bold">0 W</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="sun"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Peak Power</h4>
                                        <h3 class="fw-bold">0 W</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="sun"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Peak Power</h4>
                                        <h3 class="fw-bold">0 W</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="sun"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
