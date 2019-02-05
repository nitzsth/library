<a href="{{ route('dashboard') }}" class="logo">
  <span class="logo-mini">LMS</span>
  <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
</a>
<nav class="navbar navbar-static-top">
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
  	<ul class="nav navbar-nav">
  		<li class="dropdown user user-menu">
            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ auth()->user()->avatar ?: asset('img/avatar-placeholder.png') }}" class="user-image" alt="{{ auth()->user()->name }}">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ auth()->user()->avatar ?: asset('img/avatar-placeholder.png') }}" class="img-circle" alt="{{ auth()->user()->name }}">
                <p>
                	{{ auth()->user()->name }}
                	<small>{{ auth()->user()->email }}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                	<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                		Sign out
              		</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
                <div class="pull-left">
                  <a href="{{ route('users.show', auth()->id()) }}">
                    <button class="btn btn-default">Profile</button>
                  </a>
                </div>
              </li>
            </ul>
          </li>
  	</ul>
  </div>
</nav>