    <section class="single-post-content">
         <div class="container">
            <div class="row">
                 <div class="col-md-12" data-aos="fade-up">
                   <x-forntend.pages.fullwidthpage :page="$page" />
                </div>
                <div class="col-md-12 content-left" data-aos="fade-up">
                    
                     <div class="card">
                         <div class="card-body">
    
                             @if (Session::has('success'))
                                 <div class="alert alert-success">
                                     {{ Session::get('success') }}
                                     @php
                                         Session::forget('success');
                                     @endphp
                                 </div>
                             @endif
    
                             <form method="POST" action="{{ route('contact-form.store') }}">
    
                                 {{ csrf_field() }}
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>Name:</strong>
                                             <input type="text" name="name" class="form-control" placeholder="Name"
                                                 value="{{ old('name') }}">
                                             @if ($errors->has('name'))
                                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>Email:</strong>
                                             <input type="text" name="email" class="form-control" placeholder="Email"
                                                 value="{{ old('email') }}">
                                             @if ($errors->has('email'))
                                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>Phone:</strong>
                                             <input type="text" name="phone" class="form-control" placeholder="Phone"
                                                 value="{{ old('phone') }}">
                                             @if ($errors->has('phone'))
                                                 <span class="text-danger">{{ $errors->first('phone') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>Subject:</strong>
                                             <input type="text" name="subject" class="form-control" placeholder="Subject"
                                                 value="{{ old('subject') }}">
                                             @if ($errors->has('subject'))
                                                 <span class="text-danger">{{ $errors->first('subject') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <strong>Message:</strong>
                                             <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                                             @if ($errors->has('message'))
                                                 <span class="text-danger">{{ $errors->first('message') }}</span>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif

                                 <p style="text-align:center">
                                 {!! NoCaptcha::renderJs() !!}
                                 {!! NoCaptcha::display() !!}
                                 </p>
                                 

                                   <div class="row">
                                     <div class="col-md-12 my-2">
                                         <div class="form-group text-center">
                                          <button class="btn btn-outline-success btn-submit" style="width:90%; font-size:2rem;">Send</button>
                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                    
                </div>
              
             </div>
        </div>
    </section>