@php
    use App\Models\RolePermission;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $role = $user->role;

    // Fetch the permissions for the current user's role
    $permission = RolePermission::where('role', $role)->first();

    // Ensure the permissions are decoded only if they are not already arrays
    $permissions = $permission && is_string($permission->permission) ? json_decode($permission->permission, true) : ($permission->permission ?? []);
    $sub_permissions = $permission && is_string($permission->sub_permissions) ? json_decode($permission->sub_permissions, true) : ($permission->sub_permissions ?? []);
//dd($sub_permissions);
    // Check for main permissions
    $hasUserManagementPermission = in_array('user-management', $permissions) || $user->role == 'Admin';
    $hasRoleManagementPermission = in_array('role-management', $permissions) || $user->role == 'Admin';
    $hasPoliceStationManagementPermission = in_array('police-station-management', $permissions) || $user->role == 'Admin';
    $hasPanchayatManagementPermission = in_array('panchayat-management', $permissions) || $user->role == 'Admin';
    $hasOrderManagementPermission = in_array('orders-management', $permissions) || $user->role == 'Admin';
    $hasCaseManagementPermission = in_array('case-management', $permissions) || $user->role == 'Admin';
    // Check for sub-permissions within user management
    $hasUserslistPermission = in_array('users-list', $sub_permissions) || $user->role == 'Admin';
    $hasRoleslistPermission = in_array('roles-list', $sub_permissions) || $user->role == 'Admin';
    $hasPermissionslistPermission = in_array('permissions-list', $sub_permissions) || $user->role == 'Admin';
    $hasAddPermissionPermission = in_array('add-permission', $sub_permissions) || $user->role == 'Admin';
    $hasEditPermissionPermission = in_array('edit-permission', $sub_permissions) || $user->role == 'Admin';
    $hasCaseListPermission = in_array('case-list', $sub_permissions) || $user->role == 'Admin';
    // $$hasAppealCasePermission = in_array('appeal', $sub_permissions) || $user->role == 'Admin';
    $hasAddCasePermission = in_array('add-case', $sub_permissions) || $user->role == 'Admin';
    $hasPoliceStationListPermission = in_array('police-station-list', $sub_permissions) || $user->role == 'Admin';
    $hasAddPoliceStationPermission = in_array('add-police-station', $sub_permissions) || $user->role == 'Admin';
    $hasEditPoliceStationPermission = in_array('edit-police-station', $sub_permissions) || $user->role == 'Admin';
    $hasDeletePoliceStationPermission = in_array('delete-police-station', $sub_permissions) || $user->role == 'Admin';
    $hasPanchayatListPermission = in_array('panchayat-list', $sub_permissions) || $user->role == 'Admin';
    $hasAddPanchayatPermission = in_array('add-panchayat', $sub_permissions) || $user->role == 'Admin';
    $hasEditPanchayatPermission = in_array('edit-panchayat', $sub_permissions) || $user->role == 'Admin';
    $hasDeletePanchayatPermission = in_array('delete-panchayat', $sub_permissions) || $user->role == 'Admin';
    $hasOrderListPermission = in_array('order-list', $sub_permissions) || $user->role == 'Admin';
    $hasAddOrderPermission = in_array('add-order', $sub_permissions) || $user->role == 'Admin';
    $hasEditOrderPermission = in_array('edit-order', $sub_permissions) || $user->role == 'Admin';
    $hasDeleteOrderPermission = in_array('delete-order', $sub_permissions) || $user->role == 'Admin';
    $hasPanchayatListPermission = in_array('panchayat-list', $sub_permissions) || $user->role == 'Admin';
    $hasAddPanchayatPermission = in_array('add-panchayat', $sub_permissions) || $user->role == 'Admin';
    $hasEditPanchayatPermission = in_array('edit-panchayat', $sub_permissions) || $user->role == 'Admin';
    $hasDeletePanchayatPermission = in_array('delete-panchayat', $sub_permissions) || $user->role == 'Admin';
    @endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Social Justice</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/echart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datatable-extension.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('admin/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/responsive.css')}}">

  </head>
  <body>
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader">
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"> </div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"> <a href="index.html"><img class="img-fluid for-light" src="{{ asset('admin/images/logo_dark.png')}}" alt="logo-light"><img class="img-fluid for-dark" src="{{ asset('admin/images/logo.png')}}" alt="logo-dark"></a></div>
            <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
              <div class="d-flex align-items-center gap-2 ">
                <h4 class="f-w-600">Welcome {{ \Auth::user()->name }}</h4><img class="mt-0" src="{{ asset('admin/images/hand.gif')}}" alt="hand-gif">
              </div>
            </div>
            {{-- <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Here’s what’s happening with your store today. </span></div> --}}
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <li class="d-md-block d-none">
                <div class="form search-form mb-0">
                  <div class="input-group"><span class="input-icon">
                      <svg>
                        <use href="svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <input class="w-100" type="search" placeholder="Search" hidden></span></div>
                </div>
              </li>
              <li class="d-md-none d-block">
                <div class="form search-form mb-0">
                  <div class="input-group"> <span class="input-show">
                      <svg id="searchIcon">
                        <use href="svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <div id="searchInput">
                        <input type="search" placeholder="Search">
                      </div></span></div>
                </div>
              </li>
              <li class="onhover-dropdown" hidden>
                <svg>
                  <use href="svg/icon-sprite.svg#star"></use>
                </svg>
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                          <li>
                            <div class="row">
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div><span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div><span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div><span>Tables</span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="text-center"><a class="flip-btn f-w-700" id="flip-btn" href="javascript:void(0)">Add New Bookmark</a></li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="search...">
                            </div>
                          </li>
                          <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li hidden>
                <div class="mode"><i class="moon" data-feather="moon"> </i></div>
              </li>
              <li class="onhover-dropdown notification-down" hidden>
                <div class="notification-box">
                  <svg>
                    <use href="svg/icon-sprite.svg#notification-header"></use>
                  </svg><span class="badge rounded-pill badge-secondary">4 </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                  <div class="card mb-0">
                    <div class="card-header">
                      <div class="common-space">
                        <h4 class="text-start f-w-600">Notitications</h4>
                        <div><span>4 New</span></div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="notitications-bar">
                        <ul class="nav nav-pills nav-primary p-0" id="pills-tab" role="tablist">
                          <li class="nav-item p-0"> <a class="nav-link active" id="pills-aboutus-tab" data-bs-toggle="pill" href="#pills-aboutus" role="tab" aria-controls="pills-aboutus" aria-selected="true">All(3)</a></li>
                          <li class="nav-item p-0"> <a class="nav-link" id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog" role="tab" aria-controls="pills-blog" aria-selected="false">
                               Messages</a></li>
                          <li class="nav-item p-0"> <a class="nav-link" id="pills-contactus-tab" data-bs-toggle="pill" href="#pills-contactus" role="tab" aria-controls="pills-contactus" aria-selected="false">
                               Cart  </a></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel" aria-labelledby="pills-aboutus-tab">
                            <div class="user-message">
                              <div class="cart-dropdown notification-all">
                                <ul>
                                  <li class="pr-0 pl-0 pb-3 pt-3">
                                    <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('admin/images/receiver-img.jpg')}}" alt="">
                                      <div class="media-body"><a class="f-light f-w-500" href="../template/product.html">Men Blue T-Shirt</a>
                                        <div class="qty-box">
                                          <div class="input-group"> <span class="input-group-prepend">
                                              <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">- </button></span>
                                            <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                              <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                          </div>
                                        </div>
                                        <h6 class="font-primary">$695.00</h6>
                                      </div>
                                      <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <ul>
                                <li>
                                  <div class="user-alerts"><img class="user-image rounded-circle img-fluid me-2" src="{{ asset('admin/images/5.jpg')}}" alt="user"/>
                                    <div class="user-name">
                                      <div>
                                        <h6><a class="f-w-500 f-14" href="../template/user-profile.html">Floyd Miles</a></h6><span class="f-light f-w-500 f-12">Sir, Can i remove part in des...</span>
                                      </div>
                                      <div>
                                        <svg>
                                          <use href="{{ asset('admin/svg/icon-sprite.svg')}}#more-vertical"></use>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="user-alerts"><img class="user-image rounded-circle img-fluid me-2" src="{{ asset('admin/images/6.jpg')}}" alt="user"/>
                                    <div class="user-name">
                                      <div>
                                        <h6><a class="f-w-500 f-14" href="../template/user-profile.html">Dianne Russell</a></h6><span class="f-light f-w-500 f-12">So, what is my next work ?</span>
                                      </div>
                                      <div>
                                        <svg>
                                          <use href="{{ asset('admin/svg/icon-sprite.svg')}}#more-vertical"></use>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
                            <div class="notification-card">
                              <ul>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="{{ asset('admin/images/3.jpg')}}" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="../template/private-chat.html">Robert D. Hambly</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Miss...😊</span></div>
                                    </div><span class="f-light f-w-500 f-12">44 sec</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="{{ asset('admin/images/7.jpg')}}" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="../template/private-chat.html">Courtney C. Strang</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Wishing You a Happy Birthday Dear.. 🥳🎊</span></div>
                                    </div><span class="f-light f-w-500 f-12">52 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="{{ asset('admin/images/5.jpg')}}" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="../template/private-chat.html">Raye T. Sipes</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Dear!! This Theme Is Very beautiful</span></div>
                                    </div><span class="f-light f-w-500 f-12">48 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="{{ asset('admin/images/6.jpg')}}" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="../template/private-chat.html">Henry S. Miller</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">You’re older today than yesterday, happy birthday!</span></div>
                                    </div><span class="f-light f-w-500 f-12">3 min</span>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-contactus" role="tabpanel" aria-labelledby="pills-contactus-tab">
                            <div class="cart-dropdown mt-4">
                              <ul>
                                <li class="pr-0 pl-0 pb-3">
                                  <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('admin/images/cart-img.jpg')}}" alt="">
                                    <div class="media-body"><a class="f-light f-w-500" href="../template/product.html">Furniture Chair for Home</a>
                                      <div class="qty-box">
                                        <div class="input-group"> <span class="input-group-prepend">
                                            <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                                          <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                            <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$500</h6>
                                    </div>
                                    <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                  </div>
                                </li>
                                <li class="pr-0 pl-0 pb-3 pt-3">
                                  <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('admin/images/receiver-img.jpg')}}" alt="">
                                    <div class="media-body"><a class="f-light f-w-500" href="../template/product.html">Men Cotton Blend Blue T-Shirt</a>
                                      <div class="qty-box">
                                        <div class="input-group"> <span class="input-group-prepend">
                                            <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">- </button></span>
                                          <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                            <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$695.00</h6>
                                    </div>
                                    <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                  </div>
                                </li>
                                <li class="mb-3 total"><a href="../template/checkout.html">
                                    <h6 class="mb-0">
                                       Order Total :<span class="f-right">$1195.00  </span></h6></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-footer pb-0 pr-0 pl-0">
                            <div class="text-center"> <a class="f-w-700" href="private-chat.html">
                                <button class="btn btn-primary" type="button" title="btn btn-primary">Check all</button></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown">
                <div class="media profile-media"><img class="b-r-10" src="{{ asset('admin/images/user.png')}}" alt="">
                  <div class="media-body d-xxl-block d-none box-col-none">
                    <div class="d-flex align-items-center gap-2"> <span>{{ Auth::user()->name }}</span><i class="middle fa fa-angle-down"> </i></div>
                    {{-- <p class="mb-0 font-roboto">Admin</p> --}}
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="{{url('profile')}}"><i data-feather="user"></i><span>My Profile</span></a></li>
                  {{-- <li><a href="letter-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li> <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a></li> --}}
                  <li><a class="btn btn-pill btn-outline-primary btn-sm"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{ Auth::user()->name }}</div>
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('admin/images/logo.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('admin/images/logo-icon.png')}}" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow disabled" id="left-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar" data-simplebar="init" style="display: block;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('admin/images/logo-icon.png')}}" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                  <div>
                    <h6>Pinned</h6>
                  </div>
                </li>
                <li class="sidebar-main-title">
                  {{-- <div>
                    <h6 class="lan-1">General</h6>
                  </div> --}}
                </li>
                <li class="sidebar-list "><i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title active" href="{{ url('/home') }}">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-home"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-home"></use>
                    </svg><span class="lan-3">Dashboard</span>
                    {{-- <div class="according-menu"><i class="fa fa-angle-right"></i></div> --}}
                    </a>
                  {{-- <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="index.html">Default</a></li>
                    <li><a href="dashboard-02.html">Ecommerce</a></li>
                    <li><a href="dashboard-03.html">Project</a></li>
                  </ul> --}}
                </li>
                {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-widget"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-widget"></use>
                    </svg><span class="lan-6">Widgets</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="general-widget.html">General</a></li>
                    <li><a href="chart-widget.html">Chart</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-layout"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-layout"></use>
                    </svg><span class="lan-7">Page layout</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="box-layout.html">Boxed</a></li>
                    <li><a href="layout-rtl.html">RTL</a></li>
                    <li><a href="layout-dark.html">Dark Layout</a></li>
                    <li> <a href="hide-on-scroll.html">Hide Nav Scroll</a></li>
                  </ul>
                </li> --}}
{{--

                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-project"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-project"></use>
                    </svg><span>Orders         </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="{{ url('/rdo-orders') }}">All Orders</a></li> --}}
                    {{-- <li><a href="{{ url('/cases') }}">Case List</a></li> --}}
                  {{-- </ul>
                </li> --}}

                {{-- @else --}}


                {{-- @dd($hasUserManagementPermission); --}}

            @if($hasUserManagementPermission)
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">User Management</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-project"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-project"></use>
                    </svg><span>User Management           </span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="sidebar-submenu" style="display: none;">

                    @if ($hasUserslistPermission)
                        <li><a href="{{ url('/users') }}">Users</a></li>
                    @endif
                    @if($hasRoleManagementPermission)
                        <li><a href="{{ url('/roles') }}">Roles</a></li>
                    @endif
                  </ul>
                </li>
            @endif
            @if($hasCaseManagementPermission)
            {{-- @unless(Auth::user()->role == 'Admin') --}}
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                        <use href="svg/icon-sprite.svg#stroke-project"></use>
                    </svg>
                    <svg class="fill-icon">
                        <use href="svg/icon-sprite.svg#fill-project"></use>
                    </svg>

                    <span>Case</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="sidebar-submenu" style="display: none;">
                        @if ($hasAddCasePermission)<li><a href="{{ url('/case-register') }}">Register Case</a></li>@endif
                        @if ($hasCaseListPermission && !(Auth::user()->role =='RDO'))<li><a href="{{ url('/cases') }}">Case List</a></li>@endif
                        @if(Auth::user()->role =='RDO' && $hasCaseListPermission)<li><a href="{{ url('/rdo-cases') }}">All Cases</a></li>@endif
                    </ul>

              </li>
              {{-- @endunless --}}
                @endif
                @if($hasPoliceStationManagementPermission)
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{ url('/policestation') }}">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Police Station</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                </li>
@endif
@if($hasPanchayatManagementPermission)
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{ url('/panchayat') }}">
                        <svg class="stroke-icon">
                          <use href="svg/icon-sprite.svg#stroke-file"></use>
                        </svg>
                        <svg class="fill-icon">
                          <use href="svg/icon-sprite.svg#fill-file"></use>
                        </svg><span>Panchayat</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    </li>
