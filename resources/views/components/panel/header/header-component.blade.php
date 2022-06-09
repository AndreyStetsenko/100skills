<nav class="grey lighten-5">
    <div row>
        
        <div class="nav-wrapper">
            <a href="/" class="logo__link">
                <img src="/resources/img/logo.svg" 
                     style="height: 95px;
                            padding: 5px 10px 10px 10px;
                            background: #fff;
                            border-radius: 5px;
                            border: 1px solid #dedede;
                            margin: 6px 0 0 0;">
            </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a href="{{ route('panel') }}">
                        Панель управления
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class='block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            Выйти
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>