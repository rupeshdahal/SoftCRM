
<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a class="active-menu" href="#"><i class="fa fa-dashboard"></i>System<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('/') }}">Dashboard</a>
                        <a href="{{ route('settings') }}">Settings</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i>Dependencies<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('clients') }}">Clients<span class="label label-dependencies pull-right" style="margin-top:4px;">{{ \App\Client::countClients() ? : 0 }}</span></a>
                        <a href="{{ route('employees') }}">Employees<span class="label label-dependencies pull-right" style="margin-top:4px">{{ \App\Employees::countEmployees() ? : 0 }}</span></a>
                        <a href="{{ route('contacts') }}">Contacts<span class="label label-dependencies pull-right" style="margin-top:4px">{{ \App\Contacts::countContacts() ? : 0 }}</span></a>
                        <a href="{{ route('deals') }}">Deals<span class="label label-dependencies pull-right" style="margin-top:4px">{{ \App\Deals::countDeals() ? : 0 }}</span></a>
                        <a href="{{ route('companies') }}">Companies<span class="label label-dependencies pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i>Marketing<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('products') }}">Products<span class="label label-marketing pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                        <a href="{{ route('tasks') }}">Tasks<span class="label label-marketing pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                        <a href="{{ route('products') }}">Projects<span class="label label-marketing pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> Sales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('invoices') }}">Invoices<span class="label label-sales pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                        <a href="{{ route('finances') }}">Finances<span class="label label-sales pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                        <a href="{{ route('sales') }}">Sales<span class="label label-sales pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('mailing') }}"><i class="fa fa-file-text"></i>Mailing<span class="label label-mailing pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
            </li>
            <li>
                <a href="{{ route('reports') }}"><i class="fa fa-file-text"></i>Reports<span class="label label-reports pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
            </li>
            <li>
                <a href="{{ route('files') }}"><i class="fa fa-folder-open"></i>Files<span class="label label-files pull-right" style="margin-top:4px">{{ \App\Companies::countCompanies() ? : 0 }}</span></a>
            </li>
        </ul>

    </div>

</nav>
