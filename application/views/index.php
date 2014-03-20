<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>

<!-- Basic Page Needs
  ================================================== -->
<meta charset="utf-8">
<title>PhysioHealth - Now every moment is healthy!</title>
<meta name="description" content="">
<meta name="author" content="">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('.active-links, .lets-get').click(function () {
        if ($('#signup-dropdown').is(":visible")) {
            $('#signup-dropdown').hide()
			$('#session').removeClass('active');
        } else {
            $('#login-dropdown').hide();
			$('#session1').removeClass('active');
		    $('#signup-dropdown').show();
			$('#session').addClass('active');
        }
		return false;
    });
	$('#signup-dropdown').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#signup-dropdown').hide();
		$('#session').removeClass('active');
    });


$('.active-links1').click(function () {
        if ($('#login-dropdown').is(":visible")) {
            $('#login-dropdown').hide()
			$('#session1').removeClass('active');
        } else {
			  $('#signup-dropdown').hide();
			$('#session').removeClass('active');
            $('#login-dropdown').show()
			$('#session1').addClass('active');
        }
		return false;
    });
	$('#login-dropdown').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#login-dropdown').hide();
		$('#session1').removeClass('active');
    });
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	$('#signup').click(function(){		
		if($('#susername').val()=="" || !filter.test($('#susername').val())){
			$('#susername').css('border-color','#ff0000');
			return false;
		}else{
			$('#susername').css('border-color','#3D4C5E');
		}
		if($('#spassword').val()==""){
			$('#spassword').css('border-color','#ff0000');
			return false;
		}else{
			$('#spassword').css('border-color','#3D4C5E');
		}
	
		if($('#cond').prop('checked')==false){
			$('#cond').next().css('color','#ff0000');
			return false;
		}else{
			$('#cond').next().css('color','#ffffff');
		}
$.post('index.php/home/ajax',{username:$('#susername').val(),password:$('#spassword').val(),registration:"reg"},function(data){
				$('#signup-dropdown').hide()
				$('#session').removeClass('active');
				if(data=="success"){
					alert("Please Check Your Verified Email Inbox");
				}else{
					alert("Email Already Exist");
				}
		});
		

	});
	$('#login').click(function(){
		if($('#lusername').val()=="" || !filter.test($('#lusername').val())){
			$('#lusername').css('border-color','#ff0000');
			return false;
		}else{
			$('#lusername').css('border-color','#3D4C5E');
		}
		if($('#lpassword').val()==""){
			$('#lpassword').css('border-color','#ff0000');
			return false;
		}else{
			$('#lpassword').css('border-color','#3D4C5E');
		}
		$.post('index.php/home/ajax',{username:$('#lusername').val(),password:$('#lpassword').val(),login:"log"},function(data){
			$('#login-dropdown').hide();
			$('#session1').removeClass('active');
			alert('Login Success');
			});
	});

});     
</script>
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
  ================================================== -->
<link rel="stylesheet" href="<?=$this->config->base_url();?>stylesheets/base.css">
<link rel="stylesheet" href="<?=$this->config->base_url();?>stylesheets/skeleton.css">
<link rel="stylesheet" href="<?=$this->config->base_url();?>stylesheets/layout.css">

<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<!-- Favicons
	================================================== -->
<link rel="shortcut icon" href="<?=$this->config->base_url();?>images/favicon.ico">
<link rel="apple-touch-icon" href="<?=$this->config->base_url();?>images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=$this->config->base_url();?>images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=$this->config->base_url();?>images/apple-touch-icon-114x114.png">
</head>
<body>
<!-- HEADER
  ================================================== -->
<div class="page-top">
  <div class="container">
    <div class="eleven columns"><div class="logo"><img src="<?=$this->config->base_url();?>images/logo.png"></div></div>
    <div class="five columns">
      <div class="active-links">
            <div id="session">
            <a id="signup-link" href="#">
            Sign up
            </a>
            </div>
            	<div id="signup-dropdown">
        		<form method="post" class="signup" action="#">
                <fieldset class="textbox">
            	<label class="username">
                <span>Email Address</span>
                <input id="susername" name="susername" value="" type="text" autocomplete="on">
                </label>
                
                <label class="password">
                <span>Password</span>
                <input id="spassword" name="spassword" value="" type="password">
                </label>
                </fieldset>
                
                <fieldset class="remb">
                <label class="remember">
                <input type="checkbox" value="1" name="remember_me" id="cond"  />
                <span>I agree to the PhysioHealth Terms 
of Service and Privacy Policy</span>
                </label>
                <button class="submit-button" type="button" id="signup">Sign up</button>
                </fieldset>
                </form>
         		</div>
        		</div>  
                
                
                <div class="active-links1">
            <div id="session1">
            <a id="login-link" href="#">
            &nbsp;&nbsp;Log in
            </a>
            </div>
            	<div id="login-dropdown">
        		<form method="post" class="signup" action="#">
                <fieldset class="textbox">
            	<label class="username">
                <span>Email Address</span>
                <input id="lusername" name="lusername" value="" type="text" autocomplete="on">
                </label>
                
                <label class="password">
                <span>Password</span>
                <input id="lpassword" name="lpassword" value="" type="password">
                </label>
                </fieldset>
                
                <fieldset class="remb">
                <label class="remember">
                <input type="checkbox" value="1" name="remember_me" id="remember_me" />
                <span>Remember me</span>
                </label>
                <button class="submit-button" type="button" id="login">Log in</button>
                </fieldset>
                <p>
                <a class="forgot" href="#">Forgot your password?</a>
                </p>
                </form>
         		</div>
        		</div>   
    </div>
  </div>
