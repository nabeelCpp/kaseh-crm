<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3 class="badge-success p-2 text-center">{{ auth()->user()->getRoleNames()[0] }}</h3>
      <ul class="nav side-menu">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        @canany(['user-list', 'user-create', 'user-edit', 'user-delete'])
            <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('user-list')
                        <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                    @endcan
                    @can('user-create')
                        <li><a href="{{ route('users.create') }}">Create User</a></li>
                    @endcan
                </ul>
            </li>

        @endcanany
        @canany(['role-list', 'role-create','role-edit','role-delete'])
            <li><a><i class="fa fa-user"></i>Role <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('role-list')
                        <li><a href="{{ route('roles.index') }}">Manage Roles</a></li>
                    @endcan
                    @can('role-create')
                        <li><a href="{{ route('roles.create') }}">Create Role</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @canany(['customer-list', 'customer-create','customer-edit','customer-delete'])
            <li><a><i class="fa fa-bed"></i>Customers <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('customer-list')
                        <li><a href="{{ route('customers.index') }}">Manage Customers</a></li>
                    @endcan
                    @can('customer-create')
                        <li><a href="{{ route('customers.create') }}">Create Customer</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @canany(['caregiver-list', 'caregiver-create','caregiver-edit','caregiver-delete'])
            <li><a><i class="fa fa-user-md"></i>Caregiver <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('caregiver-list')
                        <li><a href="{{ route('caregivers.index') }}">Manage Caregiver</a></li>
                    @endcan
                    @can('caregiver-create')
                        <li><a href="{{ route('caregivers.create') }}">Create Caregiver</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @canany(['product-list', 'product-create', 'product-edit', 'product-delete'])
            <li><a><i class="fa fa-table"></i> Products <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('product-list')
                        <li><a href="{{ route('products.index') }}">Manage Products</a></li>
                    @endcan
                    @can('product-create')
                        <li><a href="{{ route('products.create') }}">Create Product</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['payslip-list', 'payslip-create', 'payslip-edit', 'payslip-delete'])
            <li>
                <a><i class="fa fa-clone"></i> {{ __('Pay Slips') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('payslip-list')
                        <li><a href="#">{{ __('Manage Pay Slips') }}</a></li>
                    @endcan
                    @can('payslip-create')
                        <li><a href="#">{{ __('Create Pay Slip') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @canany(['quotation-list', 'quotation-create', 'quotation-edit', 'quotation-delete'])
            <li>
                <a><i class="fa fa-windows"></i> {{ __('Quotations') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('quotation-list')
                        <li><a href="#">{{ __('Manage Quotations') }}</a></li>
                    @endcan
                    @can('quotation-create')
                        <li><a href="#">{{ __('Create Quotation') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @canany(['salesorder-list', 'salesorder-create', 'salesorder-edit', 'salesorder-delete'])
            <li>
                <a><i class="fa fa-sitemap"></i> {{ __('Sales Order') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('salesorder-list')
                        <li><a href="#">{{ __('Manage Sales Orders') }}</a></li>
                    @endcan

                    @can('salesorder-create')
                        <li><a href="#">{{ __('Create Sale Order') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @canany(['payments-list', 'payments-create', 'payments-edit', 'payments-delete'])
            <li>
                <a><i class="fa fa-sitemap"></i> {{ __('Payments') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('payments-list')
                        <li><a href="#">{{ __('Manage Payments') }}</a></li>
                    @endcan
                    @can('payments-create')
                        <li><a href="#">{{ __('Create Payment') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @canany(['appointments-list', 'appointments-create', 'appointments-edit', 'appointments-delete'])
            <li>
                <a><i class="fa fa-sitemap"></i> {{ __('Appointments') }} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('appointments-list')
                        <li><a href="#">{{ __('Manage Appointments') }}</a></li>
                    @endcan
                    @can('appointments-create')
                        <li><a href="#">{{ __('Create Appointment') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('scheduling')
            <li>
                <a href="#"><i class="fa fa-sitemap"></i> {{ __('Scheduling') }}</a>
            </li>
        @endcan
        @can('settings')
            <li>
                <a href="#"><i class="fa fa-cogs"></i> {{ __('Settings') }}</a>
            </li>
        @endcan
      </ul>
    </div>

  </div>
