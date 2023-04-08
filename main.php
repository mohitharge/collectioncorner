<!DOCTYPE html>
<html>
<head>
	<title>Collection Corner</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
	}
	

/* Carousel Styles */
.carousel-indicators .active {
    background-color: #2980b9;
}

.carousel-inner img {
    width: 100%;
    max-height: 460px
}

.carousel-control {
    width: 0;
}

.carousel-control.left,
.carousel-control.right {
	opacity: 1;
	filter: alpha(opacity=100);
	background-image: none;
	background-repeat: no-repeat;
	text-shadow: none;
}

.carousel-control.left span {
	/*padding: 15px;*/
	margin-left: 10px;
}

.carousel-control.right span {
	/*padding: 15px;*/
	margin-right: 10px;
}

.carousel-control .glyphicon-chevron-left, 
.carousel-control .glyphicon-chevron-right, 
.carousel-control .icon-prev, 
.carousel-control .icon-next {
	position: absolute;
	top: 45%;
	z-index: 5;
	display: inline-block;
}

.carousel-control .glyphicon-chevron-left,
.carousel-control .icon-prev {
	left: 0;
}

.carousel-control .glyphicon-chevron-right,
.carousel-control .icon-next {
	right: 0;
}

.carousel-control.left span,
.carousel-control.right span {
	/*background-color: #000;*/
}

.carousel-control.left span:hover,
.carousel-control.right span:hover {
	opacity: .7;
	filter: alpha(opacity=70);
}

/* Carousel Header Styles */
.header-text {
    position: absolute;
    top: 20%;
    left: 1.8%;
    right: auto;
    width: 96.66666666666666%;
    color: #fff;
}

.header-text h2 {
    font-size: 40px;
}
.lib-panel {
    margin-bottom: 20Px;
}
.lib-panel img {
    width: 100%;
    background-color: transparent;
}

.lib-panel .row,
.lib-panel .col-md-6 {
    padding: 0;
    background-color: #FFFFFF;
}


.lib-panel .lib-row {
    padding: 0 20px 0 20px;
}

.lib-panel .lib-row.lib-header {
    background-color: #FFFFFF;
    font-size: 24px;
    padding: 10px 20px 0 20px;
}

.lib-panel .lib-row.lib-header .lib-header-seperator {
    height: 2px;
    width: 26px;
    background-color: #d9d9d9;
    margin: 7px 0 7px 0;
}

.lib-panel .lib-row.lib-desc {
    position: relative;
    height: 100%;
    display: block;
    font-size: 14px;
}
.lib-panel .lib-row.leftib-desc a{
    position: absolute;
    width: 100%;
    bottom: 10px;
    left: 20px;
}

.row-margin-bottom {
    margin-bottom: 20px;
}

.box-shadow {
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
    box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
}

.no-padding {
    padding: 0;
}

/*.header-text h2 span {
    background-color: #2980b9;
	padding: 10px;
}

.header-text h3 span {
	background-color: #000;
	padding: 15px;
}*/

.btn-min-block {
    min-width: 170px;
    line-height: 26px;
}

.btn-theme {
    /*color: #fff;*/
    /*background-color: transparent;*/
    /*border: 2px solid #fff;*/
    margin-right: 15px;
}

/*.btn-theme:hover {
    color: #000;
    background-color: #fff;
    border-color: #fff;
}*/

.item::before{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: black;
  opacity: .6;
}
.container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: 0;
    margin-left: 0;
}

}

</style>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="home.php"><img src=""></a> -->
			<a class="navbar-brand" href="home.php"><img style="height: 46px; margin-top: -13px;" src="images\logo2.png"></a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">

	      
	       	<li><a href="home.php">Home</a></li>
    			<li><a href="signin.php">Login</a></li>
    			<li><a href="signup.php">Signup</a></li>

			</ul>
		</div>
	</div>
</nav>
	<div class="container-fluid" style="margin-top: -18px;">
		<div class="row">
			<!-- Carousel -->
	    	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
				  	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
				    <div class="item active">
				    	<img style="object-fit: cover;" src="images/bg3.jpg" alt="First slide">
	                    <!-- Static Header -->
	                    <div class="header-text hidden-xs">
	                        <div class="col-md-12 text-center">
	                            <h2>
	                            	<span>Find Rare Coins from all over the world</strong></span>
	                            </h2>
	                            <br>
	                            <h3>
	                            	<span>Check out Collections from Indian coins and World coins.</span>
	                            </h3>
	                            <br>
	                            <div class="">
	                                <a class="btn btn-success btn-theme btn-sm btn-min-block" href="signin.php">Login</a><a class="btn btn-primary btn-sm btn-min-block" href="signup.php">Register</a></div>
	                        </div>
	                    </div><!-- /header-text -->
				    </div>
				    <div class="item">
				    	<img style="object-fit: cover;" src="images/stampbg.jpg" alt="Second slide">
				    	<!-- Static Header -->
	                    <div class="header-text hidden-xs">
	                        <div class="col-md-12 text-center">
	                            <h2>
	                                <span>Find different verities of Stamps from all over the world</span>
	                            </h2>
	                            <br>
	                            <h3>
	                            	<span>Brouse stamp collections here</span>
	                            </h3>
	                            <br>
	                            <div class="">
	                                <a class="btn btn-success btn-theme btn-sm btn-min-block" href="signin.php">Login</a><a class="btn btn-primary btn-sm btn-min-block" href="signup.php">Register</a></div>
	                        </div>
	                    </div><!-- /header-text -->
				    </div>
				    <div class="item">
				    	<img style="object-fit: cover;" src="images/origamibg2.jpg" alt="Third slide">
				    	<!-- Static Header -->
	                    <div class="header-text hidden-xs">
	                        <div class="col-md-12 text-center">
	                            <h2>
	                                <span>Find various types of Origami art</span>
	                            </h2>
	                            <br>
	                            <h3>
	                            	<span>Check out Collections of different origami art</span>
	                            </h3>
	                            <br>
	                            <div class="">
	                                <a class="btn btn-success btn-theme btn-sm btn-min-block" href="signin.php">Login</a><a class="btn btn-primary btn-sm btn-min-block" href="signup.php">Register</a></div>
	                        </div>
	                    </div><!-- /header-text -->
				    </div>
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			    	<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			    	<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div><!-- /carousel -->
		</div>
	</div>
