<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
  </head>

  <body>
    <div class="main-wrapper">
      <!-- navbar -->
      @include("layouts.navbar")
      <!-- end navbar -->

      <!-- Sidebar -->
      @include("layouts.sidebar")
      <!-- End Sidebar -->

      <!-- main content -->
      <div class="page-wrapper">
        <div class="content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-body">
                  @yield('container')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <!-- end main content -->

      {{-- footetr --}}
      @include("layouts.footer")
      {{-- endfooter --}}
