<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

    </style>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js" integrity="sha512-PydZDtPfuZPA8f5RT52IUcWsFH/49uu7p8+lp4C3K2SBB0I9CxoOlk/qzanLFpVvEuASBL0LKi2CKw4VidQOeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

</head>
<body>

    {{-- <div class="col-md-6"> --}}
        <div class="card p-3 mb-2" id="photo">
            <div class="front-side">
                <div class="color-grid">
                    <div class="black"></div>
                    <div class="red1"></div>
                    <div class="red2"></div>
                    <div class="green"></div>
                </div>
                <div class="info-grid">
                    <div class="name">
                        <img class="me-2"
                src="{{ asset('/') }}assets/img/icons/spot-illustrations/vet-partial.png" alt=""
                width="60" height="60"/> <h8><strong>VETLINK CARD</strong></h8>
                        <h5><strong> {{$agent->name}} </strong></h5>
                        {{-- <h5>CREATIVE GRAPHIC DESIGNER</h5> --}}
                    </div>
                    <div class="addr"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="30px" height="30px">
                            <!-- SVG Path for address icon -->
                            <g>
                                <g>
                                    <path d="M455.139,498.052l-99.132-99.132c-1.532-1.532-3.61-2.392-5.777-2.392h-18.927c-4.512,0-8.17,3.657-8.17,8.17    s3.658,8.17,8.17,8.17h15.542l82.792,82.791H82.362l82.791-82.791h15.542c4.512,0,8.17-3.657,8.17-8.17s-3.658-8.17-8.17-8.17    H161.77c-2.167,0-4.245,0.861-5.777,2.392l-99.132,99.132c-2.337,2.338-3.036,5.851-1.771,8.904    c1.265,3.053,4.244,5.044,7.548,5.044h386.723c3.304,0,6.283-1.99,7.548-5.044C458.175,503.903,457.475,500.39,455.139,498.052z"
                                        fill="#FFFFFF" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M256,0C161.393,0,84.426,76.968,84.426,171.574c0,35.596,10.808,69.742,31.263,98.756l133.641,188.964    c1.532,2.165,4.019,3.452,6.671,3.452c2.653,0,5.14-1.288,6.671-3.452L396.32,270.32c20.448-29.004,31.256-63.15,31.256-98.746    C427.574,76.968,350.607,0,256,0z M382.971,260.895L256,440.427L129.037,260.905c-18.495-26.234-28.271-57.125-28.271-89.331    C100.766,85.978,170.403,16.34,256,16.34s155.234,69.637,155.234,155.234C411.234,203.78,401.458,234.671,382.971,260.895z"
                                        fill="#FFFFFF" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M256,92.596c-43.549,0-78.979,35.429-78.979,78.979c0,14.657,4.073,28.988,11.779,41.442    c2.375,3.836,7.41,5.022,11.247,2.649c3.837-2.375,5.023-7.41,2.649-11.247c-6.107-9.87-9.335-21.225-9.335-32.843    c0-34.539,28.099-62.638,62.638-62.638s62.638,28.099,62.638,62.638S290.539,234.213,256,234.213    c-11.617,0-22.974-3.228-32.843-9.335c-3.839-2.376-8.873-1.187-11.247,2.649s-1.189,8.873,2.649,11.247    c12.454,7.706,26.784,11.779,41.44,11.779c43.549,0,78.979-35.429,78.979-78.979C334.979,128.025,299.549,92.596,256,92.596z"
                                        fill="#FFFFFF" />
                                </g>
                            </g>
                        </svg>
                        <h3></h3>
                        <p>
                            <strong> {{$agent->location}} </strong>
                        </p>
                    </div>
                    <div class="phoneNo">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 472.811 472.811"
                            enable-background="new 0 0 472.811 472.811" width="30px" height="30px">
                            <!-- SVG Path for phone icon -->
                            <g>
                                <path d="M358.75,0H114.061C97.555,0,84.128,13.428,84.128,29.934v412.944c0,16.505,13.428,29.934,29.934,29.934H358.75   c16.506,0,29.934-13.428,29.934-29.934V29.934C388.683,13.428,375.256,0,358.75,0z M99.128,75.236h274.556v312.687H99.128V75.236z    M114.061,15H358.75c8.234,0,14.934,6.699,14.934,14.934v35.302H99.128V29.934C99.128,21.699,105.827,15,114.061,15z    M358.75,457.811H114.061c-8.234,0-14.934-6.699-14.934-14.934v-44.955h274.556v44.955   C373.683,451.112,366.984,457.811,358.75,457.811z"
                                    fill="#FFFFFF" />
                                <path d="m236.406,404.552c-13.545,0-24.564,11.02-24.564,24.565s11.02,24.564 24.564,24.564 24.564-11.02 24.564-24.564-11.019-24.565-24.564-24.565zm0,39.129c-8.031,0-14.564-6.534-14.564-14.564 0-8.031 6.533-14.565 14.564-14.565s14.564,6.534 14.564,14.565c0,8.03-6.533,14.564-14.564,14.564z"
                                    fill="#FFFFFF" />
                                <path d="m202.406,47.645h68c2.762,0 5-2.239 5-5s-2.238-5-5-5h-68c-2.762,0-5,2.239-5,5s2.238,5 5,5z" fill="#FFFFFF" />
                                <path d="m184.409,47.645c1.31,0 2.6-0.53 3.53-1.46 0.93-0.94 1.47-2.22 1.47-3.54s-0.54-2.6-1.47-3.54c-0.931-0.93-2.221-1.46-3.53-1.46-1.32,0-2.601,0.53-3.54,1.46-0.93,0.93-1.46,2.22-1.46,3.54s0.53,2.6 1.46,3.54c0.93,0.93 2.22,1.46 3.54,1.46z"
                                    fill="#FFFFFF" />
                            </g>
                        </svg>
                        <h4></h4>
                        <p>Phone:<strong> +{{$agent->phone}} </strong></p>
                    </div>
                    <div class="emailId">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 467.211 467.211"
                            enable-background="new 0 0 467.211 467.211" width="30px" height="30px">
                            <!-- SVG Path for email icon -->
                            <g>
                                <path d="m413.917,96.775h-360.622c-6.369,0-11.551,5.181-11.551,11.55v213.182c0,6.369 5.182,11.55 11.551,11.55h360.622c6.368,0 11.55-5.181 11.55-11.55v-213.181c-5.68434e-14-6.369-5.182-11.551-11.55-11.551zm1.55,224.732c0,0.855-0.695,1.55-1.55,1.55h-360.622c-0.855,0-1.551-0.696-1.551-1.55v-213.181c0-0.855 0.695-1.55 1.551-1.55h360.622c0.854,0 1.55,0.696 1.55,1.55v213.181z"
                                    fill="#FFFFFF" />
                                <path d="m459.711,340.558h-11.744v-237.715c0-15.752-12.815-28.568-28.568-28.568h-371.586c-15.753,0-28.568,12.815-28.568,28.568v237.714h-11.745c-4.143,0-7.5,3.358-7.5,7.5v20.605c0,13.384 10.889,24.272 24.272,24.272h418.666c13.384,0 24.272-10.889 24.272-24.272v-20.605c0.001-4.141-3.356-7.499-7.499-7.499zm-425.467-237.715c-2.84217e-14-7.481 6.087-13.568 13.568-13.568h371.586c7.481,0 13.568,6.086 13.568,13.568v237.714h-398.722v-237.714zm177.361,252.715h44v3.922c0,1.755-1.428,3.184-3.184,3.184h-37.633c-1.756,0-3.184-1.428-3.184-3.184v-3.922zm240.607,13.105c0,5.113-4.159,9.272-9.272,9.272h-418.667c-5.113,0-9.272-4.16-9.272-9.272v-13.105h11.744 174.861v3.922c0,7.27 5.914,13.184 13.184,13.184h37.633c7.27,0 13.184-5.914 13.184-13.184v-3.922h174.861 11.744v13.105z"
                                    fill="#FFFFFF" />
                            </g>
                        </svg>
                        <h4></h4>
                        <p class="email">
                            <strong> {{$agent->email}} </strong>
                        </p>
                        {{-- <p class="web">
                            <strong>www</strong>.yourwebsite.
                            <strong>com</strong>
                        </p> --}}
                    </div>
                </div>
            </div>
            <div class="back-side">
                <!-- Content for the back side of the card can be added here -->
                <div class="color-grid">
                    <div class="black"></div>
                    <div class="red1"></div>
                    <div class="red2"></div>
                    <div class="green"></div>
                </div>
                <div class="name-tag">
                    <h1>
                        <strong> {{$agent->agent_id}} </strong>
                    </h1>
                    {{-- <h3>CREATIVE GRAPHIC DESIGNER</h3> --}}
                </div>
            </div>
        </div>
    {{-- </div> --}}
    <button id="download">download</button>
    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#download").click(function(){
                screenshot();
            });
        });

        function screenshot(){
            html2canvas(document.getElementById("photo")).then(function(canvas){
               downloadImage(canvas.toDataURL(),"UsersInformation.png");
            });
        }

        function downloadImage(uri, filename){
          var link = document.createElement('a');
          if(typeof link.download !== 'string'){
             window.open(uri);
          }
          else{
              link.href = uri;
              link.download = filename;
              accountForFirefox(clickLink, link);
          }
        }

        function clickLink(link){
            link.click();
        }

        function accountForFirefox(click){
            var link = arguments[1];
            document.body.appendChild(link);
            click(link);
            document.body.removeChild(link);
        }


    </script>
</body>
</html>
drive.google.com/file/d/1-ROqoZFxT1wF15UdfTrNjkacMYBtEbOw/view
