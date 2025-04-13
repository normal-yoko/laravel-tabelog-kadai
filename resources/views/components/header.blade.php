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
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">登録</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            予約一覧
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                    @if (  Auth::user()->paid_flg == 0)
                        <a class="nav-link" href="{{ route('checkouts.index') }}" >
                           有料プラン登録
                       </a>
                    @else
                    <form action="{{ route('checkouts.destroy', ['checkout' => 'aaa']) }}" method="POST" class="nav-link" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                            有料プラン解除
                        </button>
                    </form>
                    @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
           </ul>
       </div>
   </div>
</nav>