<x-app-layout>
  <x-nav-bar/>

  <!-- Hero Section -->
  <section class="about-hero">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <span class="badge bg-light text-primary mb-3">
                      ABOUT OUR COMPANY
                  </span>

                  <h1 class="display-4 fw-bold">
                      Membuat Furnitur
                      <span class="text-warning">Berkualitas</span>
                      untuk Anda
                  </h1>

                  <p class="lead mt-4">
                      Setiap rumah layak dengan furnitur
                      premium, nyaman, dan terjangkau
                  </p>

                  {{-- <a href="{{ url('/products') }}"
                    class="btn btn-light btn-lg mt-3">
                      Explore Products
                  </a> --}}
              </div>

              <div class="col-lg-6 text-center mt-5 mt-lg-0">
                  <img
                      src="{{ asset('images/woodcraft.jpg') }}"
                      class="img-fluid rounded-4 shadow"
                      alt="Online shopping">
              </div>
          </div>
      </div>
  </section>

  <!-- Introduction -->
  <section class="py-5">
      <div class="container">
          <div class="row align-items-center g-5">

              <div class="col-lg-6">
                  <img
                      src="{{asset('images/woodcraft2.jpg')}}"
                      class="img-fluid rounded-4"
                      alt="Our store">
              </div>

              <div class="col-lg-6">
                  <h6 class="text-primary fw-bold">
                      WHO WE ARE
                  </h6>

                  <h2 class="fw-bold mb-4">
                      Your Trusted Online Shopping Partner
                  </h2>

                  <p class="text-secondary">
                      We are an online shopping platform dedicated
                      to providing customers with a convenient
                      and reliable shopping experience.
                  </p>

                  <p class="text-secondary">
                      From discovering new products to completing
                      your purchase, we aim to make every step
                      simple and enjoyable.
                  </p>

                  <p class="text-secondary">
                      Customer satisfaction, product quality,
                      and trust are at the heart of everything
                      we do.
                  </p>
              </div>

          </div>
      </div>
  </section>

  <!-- Mission and Vision -->
  <section class="bg-light py-5">
      <div class="container">

          <div class="text-center mb-5">
              <h6 class="text-primary fw-bold">
                  OUR PURPOSE
              </h6>

              <h2 class="fw-bold">Mission & Vision</h2>

              <p class="text-secondary">
                  What inspires us to keep moving forward.
              </p>
          </div>

          <div class="row g-4">

              <div class="col-md-6">
                  <div class="card border-0 shadow-sm h-100 p-4">
                      <div class="card-body">
                          <div class="about-icon mb-3">
                              <i class="bi bi-bullseye"></i>
                          </div>

                          <h4 class="fw-bold">Our Mission</h4>

                          <p class="text-secondary">
                              To provide accessible, quality products
                              and deliver an easy, secure, and
                              satisfying shopping experience
                              for every customer.
                          </p>
                      </div>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="card border-0 shadow-sm h-100 p-4">
                      <div class="card-body">
                          <div class="about-icon mb-3">
                              <i class="bi bi-eye"></i>
                          </div>

                          <h4 class="fw-bold">Our Vision</h4>

                          <p class="text-secondary">
                              To become a trusted online shopping
                              destination that connects people
                              with the products they need
                              through innovation and reliability.
                          </p>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <!-- Our Values -->
  <section class="py-5">
      <div class="container">

          <div class="text-center mb-5">
              <h6 class="text-primary fw-bold">
                  WHAT WE BELIEVE IN
              </h6>

              <h2 class="fw-bold">Our Core Values</h2>
          </div>

          <div class="row g-4 text-center">

              <div class="col-md-4">
                  <div class="value-card p-4">
                      <i class="bi bi-shield-check"></i>
                      <h5 class="fw-bold mt-3">Trust</h5>
                      <p class="text-secondary">
                          Building lasting relationships through
                          honesty and transparency.
                      </p>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="value-card p-4">
                      <i class="bi bi-star"></i>
                      <h5 class="fw-bold mt-3">Quality</h5>
                      <p class="text-secondary">
                          Delivering products and services
                          that meet customer expectations.
                      </p>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="value-card p-4">
                      <i class="bi bi-heart"></i>
                      <h5 class="fw-bold mt-3">Customer First</h5>
                      <p class="text-secondary">
                          Putting customer needs and satisfaction
                          at the center of our decisions.
                      </p>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <!-- Call to Action -->
  <section class="about-cta py-5">
      <div class="container text-center">
          <h2 class="fw-bold">
              Ready to Start Shopping?
          </h2>

          <p class="mt-3">
              Discover products you'll love and enjoy
              a better shopping experience with us.
          </p>

          <a href="{{ url('/products') }}"
            class="btn btn-light btn-lg mt-3">
              Shop Now
          </a>
      </div>
  </section>

</x-app-layout>