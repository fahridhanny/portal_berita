@extends('index')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">@if (app()->getLocale() == 'id')
                    Kontak
                @else
                    Contact
                @endif</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="contact-form">
                        <form action="/{{ app()->getLocale() }}/contact" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="nama" class="form-control @if($errors->has('nama')) is-invalid @endif" placeholder="@if(app()->getLocale() == 'id')Nama Kalian @else Your Name @endif" />
                                    @error('nama')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control  @if($errors->has('email')) is-invalid @endif" placeholder="@if(app()->getLocale() == 'id')Email Kalian @else Your Email @endif" />
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control  @if($errors->has('subject')) is-invalid @endif" placeholder="@if(app()->getLocale() == 'id')Subjek Kalian @else Your Subjek @endif" />
                                @error('subject')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control  @if($errors->has('message')) is-invalid @endif" name="message" rows="5" placeholder="@if(app()->getLocale() == 'id')Pesan @else Message @endif"></textarea>
                                @error('message')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div style="transform:scale(0.77); transform-origin:0 0;" class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="6Lf12zUgAAAAAOvSObmp4FxpeE-rXrboaNIIUmzB"></div>
                                @error ('g-recaptcha-response')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <div><button class="btn" type="submit">@if (app()->getLocale() == 'id')
                                Kirim Pesan
                            @else
                                Send Message
                            @endif</button></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                        <h4><i class="fa fa-map-marker"></i>123 News Street, NY, USA</h4>
                        <h4><i class="fa fa-envelope"></i>info@example.com</h4>
                        <h4><i class="fa fa-phone"></i>+123-456-7890</h4>
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection