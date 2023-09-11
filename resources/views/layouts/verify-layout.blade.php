<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FRYCRYPTO</title>
    <meta name="description" content="Purchase your FRY BYOD License here!">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/sass/app.scss','resources/css/custom.css', 'resources/js/app.js'])
</head>
<body>
<main>
    <nav class="nav-bar">
        <div class="logo-container">
            <img class="logo"
                 src="{{asset('assets/images/logo.png')}}"
                 alt="logo">
        </div>
    </nav>
    <div class="header"></div>
    <div class="title-container">
        <h1 class="title">@yield('page-title', 'BYOD License')</h1>
    </div>
    <div class="content-box">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="divider"></div>
        <div class="footer-container">
            <p>Building a Decentralized Network <br/>of Decentralized Networks</p>
            <p style="margin-top:10px;display:flex;align-items:center;margin-bottom:20px">
                <img src="{{asset('assets/svgs/email.svg')}}" alt="">
                <span style="margin-left:10px">contact@fryfoundation.com</span></p>
            <div style="display:flex;justify-content:space-between;width:150px">
                <a href="https://twitter.com/your-handle"><img src="{{asset('assets/svgs/twitter.svg')}}" alt=""></a>
                <a href="https://discord.com/in/your-profile" style="margin-left:2px"><img src="{{asset('assets/svgs/discord.svg')}}" alt=""></a>
                <a href="https://linkedin.com/in/your-profile"><img src="{{asset('assets/svgs/linkedin.svg')}}" alt=""></a>
                <a href="https://facebook.com/your-profile"><img src="{{asset('assets/svgs/fb.svg')}}" alt=""></a>
                <a href="https://youtube.com/c/your-channel"><img src="{{asset('assets/svgs/yt.svg')}}" alt=""></a>
            </div>
            <p style="margin-top:60px;color:#595959;font-size:12px">© Fry Foundation. All Rights Reserved.</p></div>
        <div style="display:flex;justify-content:space-between;margin-top:20px">
            <div style="display:flex;flex-direction:column;margin-right:10px;margin-left:10px"><h1
                    style="margin-bottom:20px;font-size:20px">Quick Links</h1>
                <p><a href="https://www.fryfoundation.com/">Home</a></p>
                <p><a href="https://www.fryfoundation.com/about">About Us</a></p>
                <p><a href="https://www.fryfoundation.com/roadmap">Roadmap</a></p>
                <p><a href="https://www.fryfoundation.com/shop">Buy $FRY Miners</a></p></div>
            <div style="display:flex;flex-direction:column;margin-right:10px;margin-left:10px"><h1
                    style="margin-bottom:20px;font-size:20px">Resources</h1>
                <p><a href="https://www.fryfoundation.com/instructions">General Setup Instructions</a></p>
                <p><a href="https://www.fryfoundation.com/shipping-updates">Shipping Updates</a></p>
                <p><a href="https://www.fryfoundation.com/recycle-miner-download">Recycle Mining</a></p>
                <p><a href="https://www.fryfoundation.com/explorer">Explorer</a></p>
                <p><a href="https://www.fryfoundation.com/news">News</a></p>
                <p><a href="https://www.fryfoundation.com/faq">FAQ</a></p></div>
            <div style="display:flex;flex-direction:column;margin-right:10px;margin-left:10px"><h1
                    style="margin-bottom:20px;font-size:20px">$FRY Mining</h1>
                <p><a href="https://www.fryfoundation.com/fry-recycle-mining">$FRY Recycle Mining</a></p>
                <p><a href="https://www.fryfoundation.com/free-tier-instructions">Free Tier Instructions</a></p>
                <p><a href="https://www.fryfoundation.com/paid-tier-instructions">Paid Tier Instructions</a></p>
                <p><a href="https://www.fryfoundation.com/paid-tier-plans">Paid Tier Plans</a></p></div>
            <div style="display:flex;flex-direction:column;margin-right:10px;margin-left:10px"><h1
                    style="margin-bottom:20px;font-size:20px">Legal</h1>
                <p><a href="https://www.fryfoundation.com/terms-conditions">Terms &amp; Conditions</a></p>
                <p><a href="https://www.fryfoundation.com/privacy-policy">Privacy Policy</a></p>
                <p><a href="https://www.fryfoundation.com/return-policy">Return Policy</a></p>
                <p><a href="https://www.fryfoundation.com/digital-item-policy">Digital Item Policy</a></p>
                <p><a href="https://www.fryfoundation.com/warranty-policy">Warranty Policy</a></p></div>
        </div>
    </footer>
</main>
</body>
</html>
