<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dvojčata na útěku | Radim Keith</title>
	<meta name="title" content="jQuery One Page Scroll by Pete R. | The Pete Design" />
	<meta name="description" content="kniha Dvojčata na útěku" />

    <!-- font-family: 'Sacramento', cursive; font-family: 'Lato', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Lato:100|Sacramento&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" id="favicon" href="favicon.png"> 
	<meta name="author" content="Radim Keit, Vladimír Mlázovský">
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="js/jquery.onepage-scroll.js"></script>
  <link href='css/onepage-scroll.css' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <style>
    html {
      height: 100%;
    }
    body {
      background: #E2E4E7;
      padding: 0;
      text-align: center;
      font-family: 'Helvetica Neue', sans-serif;
      font-weight: 200;
      position: relative;
      margin: 0;
      height: 100%;
      -webkit-font-smoothing: antialiased;
    }
    
    .wrapper {
    	height: 100% !important;
    	height: 100%;
    	margin: 0 auto; 
    	overflow: hidden;
    }
    
    a {
      text-decoration: none;
    }
    
    
    h1, h2 {
      width: 100%;
      float: left;
    }
    h1 {
      margin-top: 100px;
      color: #000;
      margin-bottom: 5px;
      font-size: 70px;
      letter-spacing:
      font-weight: 100;
      font-family: 'Sacramento', cursive;
    }
    h1 span {
      font-size: 26px;
      margin: 0 5px;
      text-transform: capitalize;
      background: rgba(0,0,0,0.85);
      display: inline-block;
      color: #6D461D;
      border-radius: 5px 5px;
      -webkit-border-radius: 5px 5px;
      -moz-border-radius: 5px 5px;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.75);
      padding: 3px 10px;
    }
    h2 {
      color: #6D461D;
      font-weight: 100;
      margin-top: 0;
      margin-bottom: 10px;
    }
    
    .pointer {
      color: #9b59b6;
      font-family: 'Pacifico', cursive;
      font-size: 30px;
      margin-top: 15px;
    }

    .main {
      float: left;
      width: 100%;
      margin: 0 auto;
    }
    
    .main h1 {
      padding:150px 50px;
      float: left;
      width: 100%;
      font-size: 45px;
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      font-weight: 100;
      color: white;
      margin: 0;
    }
   
    .main h1.demo1 {
      background: #1ABC9C;
    }
    
    .reload.bell {
      font-size: 12px;
      padding: 20px;
      width: 45px;
      text-align: center;
      height: 47px;
      border-radius: 50px;
      -webkit-border-radius: 50px;
      -moz-border-radius: 50px;
    }
    
    .reload.bell #notification {
      font-size: 25px;
      line-height: 140%;
    }
    
    .reload, .btn{
      display: inline-block;
      border: 4px solid #A2261E;
      border-radius: 5px;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      background: #CC3126;
      display: inline-block;
      line-height: 100%;
      padding: 0.7em;
      text-decoration: none;
      color: #fff;
      width: 100px;
      line-height: 140%;
      font-size: 17px;
      font-family: open sans;
      font-weight: bold;
    }
    .reload:hover{
      background: #444;
    }
    .btn {
      width: 200px;
      color: rgb(255, 255, 255);
      border: 4px solid rgb(0, 0, 0);
      background: rgba(3, 3, 3, 0.75);
    }
    .clear {
      width: auto;
    }
    .btn:hover, .btn:hover {
      background: #444;
    }
    .btns {
      width: 410px;
      margin: 50px auto;
    }
    .credit {
      text-align: center;
      color: rgba(0,0,0,0.5);
      padding: 10px;
      width: 410px;
      clear: both;
    }
    .credit a {
      color: rgba(0,0,0,0.85);
      text-decoration: none;
      font-weight: bold;
      text-align: center;
    }
    
    .back {
      position: absolute;
      top: 0;
      left: 0;
      text-align: center;
      display: block;
      padding: 7px;
      width: 100%;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      background: rgba(255, 255, 255, 0.25);
      font-weight: bold;
      font-size: 13px;
      color: #000;
      -webkit-transition: all 500ms ease-in-out;
      -moz-transition: all 500ms ease-in-out;
      -o-transition: all 500ms ease-in-out;
      transition: all 500ms ease-in-out;
    }
    .back:hover {
      color: black;
      background: rgba(255, 255, 255, 0.5);
    }
    
    header {
      position: relative;
      z-index: 10;
    }
    .main section .page_container {
      position: relative;
      top: 25%;
      margin: 0 auto 0;
      max-width: 950px;
      z-index: 3;
    }
    .main section  {
      overflow: hidden;
    }
    
    .main section > img {
      position: absolute;
      max-width: 100%;
      z-index: 1;
    }
    
    .main section.page1 {
      background:#FFEBF1;
    }
    .main section.page1 h1 {
      text-align: left;
      padding: 0;
      margin-bottom: 15px;
      font-size: 70px;
      color: #E487A3;
    }
    .main section.page1 h2 {
      text-align: center;
      width: 435px;
      line-height: 160%;
        color: #E487A3; 
    }
    .main section .page_container .btns {
      clear: both;
      float: right;
      text-align: center;
      width: 435px;
    }
    .main section .page_container .btns a{
      text-align: left;
    }

    .main section.page2 {
      background-image: url('img/knizka.jpg');
      background-size: cover;
    }
    .main section.page2 .page_container {
        top: 5%;
        float:right;
        margin-right:15px; 
        overflow: hidden;
        color: rgba(255,245,242,0.85);
        font-size: 19px;
        text-align: justify;
    }
    .viewing-page-2 .back{
      background: rgba(0, 0, 0, 0.25);
      color: #FFF;
      }


    .main section.page3 {
      background-image: url('img/bg3.jpg');
      background-size:cover;
      background-position: center bottom;
      color: white;
      text-shadow: 0 0 5px rgba(0,0,13,1.0);
    }
    .main section.page3 .page_container {
      overflow: hidden;
      width: 500px;
      right: -285px;
    }
    .main section.page3 h1 {
      text-align: left;
      padding: 0;
      margin-bottom: 0;
      font-size: 70px;
      letter-spacing: -1px;
    }
    .main section.page3 h2 {
      color: rgba(0,0,0,0.85);
      text-align: left;
      line-height: 160%;
      font-weight: 100;
      font-size: 21px;
    }
    
    body.disabled-onepage-scroll .onepage-wrapper  section {
      min-height: 100%;
      height: auto;
    }
    
    body.disabled-onepage-scroll .main section .page_container, body.disabled-onepage-scroll .main section.page3 .page_container  {
      padding: 20px;
      margin-top: 150px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }
    
    body.disabled-onepage-scroll  section .page_container h1{
      text-align: center;
      font-size: 50px;
    }
    body.disabled-onepage-scroll section .page_container h2, body.disabled-onepage-scroll section .page_container .credit, body.disabled-onepage-scroll section .page_container .btns{
      text-align: center;
      width: 100%;
    }
    
    body.disabled-onepage-scroll .main section.page1 > img {
      position: absolute;
      width: 80%;
      left: 10%;
    }
    
    body.disabled-onepage-scroll .main section > img {
      position: relative;
      max-width: 80%;
      bottom: 0;
    }
    body.disabled-onepage-scroll code {
      width: 95%;
      margin: 0 auto 25px;
      float: none;
      overflow: hidden;
    }
    
    body.disabled-onepage-scroll .main section.page3 .page_container {
      width: 90%;
      margin-left: auto;
      margin-right: auto;
      right: 0;
    }
    .social {
        position: fixed;
        right: 6px;
        top: 6px;
    }
    .social img {
        width: 30px;
    }
	</style>
	<script>
	  $(document).ready(function(){
      $(".main").onepage_scroll({
        sectionContainer: "section",
        responsiveFallback: 800,
        loop: false
      });
		});
		
	</script>
