@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
<section style="background-color: #CDC4F9;">
    <div class="">
  
      <div class="row">
        <div class="col-md-12">
  
          <div class="card" id="chat3" style="border-radius: 15px;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
  
                 @include('admin.blocks.user-sidebar')
  
                </div>
  
                <div class="col-md-6 col-lg-7 col-xl-8">
                  
                  <div class="pt-3 pe-3" data-mdb-perfect-scrollbar="true"
                    style="position: relative; height: 400px">
  
                    <div class="d-flex flex-row justify-content-start">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                      <div>
                        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">Lorem ipsum
                          dolor
                          sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                          dolore
                          magna aliqua.</p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row justify-content-end">
                      <div>
                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Ut enim ad minim veniam,
                          quis
                          nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                      </div>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                    </div>
  
                    <div class="d-flex flex-row justify-content-start">
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                        alt="avatar 1" style="width: 45px; height: 100%;">
                      <div>
                        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">Duis aute
                          irure
                          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row justify-content-end">
                      <div>
                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">Excepteur sint occaecat
                          cupidatat
                          non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
                      </div>
                      
                    </div>
                </div>
                <form class="bg-white mb-3" >
                    <div data-mdb-input-init class="form-outline">
                      <textarea class="form-control" id="sentMessage" rows="4"></textarea>
                    </div>
                  </li>
                  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded ">Send</button>
                </div>
              </div>
  
            </div>
          </div>
  
        </div>
      </div>
  
    </div>
  </section>
@endsection

@section('scripts')

<script type="module">

</script>

@endsection
