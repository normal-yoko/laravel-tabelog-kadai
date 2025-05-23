<nav class="navbar navbar-expand-md navbar-light shadow-sm larabel-tabelog-kadai-header-container">
   <div class="container">
       <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{asset('img/icon.jpg')}}">
       </a>
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

                    @if (  Auth::user()->paid_flg == 0)
                            <a class="nav-link" href="{{ route('checkouts.index') }}" >
                            有料プラン登録
                        </a>
                    @else
                        <a class="nav-link" href="{{ route('reserves.index') }}">
                                予約一覧
                        </a>
                        <a class="nav-link" href="{{ route('favorites.index') }}" >
                                お気に入り一覧
                        </a>

                        <a class="nav-link" href="{{ route('reviews.index') }}">
                                投稿レビュー一覧
                        </a>
                        <a class="dropdown-item" href="{{ route('checkout.card') }}">
                                カード情報を表示
                        </a>
                        <form action="{{ route('checkouts.destroy', ['checkout' => 'aaa']) }}" method="POST" class="nav-link" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                                有料プラン解除
                            </button>
                        </form>
                        @endif
                        <a class="dropdown-item" href="{{ route('edit') }}"
                                onclick="event.preventDefault();
                                document.getElementById('user-edit-form').submit();">
                                ユーザー情報の変更
                        </a>
                        <form id="user-edit-form" action="{{ route('edit') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        <a class="dropdown-item" href="{{ route('password.edit') }}"
                            onclick="event.preventDefault();
                            document.getElementById('password-edit-form').submit();">
                            パスワードの変更
                        </a>
                        <form id="password-edit-form" action="{{ route('password.edit') }}" method="GET" class="d-none">
                        </form>

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