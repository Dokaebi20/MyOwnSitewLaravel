
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="collapse navbar-collapse" >
            <img src="../img/main_img/iconABC_white.png" width="70px" height="35px">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link {{($title === "Home") ?  'active' : ''}}" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($title === "Cart") ?  'active' : ''}}" href="/cart">Cart</a>
            </li>
            <li class="nav-item">
                <a 
                {{-- class="nav-link {{($title == "Check Out") ?  'active' : ''}}"  --}}
                class="nav-link {{($title == "Check Out") ?  'active' : ''}}" 
                href="/checkout">Check Out</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="/logout" style="margin-left: 70vw">Log Out </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/login" style="margin-left: 70vw">Log In </a>
            </li>
            @endauth
        </div>
    </nav>

