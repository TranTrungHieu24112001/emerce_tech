@extends('welcome')
<style>
    .bgimg1{
        display: none;
    }
    .bgimg2{
        display: none;
    }
    #slider{
        display:none;
    }
    .left, .right{
        display :none;
    }
</style>
@section('contact')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">    		
                <div class="col-sm-12"  style="margin-bottom:30px"  >    			   			
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
                    <div id="gmap" class="contact-map">
                        <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.908239986101!2d105.80624561531305!3d20.956199795626418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad1854d9d1a1%3A0x5bbf45764060cbc9!2sHanoicnc!5e0!3m2!1svi!2s!4v1660795546507!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>			 		
            </div>    	
            <div class="row">  	
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form role="form" method="post" action="{{url('/add-contact')}}">
                            {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <input type="text" name="contact_name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="contact_email" class="form-control" required="required" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="contact_phone" class="form-control" required="required" placeholder="phone">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="contact_message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Contact Info</h2>
                        <address>
                            <p>TTH STORE</p>
                            <p>19, ngõ 39, Hồ Tùng Mậu, Mai Dịch</p>
                            <p>Cầu Giấy, Hà Nội</p>
                            <p>Mobile: 0382524296</p>
                            <p>Fax: 1-714-252-0026</p>
                            <p>Email: nhom4@gmail.com</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    			
            </div>  
        </div>	
    </div><!--/#contact-page-->
@endsection