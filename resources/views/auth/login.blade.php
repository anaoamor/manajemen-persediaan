<x-app-layout>
    <x-nav-bar-login>
    </x-nav-bar-login>
    <div class="wrapper">
      <div class="container pt-5">
        <div class="row">
          <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
            <div class="card">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="post" autocomplete="off" action="/login">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="">
                    @error('email')
                      <small class="text-danger pesan-error">{{ $message }}</small>                      
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                      <small class="text-danger pesan-error">{{$message}}</small>  
                    @enderror
                  </div>

                  <div class="d-grid">
                    <input type="submit" class="btn btn-info text-white" value="Login">
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>