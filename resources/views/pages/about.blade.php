@extends('layouts.app')

@section('title', 'Biz haqimizda')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-title">Biz haqimizda</h1>

        <div class="card shadow-sm">
          <div class="card-body p-5">
            <p class="lead">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>

            <hr class="my-4">

            <h3>Bizning maqsadimiz</h3>
            <p>
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
              reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>

            <h3 class="mt-4">Jamoamiz</h3>
            <div class="row mt-4">
              <div class="col-md-4 mb-4">
                <div class="text-center">
                  <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                  </div>
                  <h5>Alisher Valiyev</h5>
                  <p class="text-muted">CEO</p>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="text-center">
                  <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                  </div>
                  <h5>Nodira Karimova</h5>
                  <p class="text-muted">CTO</p>
                </div>
              </div>

              <div class="col-md-4 mb-4">
                <div class="text-center">
                  <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                  </div>
                  <h5>Jamshid Rashidov</h5>
                  <p class="text-muted">Lead Developer</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