@endif



{{-- @if($hasOrderManagementPermission)
<li class="sidebar-main-title">
    <div>
      <h6 class="lan-8">Orders</h6>
    </div>
  </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{ url('/orders') }}">
                        <svg class="stroke-icon">
                          <use href="svg/icon-sprite.svg#stroke-file"></use>
                        </svg>
                        <svg class="fill-icon">
                          <use href="svg/icon-sprite.svg#fill-file"></use>
                        </svg><span>Orders</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        <ul class="sidebar-submenu" style="display: none;">
                            <li><a href="{{ url('/rdo-orders') }}">All Orders</a></li>
                        </ul>
                    </li>

@endif --}}


@if($hasOrderManagementPermission)
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">Orders</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-project"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-project"></use>
                    </svg><span>Orders</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                    <ul class="sidebar-submenu" style="display: none;">

                    {{-- @if ($hasUserslistPermission) --}}
                    <li><a href="{{ url('/rdo-orders') }}">All Orders</a></li>
                    {{-- @endif
                    @if($hasRoleManagementPermission) --}}
                        <li><a class="sidebar-link sidebar-title link-nav" href="{{ url('/orders') }}">Orders</a></li>
                    {{-- @endif --}}
                  </ul>
                </li>
            @endif





                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="calendar-basic.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-calendar"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-calender"></use>
                    </svg><span>Calendar</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="social-app.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-social"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-social"> </use>
                    </svg><span>Social App</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="to-do.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-to-do"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-to-do"> </use>
                    </svg><span>To-Do</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="search.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-search"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-search"> </use>
                    </svg><span>Search Result</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-main-title" hidden>
                  <div>
                    <h6>Forms &amp; Table</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-form"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-form"> </use>
                    </svg><span>Forms</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li> <a class="submenu-title" href="#">Form Controls <span class="sub-arrow"> <i class="fa fa-angle-right"></i></span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                      <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="base-input.html">Base Inputs</a></li>
                        <li><a href="radio-checkbox-control.html">Checkbox &amp; Radio</a></li>
                        <li><a href="input-group.html">Input Groups</a></li>
                        <li> <a href="input-mask.html">Input Mask</a></li>
                        <li><a href="megaoptions.html">Mega Options</a></li>
                      </ul>
                    </li>
                    <li><a class="submenu-title" href="#">
                         Form Widgets<span class="sub-arrow"><i class="fa fa-angle-right"></i></span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                      <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                        <li><a href="datepicker.html">Datepicker</a></li>
                        <li><a href="touchspin.html">Touchspin</a></li>
                        <li><a href="select2.html">Select2</a></li>
                        <li><a href="switch.html">Switch</a></li>
                        <li><a href="typeahead.html">Typeahead</a></li>
                        <li><a href="clipboard.html">Clipboard</a></li>
                      </ul>
                    </li>
                    <li><a class="submenu-title" href="#">Form layout<span class="sub-arrow"><i class="fa fa-angle-right"></i></span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                      <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                        <li><a href="form-wizard.html">Form Wizard 1</a></li>
                        <li><a href="form-wizard-two.html">Form Wizard 2</a></li>
                        <li><a href="two-factor.html">Two Factor</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title active" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-table"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-table"></use>
                    </svg><span>Tables</span><div class="according-menu"><i class="fa fa-angle-down"></i></div></a>
                  <ul class="sidebar-submenu" style="display: block;">
                    <li><a class="submenu-title" href="#">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                      <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                        <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                        <li><a href="table-components.html">Table components</a></li>
                      </ul>
                    </li>
                    <li><a class="submenu-title" href="#">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                      <ul class="nav-sub-childmenu submenu-content" style="display: none;">
                        <li><a href="datatable-basic-init.html">Basic Init</a></li>
                        <li> <a href="datatable-advance.html">Advance Init </a></li>
                        <li> <a href="datatable-API.html">API </a></li>
                        <li><a href="datatable-data-source.html">Data Sources</a></li>
                      </ul>
                    </li>
                    <li><a href="datatable-ext-autofill.html" class="active">Ex. Data Tables</a></li>
                    <li><a href="jsgrid-table.html">Js Grid Table        </a></li>
                  </ul>
                </li>
                <li class="sidebar-main-title" hidden>
                  <div>
                    <h6>Components</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-ui-kits"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-ui-kits"></use>
                    </svg><span>Ui Kits</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="typography.html">Typography</a></li>
                    <li><a href="avatars.html">Avatars</a></li>
                    <li><a href="helper-classes.html">helper classes</a></li>
                    <li><a href="grid.html">Grid</a></li>
                    <li><a href="tag-pills.html">Tag &amp; pills</a></li>
                    <li><a href="progress-bar.html">Progress</a></li>
                    <li><a href="modal.html">Modal</a></li>
                    <li><a href="alert.html">Alert</a></li>
                    <li><a href="popover.html">Popover</a></li>
                    <li><a href="tooltip.html">Tooltip</a></li>
                    <li><a href="dropdown.html">Dropdown</a></li>
                    <li><a href="according.html">Accordion</a></li>
                    <li><a href="tab-bootstrap.html">Tabs</a></li>
                    <li><a href="list.html">Lists</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-bonus-kit"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-bonus-kit"></use>
                    </svg><span>Bonus Ui</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="scrollable.html">Scrollable</a></li>
                    <li><a href="tree.html">Tree view</a></li>
                    <li><a href="toasts.html">Toasts</a></li>
                    <li><a href="rating.html">Rating</a></li>
                    <li><a href="dropzone.html">dropzone</a></li>
                    <li><a href="tour.html">Tour</a></li>
                    <li><a href="sweet-alert2.html">SweetAlert2</a></li>
                    <li><a href="modal-animated.html">Animated Modal</a></li>
                    <li><a href="owl-carousel.html">Owl Carousel</a></li>
                    <li><a href="ribbons.html">Ribbons</a></li>
                    <li><a href="pagination.html">Pagination</a></li>
                    <li><a href="breadcrumb.html">Breadcrumb</a></li>
                    <li><a href="range-slider.html">Range Slider</a></li>
                    <li><a href="image-cropper.html">Image cropper</a></li>
                    <li><a href="basic-card.html">Basic Card</a></li>
                    <li><a href="creative-card.html">Creative Card</a></li>
                    <li><a href="dragable-card.html">Draggable Card</a></li>
                    <li><a href="timeline-v-1.html">Timeline </a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-animation"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-animation"></use>
                    </svg><span>Animation</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="animate.html">Animate</a></li>
                    <li><a href="scroll-reval.html">Scroll Reveal</a></li>
                    <li><a href="AOS.html">AOS animation</a></li>
                    <li><a href="tilt.html">Tilt Animation</a></li>
                    <li><a href="wow.html">Wow Animation</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-icons"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-icons"></use>
                    </svg><span>Icons</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="flag-icon.html">Flag icon</a></li>
                    <li><a href="font-awesome.html">Fontawesome Icon</a></li>
                    <li><a href="ico-icon.html">Ico Icon</a></li>
                    <li><a href="themify-icon.html">Themify Icon</a></li>
                    <li><a href="feather-icon.html">Feather icon</a></li>
                    <li><a href="whether-icon.html">Whether Icon</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-button"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-botton"></use>
                    </svg><span>Buttons</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="buttons.html">Default Style</a></li>
                    <li><a href="buttons-flat.html">Flat Style</a></li>
                    <li><a href="buttons-edge.html">Edge Style</a></li>
                    <li><a href="raised-button.html">Raised Style</a></li>
                    <li><a href="button-group.html">Button Group</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-charts"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-charts"></use>
                    </svg><span>Charts</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="echarts.html">Echarts</a></li>
                    <li><a href="chart-apex.html">Apex Chart</a></li>
                    <li><a href="chart-google.html">Google Chart</a></li>
                    <li><a href="chart-sparkline.html">Sparkline chart</a></li>
                    <li><a href="chart-flot.html">Flot Chart</a></li>
                    <li><a href="chart-knob.html">Knob Chart</a></li>
                    <li><a href="chart-morris.html">Morris Chart</a></li>
                    <li><a href="chartjs.html">Chatjs Chart</a></li>
                    <li><a href="chartist.html">Chartist Chart</a></li>
                    <li><a href="chart-peity.html">Peity Chart</a></li>
                  </ul>
                </li>
                <li class="sidebar-main-title" hidden>
                  <div>
                    <h6>Pages</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="landing-page.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-landing-page"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-landing-page"></use>
                    </svg><span>Landing page</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="sample-page.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-sample-page"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-sample-page"></use>
                    </svg><span>Sample page</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="internationalization.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-internationalization"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-internationalization"></use>
                    </svg><span>Internationalization</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="../starter-kit/index.html" target="_blank" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-starter-kit"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-starter-kit"></use>
                    </svg><span>Starter kit</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="mega-menu sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-others"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-others"></use>
                    </svg><span>Others</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <div class="mega-menu-container menu-content" style="display: none;">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col mega-box">
                          <div class="link-section">
                            <div class="submenu-title">
                              <h5>Error Page</h5>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div></div>
                            <ul class="submenu-content opensubmegamenu" style="display: none;">
                              <li><a href="error-400.html">Error 400</a></li>
                              <li><a href="error-401.html">Error 401</a></li>
                              <li><a href="error-403.html">Error 403</a></li>
                              <li><a href="error-404.html">Error 404</a></li>
                              <li><a href="error-500.html">Error 500</a></li>
                              <li><a href="error-503.html">Error 503</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col mega-box">
                          <div class="link-section">
                            <div class="submenu-title">
                              <h5> Authentication</h5>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div></div>
                            <ul class="submenu-content opensubmegamenu" style="display: none;">
                              <li><a href="login.html" target="_blank">Login Simple</a></li>
                              <li><a href="login_one.html" target="_blank">Login bg image</a></li>
                              <li><a href="login_two.html" target="_blank">Login image two                      </a></li>
                              <li><a href="login-bs-validation.html" target="_blank">Login validation</a></li>
                              <li><a href="login-bs-tt-validation.html" target="_blank">Login tooltip</a></li>
                              <li><a href="login-sa-validation.html" target="_blank">Login sweetalert</a></li>
                              <li><a href="sign-up.html" target="_blank">Register Simple</a></li>
                              <li><a href="sign-up-one.html" target="_blank">Register Bg-Image</a></li>
                              <li><a href="sign-up-two.html" target="_blank">Register two-image </a></li>
                              <li><a href="sign-up-wizard.html" target="_blank">Register wizard</a></li>
                              <li><a href="unlock.html">Unlock User</a></li>
                              <li><a href="forget-password.html">Forget Password</a></li>
                              <li><a href="reset-password.html">Reset Password</a></li>
                              <li><a href="maintenance.html">Maintenance</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col mega-box">
                          <div class="link-section">
                            <div class="submenu-title">
                              <h5>Coming Soon</h5>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div></div>
                            <ul class="submenu-content opensubmegamenu" style="display: none;">
                              <li><a href="comingsoon.html">Coming Simple</a></li>
                              <li><a href="comingsoon-bg-video.html">Coming with Bg video</a></li>
                              <li><a href="comingsoon-bg-img.html">Coming with Bg Image</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col mega-box">
                          <div class="link-section">
                            <div class="submenu-title">
                              <h5>Email templates</h5>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div></div>
                            <ul class="submenu-content opensubmegamenu" style="display: none;">
                              <li><a href="basic-template.html">Basic Email</a></li>
                              <li><a href="email-header.html">Basic With Header</a></li>
                              <li><a href="template-email.html">Ecomerce Tem...</a></li>
                              <li><a href="template-email-2.html">Email Template 2</a></li>
                              <li><a href="ecommerce-templates.html">Ecommerce Email</a></li>
                              <li><a href="email-order-success.html">Order Success</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="sidebar-main-title" hidden>
                  <div>
                    <h6>Miscellaneous</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-gallery"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-gallery"></use>
                    </svg><span>Gallery</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="gallery.html">Gallery Grid</a></li>
                    <li><a href="gallery-with-description.html">Gallery Grid Desc</a></li>
                    <li><a href="gallery-masonry.html">Masonry Gallery</a></li>
                    <li><a href="masonry-gallery-with-disc.html">Masonry with Desc</a></li>
                    <li><a href="gallery-hover.html">Hover Effects</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-blog"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-blog"></use>
                    </svg><span>Blog</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="blog.html">Blog Details</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                    <li><a href="add-post.html">Add Post</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="faq.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-faq"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-faq"></use>
                    </svg><span>FAQ</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-job-search"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-job-search"></use>
                    </svg><span>Job Search</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="job-cards-view.html">Cards view</a></li>
                    <li><a href="job-list-view.html">List View</a></li>
                    <li><a href="job-details.html">Job Details</a></li>
                    <li><a href="job-apply.html">Apply</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-learning"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-learning"></use>
                    </svg><span>Learning</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="learning-list-view.html">Learning List</a></li>
                    <li><a href="learning-detailed.html">Detailed Course</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-maps"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-maps"></use>
                    </svg><span>Maps</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="map-js.html">Maps JS</a></li>
                    <li><a href="vector-map.html">Vector Maps</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-editors"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-editors"></use>
                    </svg><span>Editors</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                  <ul class="sidebar-submenu" style="display: none;">
                    <li><a href="quilleditor.html">Quill editor</a></li>
                    <li><a href="ace-code-editor.html">ACE code editor  </a></li>
                  </ul>
                </li>
                <li class="sidebar-list"> <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="knowledgebase.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-knowledgebase"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-knowledgebase"></use>
                    </svg><span>Knowledgebase</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html" hidden>
                    <svg class="stroke-icon">
                      <use href="svg/icon-sprite.svg#stroke-support-tickets"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="svg/icon-sprite.svg#fill-support-tickets"></use>
                    </svg><span>Support Ticket</span><div class="according-menu"><i class="fa fa-angle-right"></i></div></a></li>


              </div>
            </div>
          </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 2208px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 258px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>
              <div class="right-arrow" id="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></div>
            </div>
          </nav>
        </div>

        @yield('content')


          <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2024 ©   </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admin/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('admin/js/simplebar.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/custom.js') }}"></script> --}}
    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('admin/js/slick.min.js') }}"></script>
    <script src="{{ asset('admin/js/slick.js') }}"></script>
    <script src="{{ asset('admin/js/header-slick.js') }}"></script>


    <script src="{{ asset('admin/js/facePrint.js') }}"></script>
    <script src="{{ asset('admin/js/testHelper.js') }}"></script>
    <script src="{{ asset('admin/js/custom-transition-texture.js') }}"></script>
    <script src="{{ asset('admin/js/symbols.js') }}"></script>
    <!-- calendar js-->
    <script src="{{ asset('admin/js/datepicker.js') }}"></script>
    <script src="{{ asset('admin/js/datepicker.en.js') }}"></script>
    <script src="{{ asset('admin/js/datepicker.custom.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard_3.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('admin/js/customizer.js') }}"></script>

    <!-- calendar js-->

    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.rowReorder.min.js') }}"></script>

    <script src="{{ asset('admin/js/tooltip-init.js') }}"></script>
      <script >



      $(document).ready(function () {
       // alert("kk");

            $("#keytable").DataTable();

      });

      $(".close").click(function(){
        $(".alert").hide();
      })
    </script>
    <!-- Plugins JS Ends-->


  </body>
</html>