</head>
<body>
  <div class="wrapper">
	  <div class="main">
	    
      <section class="page1">
        <div class="page_container">
        <div>
          <h1>Dvojčata na útěku</h1>
          <h2>Radim Keith</h2>
          <img src="img/nohy.png">
  	      </div>
  	    </div>
  	    
      </section>
	    
	    <section class="page2">
            <div class="page_container">
              <p>Začalo jaro a s ním i nucené práce vykoupené krví a bolavými zády na vlastní zahrádce. Na zahrádku jsme vypustili i oba tygry. Běhají mezi krumpáčem, lopatou a hlínou a nedají se zkrotit. I ten řev našich dvojčat nasvědčuje tomu, že se po dalších pár měsíců nastěhovala zuřivá šelma na náš dvůr a jen tak se jí rozhodně nezbavíme. Co si holky ale oblíbily jsou domácí (rozuměj zahradní) zvířátka. Žádný krtek nebo hraboš, ale ke štěstí postačí žížala. Žížala je opečovávaná.</p>
      </section>
	    
	    <section class="page3">
	      <div class="page_container">
          <h1>Koupit?</h1>
          <p>Hledejte na pultech knihkupectví a sledujte Facebookovou stránku.</p>
  	    </div>
      </section>
    </div>
    <div class="social">
        <a href="https://www.facebook.com/dvojcatanauteku/" target="_blank" title="Facebook - Dvojčata na útěku"><img src="img/fb.png"></a>
    </div>
  </div>
</body>
</html>