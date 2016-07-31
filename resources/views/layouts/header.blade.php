<header>
    <!-- Nav bar Start -->
    <nav class="navbar navbar-default container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span><a href="#"> <i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                        </a></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">{{config('site.title')}}</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li>
                    <a href="{{ url('/auth/login') }}">Login</a>
                </li>
            @else
                @if(! Request::is('*/create'))
                    <li>
                        <div>
                            <a class="btn btn-success" style="margin-left: 5px;margin-right: 5px;" href="{{ url('/post/create') }}">Add New Post</a>
                        </div>
                    </li>
                @endif
                <li>
                    <div style="padding:15px 0;">{{Auth::user()->name}}</div>
                </li>
                <li>
                    <a href="{{ url('/auth/logout') }}">Logout</a>
                </li>
            @endif
        </ul>
    </nav>
    <!-- Nav bar End -->
</header>
<!-- //Header End -->