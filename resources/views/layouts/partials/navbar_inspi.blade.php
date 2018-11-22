<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ asset('images/default-picture-small.png') }}" />
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="{{ asset('templates/inspinia_271/#') }}">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                    </span> <span class="text-muted text-xs block">{{ implode(Auth::user()->getRoleNames()->toArray()) }} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ url('profile') }}">Profile</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    +
                </div>
            </li>
            

            @if (Auth::check())
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            @role("Panitera")
            <li>
                <a href="{{ route('berkas_perkara.index') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Berkas Perkara</span></a>
            </li>
            @elserole("Panitera Muda")
            <li>
                <a href="{{ route('users.index') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Pengguna</span></a>
            </li>



            <li>
                <a href="{{ route('jenis_perkara.index') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Jenis Perkara</span></a>
            </li>
            <li>
                <a href="{{ route('perkara.index') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Perkara</span></a>
            </li>
            
            <li>
                <a href="{{ route('riwayat_pembaca.index') }}"><i class="fa fa-circle-thin"></i> <span class="nav-label">Riwayat Pembaca</span></a>
            </li>
            @endrole
            @endif
        </ul>

    </div>
</nav>