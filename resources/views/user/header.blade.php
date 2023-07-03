         <!-- header section strats -->
      <div class="hero_area">

         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="about.html">About</a></li>
                              <li><a href="testimonial.html">Testimonial</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="blog_list.html">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('ShowCart')}}">Cart</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('Showorders')}}">Orders</a>
                        </li>
                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>

                        @if (Route::has('login'))
                        @auth

                      <li class="nav-item">
                           <a href="#" class="nav-link text-primary">{{ Auth::user()->name }} </a>
                      </li>

                      @else

                      <li class="nav-item">
                           <a href="{{ route('login') }}" class="nav-link text-primary">Login</a>
                      </li>

                        @if (Route::has('register'))

                      <li class="nav-item">
                           <a href="{{ route('register') }}" class="nav-link text-success">Register</a>
                      </li>

                      @endif
                      @endauth
                  
              @endif

                     </ul>
                  </div>
               </nav>
            </div>
         </header>
         <!-- end header section -->


                  <!-- slider section -->
                  <section class="slider_section ">
                     <div class="slider_bg_box">
                        <img src="images/slider-bg.jpg" alt="">
                     </div>
                     <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <div class="container ">
                                 <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                       <div class="detail-box">
                                          <h1>
                                             <span>
                                             Sale 20% Off
                                             </span>
                                             <br>
                                             On Everything
                                          </h1>
                                          <p>
                                             Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                                          </p>
                                          <div class="btn-box">
                                             <a href="" class="btn1">
                                             Shop Now
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item ">
                              <div class="container ">
                                 <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                       <div class="detail-box">
                                          <h1>
                                             <span>
                                             Sale 20% Off
                                             </span>
                                             <br>
                                             On Everything
                                          </h1>
                                          <p>
                                             Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                                          </p>
                                          <div class="btn-box">
                                             <a href="" class="btn1">
                                             Shop Now
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="container ">
                                 <div class="row">
                                    <div class="col-md-7 col-lg-6 ">
                                       <div class="detail-box">
                                          <h1>
                                             <span>
                                             Sale 20% Off
                                             </span>
                                             <br>
                                             On Everything
                                          </h1>
                                          <p>
                                             Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                                          </p>
                                          <div class="btn-box">
                                             <a href="" class="btn1">
                                             Shop Now
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="container">
                           <ol class="carousel-indicators">
                              <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                              <li data-target="#customCarousel1" data-slide-to="1"></li>
                              <li data-target="#customCarousel1" data-slide-to="2"></li>
                           </ol>
                        </div>
                     </div>
                  </section>
                  <!-- end slider section -->
      </div>