<div class="container">
	<h1>Coin Collection</h1>
	<div id="mainContainer" class="container" style="margin-top: 15px; border: 0px !important;">
  <div class="panel panel-default" style=" box-shadowmargin-top: ; border: 0px !important;">
    <div class="panel-body" style="margin-top: ; border: 0px !important;">
      <div class="row">
        <div class="col-md-3">
          <div class="panel panel-default my_panel box-shadow">
            <div class="panel-body" style="padding-bottom: 20px;">
              <img src="images/Hyderabad-State-Charminar-Rupee-Mir-Usman-Ali-Khan-1902-1911.jpeg" alt="" class="img-responsive center-block" id="img1" />
            </div>
            <div class="panel-footer">
              <h4>Hyderabad State Charminar Rupee Mir Usman Ali Khan 1911</h4>
              <p>The Silver rupee is from the Nizam period.</p>
            </div>
          </div>
        </div>
                <div class="col-md-3">
          <div class="panel panel-default my_panel box-shadow">
            <div class="panel-body">
              <img src="images/British-India-Coin-Quarter-Rupee-Silver-King-George-6.jpg" alt="" class="img-responsive center-block" id="img2" />
            </div>
            <div class="panel-footer">
              <h4>British India Silver One Rupee George V 1912 to 1936</h4>
              <p>The Silver Rupee coins are one of the British India Coin</p>
            </div>
          </div>
        </div>
                <div class="col-md-3">
          <div class="panel panel-default my_panel box-shadow">
            <div class="panel-body" style="padding-top: 70px; padding-bottom: 70px;">
              <img src="images/Republic-India-1-Paisa-1964-AUNC.jpg" alt="" class="img-responsive center-block" id="img3"/>
            </div>
            <div class="panel-footer">
              <h4>Republic India 1 Paisa 1964 AUNC</h4>
              <p>The One Paisa coin is one of the old Indian coins. This coin also comes under Republic India Coins.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default my_panel box-shadow">
            <div class="panel-body" style="padding-top: 70px; padding-bottom: 70px;">
              <img src="images/one rupee 1947.jpg" alt="" class="img-responsive center-block" id="img3"/>
            </div>
            <div class="panel-footer">
              <h4>British India Last Variety Half Rupee</h4>
              <p>The Nickel Quarter Rupee coins is one of the British India Coin</p><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
	
</div>
<div class="container">
            <h1>Collection Articles</h1><br>
            <div class="row row-margin-bottom">
            <div class="col-md-12 no-padding lib-item" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-5" style="padding-left: 0px !important">
                            <img class="lib-img-show" style="object-fit: cover; height: 255px;" src="images/bg6.jpg">
                        </div>
                        <div class="col-md-7">
                            <div class="lib-row lib-header">
                                Coin Collection
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                                Coin collecting, also called numismatics, the systematic accumulation and study of coins, tokens, paper money, and objects of similar form and purpose.The collecting of coins is one of the oldest hobbies in the world. With the exception of China and Japan, the introduction of paper money is for the most part a recent development (meaning since the 18th century). Hence, while paper money and other types of notes are collectible, the history of that form of collecting is distinct from coins and largely a modern phenomenon.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 no-padding lib-item" data-category="ui">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-5" style="padding-left: 0px !important">
                            <img class="lib-img" style="object-fit: cover; height: 255px;" src="images/stampbg.jpg">
                        </div>
                        <div class="col-md-7">
                            <div class="lib-row lib-header">
                                Stamp Collection
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                                Stamp collecting is generally accepted as one of the areas that make up the wider subject of philately, which is the study of stamps. A philatelist may, but does not have to, collect stamps. It is not uncommon for the term philatelist to be used to mean a stamp collector. Many casual stamp collectors accumulate stamps for sheer enjoyment and relaxation without worrying about the tiny details. The creation of a large or comprehensive collection, however, generally requires some philatelic knowledge and will usually contain areas of philatelic studies.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 no-padding lib-item" data-category="ui">
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-md-5" style="padding-left: 0px !important">
                            <img class="lib-img" style="object-fit: cover; height: 255px;" src="images/origamibg1.jpg">
                        </div>
                        <div class="col-md-7">
                            <div class="lib-row lib-header">
                                Origami Art Collection
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                                The small number of basic origami folds can be combined in a variety of ways to make intricate designs. The best-known origami model is the Japanese paper crane. In general, these designs begin with a square sheet of paper whose sides may be of different colors, prints, or patterns. Traditional Japanese origami, which has been practiced since the Edo period (1603–1867), has often been less strict about these conventions, sometimes cutting the paper or using nonsquare shapes to start with. The principles of origami are also used in stents, packaging, and other engineering applications.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
<?php include ("includes/footer.php"); ?>
</html>