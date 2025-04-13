<nav class="navbar navbar-expand-md navbar-light shadow-sm larabel-tabelog-kadai-header-container">
   <div class="container">
       <a class="navbar-brand" href="{{ url('/') }}">
<!--           {{ config('app.name', 'Laravel') }}  -->
                  <img src="{{asset('img/icon.jpg')}}">
       </a>
 <!--  <form class="row g-1">
           <div class="col-auto">
               <input class="form-control larabel-tabelog-kadai-header-search-input">
           </div>
           <div class="col-auto">
               <button type="submit" class="btn larabel-tabelog-kadai-header-search-button"><i class="fas fa-search larabel-tabelog-kadai-header-search-icon"></i></button>
           </div>
       </form>

       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
           <span class="navbar-toggler-icon"></span>
       </button>
-->
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav ms-auto mr-5 mt-2">
               @guest
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('register') }}">登録</a>
                   </li>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                   </li>
                   <hr>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
                   </li>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
                   </li>

               @else
                  <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           予約一覧
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </li>
                   <hr>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           有料プラン登録
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </li>
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           有料プラン解除
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </li>
                   <hr>                  
                   <li class="nav-item mr-5">
                       <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           ログアウト
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </li>

               @endguest
           </ul>
       </div>
   </div>
</nav>