</div>
<!-- BANNER
  ================================================== -->
<div class="page banner">
  <div class="container">
    <h2 class="ban-txt1">Now every moment is healthy</h2>
    <img src="<?=$this->config->base_url();?>images/heres_physio.png">
    <ul class="ban-list">
      <li>Physio is your personal assistant and your health coach at work</li>
      <li>You will do healthy, stretching and strengthening exercises</li>
      <li>She will remind you when it's time for an exercise / healthy behaviour</li>
      <li>She will be there to provide healthy tips!</li>
    </ul>
    <div class="sixteen columns">
      <div class="ban-icon">
        <div class="exercises"></div>
        <p class="ban-txt2">Individualized <br>
          Exercises</p>
      </div>
      <div class="ban-icon">
        <div class="reminders"></div>
        <p class="ban-txt2">Healthy <br>
          Reminders</p>
      </div>
      <div class="ban-icon">
        <div class="tips"></div>
        <p class="ban-txt2">Healthy <br>
          Tips</p>
      </div>
    </div>
    <div class="sixteen columns"><a href="#" class="lets-get">Let's get going!</a></div>
  </div>
</div>
<!-- CONTENT AREA
  ================================================== -->
<div class="down">
  <div class="page-down-arrow"><img src="<?=$this->config->base_url();?>images/page_down_arrow.png"></div>
</div>
<div class="container">
  <div class="sixteen columns">
    <h3 class="content-txt1">What is PhysioHealth?</h3>
    <p class="content-txt2">PhysioHealth is your health coach at work. You will do breathing, stretching and strengthening exercises with her. She will remind you when. She will be there to give you healthy tips and guide you.<br>
      <br>
      PhysioHealth is a corporate wellness software that incorporates exercise to your daily routine. Not only it helps you overcome physical strain working at a computer puts on your body but also boosts your energy and mood. </p>
    <hr>
    <h3 class="content-txt1">Why PhysioHealth?</h3>
    <p class="content-txt2">40-70% of all office workers report having neck and shoulder pain and 23-38% report lower back pain. 64% of all surveyed indicate experiencing a health problem due to use of technology.<br>
      <br>
      Sitting is the new smoking. Prolonged sitting increases risk of diabetes by 115% and cardiovascular events by 147%. <br>
      <br>
      70% of employees we surveyed said they find themselves slouching at work. This position prevents you frommaking full use of your lung capacity resulting in fatigue. </p>
    <div class="five columns">
      <h5 class="content-txt3">Musculoskeletal Diseases</h5>
      <img src="<?=$this->config->base_url();?>images/musculoskeletal_icon.png">
      <p class="content-txt4">70% of all office workers report having neck or back pain due to use of technology.<br>
        <br>
        Low back pain is the second most prevalent reason for missed work days after common cold and flu. It's cost is ~$90B in the US. </p>
    </div>
    <div class="five columns">
      <h5 class="content-txt3">Chronic Diseases</h5>
      <img src="<?=$this->config->base_url();?>images/chronic_icon.png">
      <p class="content-txt4">Sitting for prolonged hours in front of a computer increases your risk of diabetes and cardiovascular events by more than 115% and 147% respectively </p>
    </div>
    <div class="five columns">
      <h5 class="content-txt3">Your Energy & Mood</h5>
      <img src="<?=$this->config->base_url();?>images/mood_icon.png">
      <p class="content-txt4">Sitting hunched over a laptop or your keyboard decreases your lung capacity. It limits your oxygen intake leaving you feeling more sluggish throughout the day </p>
    </div>
    <hr>
    <h3 class="content-txt1">Testimonials</h3>
    <div class="testimonial">
      <p>"I was 100% concentrated on the excel sheet I was working on for the past 2 hours, a physiohealth reminder popped up. I clicked on the link and with the lovely background and humor in the video I was able to relax for two minutes. It made me realize how tense my body/especially my shoulders were and pushed me to take a two minute break. I walked up and got a glass of water and felt healthier and more happy."</p>
      <span>Senior Associate, Private Equity Professional</span> </div>
    <div class="testimonial">
      <p>"Physio is like your mom, reminding you to do the right things during the day to look after your health and the great part about it is that it works! I was 38% concentrated on a slide I was working on (maximum concentration I can achieve) and the exercise was a great interruption to take another break and stay healthy. Joke aside, I believe it has a great impact because the reminders keep you from slipping into your comfort zone and staying motionless and waterless for long periods of time."</p>
      <span>Management Strategy Consultant, at Top Bracket Firm</span> </div>
    <hr>
    <h3 class="content-txt1">Story of PhysioHealth</h3>
    <p class="content-txt2">Melike is a former management strategy consultant who also worked in investment banking. Highest quality work is driven by a multi functional team consisting of medical, fitness and entrepreneurial </p>
  </div>
</div>
<!-- FOOTER
  ================================================== -->
<div class="footer">
  <div class="container">
    <div class="eight columns">
      <p class="copy-right-txt">Copyright &copy; 2014 PhysioHealth - Beta 1.0</p>
    </div>
    <div class="eight columns">
      <ul class="social-media">
        <li class="footer-txt">Connect with PhysioHealth:</li>
        <li><a href="#"><img src="<?=$this->config->base_url();?>images/fb_icon.png"></a></li>
        <li><a href="#"><img src="<?=$this->config->base_url();?>images/twitter_icon.png"></a></li>
      </ul>
    </div>
  </div>
</div>
</body>
</html>