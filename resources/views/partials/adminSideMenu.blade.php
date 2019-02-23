<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand " href="./"><img class="rounded-circle" src="{{asset('img/arklogo.jpg')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('img/arklogo.jpg')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/userhome"> <i class="menu-icon fas fa-home"></i>Ark Home </a>
                </li>
                @if(auth()->user()->hasRole('Owner'))
                    <h3 class="menu-title">Test Menu</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user"></i>Testing Shit</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fas fa-user"></i><a href="/dinoImage">Dino Images</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                <h3 class="menu-title">Admin Menu</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-user"></i>User Management</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-user"></i><a href="/manageUser">Manage User</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fab fa-phoenix-framework"></i>Roles Management</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="/roles">Roles</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="/roles/create">Add Role</a></li>
                    </ul>
                </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fab fa-phoenix-framework"></i>Perms Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fas fa-list-ul"></i><a href="/permissions">Permissions</a></li>
                            <li><i class="fas fa-plus-circle"></i><a href="/permissions/create">Add Perms</a></li>
                        </ul>
                    </li>
               {{-- <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-sort-amount-down"></i>Item Management</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="#">Items</a></li>
                    </ul>
                </li>--}}
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-dollar-sign"></i>Bank Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fas fa-dollar-sign"></i><a href="/bank">Bank Info</a></li>
                            <li><i class="fas fa-dollar-sign"></i><a href="/transactions">Bank Transactions</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-dollar-sign"></i>Gate Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fas fa-dollar-sign"></i><a href="/gates">Gate Info</a></li>
                            <li><i class="fas fa-dollar-sign"></i><a href="/gates/create">Gate Create</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-dollar-sign"></i>Dino Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            @can('PVP Dino Seller')
                                <li><i class="fas fa-plus-circle"></i><a href="/dinos/create">Add Dino</a></li>
                                <li><i class="fas fa-edit"></i></i><a href="/dinoRequests">View Requests</a></li>
                                <li><i class="fas fa-minus"></i></i><a href="/dinoRequests/completed">Completed Requests</a></li>
                                <li><i class="fas fa-list-ul"></i><a href="/dinos/admin">All Dinos</a></li>
                                <li><i class="fas fa-list-ul"></i><a href="/pveDinos/admin">PVE Inventory</a></li>
                                <li><i class="fas fa-list-ul"></i><a href="/pvpDinos/admin">PVP Inventory</a></li>
                            @endcan
                        </ul>
                    </li>
               @endif
                <h3 class="menu-title">Store Management</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-dollar-sign"></i>Currency</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-funnel-dollar"></i><a href="/currencyConverter">Converter</a></li>
                        <li><i class="fas fa-exchange-alt"></i><a href="/exchangeRates">Exchange Rates</a></li>
                        @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                        <li><i class="far fa-edit"></i><a href="/currencyEditor">Currency Editor</a></li>
                        @endif
                    </ul>
                </li>
                @if(auth()->user()->hasRole('Tribe Member') || auth()->user()->hasRole('Tribe Leader'))
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fab fa-phoenix-framework"></i>Dinos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="/dinos">All Dinos</a></li>
                        <li><i class="fas fa-list-ul"></i><a href="/pveDinos">PVE Inventory</a></li>
                        <li><i class="fas fa-list-ul"></i><a href="/pvpDinos">PVP Inventory</a></li>
                        <li><i class="fas fa-minus"></i></i><a href="/myRequests/">My Requests</a></li>
                    </ul>
                </li>
                @endif
                {{--<li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-sort-amount-down"></i>Items</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="ui-buttons.html">Current Inventory</a></li> @if(auth()->user()->hasRole('Owner'))
                            <li><i class="fas fa-plus-circle"></i><a href="/dinos/create">Add</a></li>
                            <li><i class="fas fa-edit"></i></i><a href="ui-badges.html">Edit</a></li>
                            <li><i class="fas fa-minus"></i></i><a href="ui-social-buttons.html">Remove</a></li>
                        @endif
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-fighter-jet"></i>Weapons/Armor</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="ui-buttons.html">Current Inventory</a></li> @if(auth()->user()->hasRole('Owner'))
                            <li><i class="fas fa-plus-circle"></i><a href="/dinos/create">Add</a></li>
                            <li><i class="fas fa-edit"></i></i><a href="ui-badges.html">Edit</a></li>
                            <li><i class="fas fa-minus"></i></i><a href="ui-social-buttons.html">Remove</a></li>
                        @endif
                    </ul>
                </li>--}}


                <h3 class="menu-title">My Management</h3><!-- /.menu-title -->
                @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>All Tribes</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fas fa-edit"></i><a href="font-fontawesome.html">Edit tribes</a></li>
                        <li><i class="menu-icon far fa-play-circle"></i><a href="font-fontawesome.html">Starter Kits</a></li>
                        <li><i class="menu-icon fas fa-level-up-alt"></i><a href="font-fontawesome.html">Level Kits</a></li>
                        <li><i class="menu-icon fas fa-piggy-bank"></i><a href="font-fontawesome.html">Vault Management</a></li>
                    </ul>
                </li>
                @endif
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-people-carry"></i>My Management</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="/manageMyFunds">My Funds</a></li>
                        <li><i class="fas fa-list-ul"></i><a href="/payFromUserstransactions">Incoming Transactions
                            </a></li>
                        <li><i class="fas fa-list-ul"></i><a href="/payToUserstransactions">Outgoing Transactions
                            </a></li>
                    @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                        @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Admin'))
                        <li><i class="menu-icon fas fa-plus-circle"></i><a href="charts-chartjs.html">Add member</a></li>
                        <li><i class="menu-icon fas fa-minus"></i><a href="charts-flot.html">Delete member</a></li>
                        @endif
                    </ul>
                </li>
                @endif


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->