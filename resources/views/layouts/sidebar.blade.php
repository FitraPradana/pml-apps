<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @if (Auth::user()->roles == 'admin')
                            <li><a class="{{ request()->is('home_admin') ? 'active' : '' }}"
                                    href="{{ url('home_admin') }}">Admin Dashboard</a></li>
                        @elseif (Auth::user()->roles == 'owner')
                            <li><a class="{{ request()->is('home_owner') ? 'active' : '' }}"
                                    href="{{ url('home_owner') }}">Owner Dashboard</a></li>
                        @elseif (Auth::user()->roles == 'manager')
                            <li><a class="{{ request()->is('home_manager') ? 'active' : '' }}"
                                    href="{{ url('home_manager') }}">Manager Dashboard</a></li>
                        @elseif (Auth::user()->roles == 'user')
                            <li><a class="{{ request()->is('home_user') ? 'active' : '' }}"
                                    href="{{ url('home_user') }}">User Dashboard</a></li>
                        @elseif (Auth::user()->roles == 'vessel')
                            <li><a class="{{ request()->is('home_crew') ? 'active' : '' }}"
                                    href="{{ url('home_crew') }}">Crew Dashboard</a></li>
                        @elseif (Auth::user()->roles == 'admin' or Auth::user()->email == 'nina.hasniken@pml.co.id')
                            <li><a class="{{ request()->is('recruitment_crew_form_regist') ? 'active' : '' }}"
                                    href="{{ url('recruitment_crew_form_regist') }}">Applicant Dashboard</a></li>
                        @endif
                        <li><a class="{{ request()->is('recruitment_crew_form_regist') ? 'active' : '' }}"
                                href="{{ url('recruitment_crew_form_regist') }}">Applicant Dashboard</a></li>
                        {{-- <li><a class="{{ request()->is('home_crew') ? 'active' : '' }}" href="{{ url('home_crew') }}">Crew Dashboard</a></li> --}}
                    </ul>
                </li>
                @if (Auth::user()->roles == 'admin')
                    <li class="submenu">
                        <a href="#"><i class="la la-cube"></i> <span> Apps</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('scan_form') ? 'active' : '' }}"
                                    href="{{ url('scan_form') }}">Scan QR CODE</a>
                            </li>
                            {{-- <li><a class="{{ request()->is('scan_vessel') ? 'active' : '' }}"
                                    href="{{ url('scan') }}">Scan</a>
                            </li> --}}
                            {{-- <li><a class="{{ request()->is('barcode') ? 'active' : '' }}"
                                    href="{{ url('barcode') }}">Barcode</a></li> --}}
                            {{-- <li><a href="#">Contacts</a></li> --}}
                            {{-- <li><a href="#">File Manager</a></li> --}}
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->roles == 'admin')
                    <li class="submenu">
                        <a href="#"><i class="las la-tools"></i> <span> Configuration</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ url('asset_category') }}"> Asset Category</a></li>
                            <li><a href="{{ url('rooms') }}">
                                    Room</a></li>
                            <li><a href="{{ url('vessels_stg_index') }}"> Staging Vessel </a></li>
                            <li><a href="{{ url('sites_stg_index') }}"> Staging Site </a></li>
                            <li><a href="{{ url('locations') }}">
                                    Location </a></li>
                            <li><a href="{{ url('fixed_assets_stg_index') }}"> Staging Assets </a></li>

                        </ul>
                    </li>
                @endif
                @if (Auth::user()->roles == 'vessel')
                    <li class="{{ request()->is('scan') ? 'active' : '' }}">
                        <a href="{{ url('scan_form') }}"><i class="la la-qrcode"></i> <span>Scan
                                QR Code</span></a>
                    </li>
                    {{-- <li class="{{ request()->is('scan') ? 'active' : '' }}"> --}}
                    {{-- <a href="{{ url('crew_report_data') }}"><i class="la la-book"></i> <span>Report Asset
                                Vessel</span></a> --}}
                    {{-- <a href="{{ url('print_stock_take') }}"><i class="las la-print"></i> <span>Print Asset</span></a> --}}
                    {{-- <a class="{{ request()->is('cek_api') ? 'active' : '' }}" href="{{ url('cek_api') }}"><i class="las la-link"></i> <span>Cek API</span> </a> --}}
                    {{-- </li> --}}
                @endif
                {{-- <li>
                    <a class="{{ request()->is('barcode') ? 'active' : '' }}" href="{{ url('barcode') }}"><i class="la la-ticket"></i> <span>Barcode</span></a>
                </li> --}}

                {{-- <li>
                    <a href="{{ url('barcode') }}"><i class="la la-ticket"></i> <span>Barcode</span></a>
                </li> --}}
                @if (Auth::user()->roles == 'admin')
                    <li class="menu-title">
                        <span>ERP Controller</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-server"></i> <span> Staging From ERP </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('employees_stg_index') ? 'active' : '' }}"
                                    href="{{ url('employees_stg_index') }}"> Staging Employee </a></li>
                            {{-- <li><a class="{{ request()->is('customers_stg_index') ? 'active' : '' }}"
                                    href="{{ url('customers_stg_index') }}"> Staging Customer </a></li> --}}
                            <li><a class="{{ request()->is('vendors_stg_index') ? 'active' : '' }}"
                                    href="{{ url('vendors_stg_index') }}"> Staging Vendor </a></li>
                            <li><a class="{{ request()->is('vessels_stg_index') ? 'active' : '' }}"
                                    href="{{ url('vessels_stg_index') }}"> Staging Vessel </a></li>
                            <li><a class="{{ request()->is('sites_stg_index') ? 'active' : '' }}"
                                    href="{{ url('sites_stg_index') }}"> Staging Site </a></li>
                            <li><a class="{{ request()->is('fixed_assets_stg_index') ? 'active' : '' }}"
                                    href="{{ url('fixed_assets_stg_index') }}"> Staging Fixed Assets </a></li>
                            <li><a class="{{ request()->is('doc_stg_index') ? 'active' : '' }}"
                                    href="{{ url('doc_stg_index') }}"> Staging Document </a></li>
                        </ul>
                    </li>
                @endif



                @if (Auth::user()->roles == 'admin')
                    <li class="menu-title">
                        <span>Master Administration</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-user-circle"></i> <span> Employees </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('employees') ? 'active' : '' }}"
                                    href="{{ url('employees') }}"> All Employees </a></li>
                            <li><a class="{{ request()->is('department') ? 'active' : '' }}"
                                    href="{{ url('department') }}"> Departments </a></li>
                            <li><a class="{{ request()->is('position') ? 'active' : '' }}"
                                    href="{{ url('position') }}"> Positions </a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                    <a href="#"><i class="las la-users"></i> <span> Customer </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="" href=""> Customer </a></li>
                    </ul>
                </li> --}}
                    <li class="submenu">
                        <a href="#"><i class="las la-user-friends"></i> <span> Vendor </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('vendors') ? 'active' : '' }}" href="{{ url('vendors') }}">
                                    Vendor </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-ship"></i> <span> Vessel </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('vessels') ? 'active' : '' }}" href="{{ url('vessels') }}">
                                    Vessel </a></li>
                            <li><a class="{{ request()->is('settype_tugbarge') ? 'active' : '' }}"
                                    href="{{ url('settype_tugbarge') }}">
                                    Set Pair </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-anchor"></i> <span> Site </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('sites') ? 'active' : '' }}" href="{{ url('sites') }}">
                                    Site
                                </a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-hotel"></i> <span> Room </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('rooms') ? 'active' : '' }}" href="{{ url('rooms') }}">
                                    Room
                                </a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="las la-map-marked"></i> <span> Location </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('locations') ? 'active' : '' }}"
                                    href="{{ url('locations') }}">
                                    Location </a></li>

                        </ul>
                    </li>
                    <li class="{{ request()->is('users') ? 'active' : '' }}">
                        <a href="{{ url('users') }}"><i class="la la-user-plus"></i> <span>Users</span></a>
                    </li>
                @endif

                {{-- FIXED ASSETS --}}

                <li class="menu-title">
                    <span>Fixed Assets</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-object-ungroup"></i> <span> Fixed Assets </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        @if (Auth::user()->roles == 'admin')
                            <li><a class="{{ request()->is('asset_category') ? 'active' : '' }}"
                                    href="{{ url('asset_category') }}"> Asset Category</a></li>
                            <li><a class="{{ request()->is('map_ast_cat_view') ? 'active' : '' }}"
                                    href="{{ url('map_ast_cat_view') }}"> Mapping Asset Category</a></li>
                        @endif
                        @if (Auth::user()->roles == 'admin' or Auth::user()->roles == 'user' or Auth::user()->roles == 'vessel')
                            <li><a class="{{ request()->is('fixed_assets') ? 'active' : '' }}"
                                    href="{{ url('fixed_assets') }}"> Fixed Assets </a></li>
                            <li><a class="{{ request()->is('stock_takes') ? 'active' : '' }}"
                                    href="{{ url('stock_takes') }}"> BA Assets / Stock Take </a></li>
                            <li><a class="{{ request()->is('log_trans_asset_view') ? 'active' : '' }}"
                                    href="{{ url('log_trans_asset_view') }}"> Log Trans Fixed Assets </a></li>
                        @endif
                        @if (Auth::user()->roles == 'admin')
                            <li><a class="{{ request()->is('form_asset_view') ? 'active' : '' }}"
                                    href="{{ url('form_asset_view') }}"> Form Vessel</a></li>
                            <li><a class="{{ request()->is('scan_vessels') ? 'active' : '' }}"
                                    href="{{ url('scan_vessels') }}">Report
                                    Vessel</a>
                        @endif
                    </ul>
                </li>
                {{-- END FIXED ASSETS --}}

                {{-- FILLING DOCUMENT --}}
                @if (Auth::user()->roles == 'admin' or Auth::user()->roles == 'user')
                    <li class="menu-title">
                        <span>Filling Document</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-file-text"></i> <span> Filling Document </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('documents') ? 'active' : '' }}"
                                    href="{{ url('documents') }}"> Document </a></li>
                            <li><a class="{{ request()->is('pengajuan_pinjamans') ? 'active' : '' }}"
                                    href="{{ url('pengajuan_pinjamans') }}"> Pengajuan Pinjaman </a></li>
                            <li><a class="{{ request()->is('pinjamans') ? 'active' : '' }}"
                                    href="{{ url('pinjamans') }}"> Peminjaman </a></li>
                            <li><a class="{{ request()->is('pengembalians') ? 'active' : '' }}"
                                    href="{{ url('pengembalians') }}"> Pengembalian </a></li>

                        </ul>
                    </li>
                @endif
                {{-- END FILLING DOCUMENT --}}
                @if (Auth::user()->roles == 'admin' or Auth::user()->roles == 'user' or Auth::user()->roles == 'vessel')
                    <li class="menu-title">
                        <span>Pages</span>
                    </li>
                    @if (Auth::user()->personnel_number != 'administrator' and Auth::user()->personnel_number != 'admin')
                        <li class="{{ request()->is('profiles') ? 'active' : '' }}">
                            <a href="{{ url('profiles') }}"><i class="la la-user"></i> <span>Profile</span></a>
                        </li>
                    @endif
                    <li>
                        <a href="#"><i class="la la-cog"></i> <span>Settings</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-key"></i> <span> Authentication </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->is('change_password_view') ? 'active' : '' }}"
                                    href="{{ url('change_password_view') }}"> Ganti Password </a></li>
                        </ul>
                    </li>
                @endif

                {{-- @if (Auth::user()->roles == 'admin')
                    <li>
                        <a href="#"><i class="la la-cog"></i> <span>Settings</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-key"></i> <span> Authentication </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="#"> Login </a></li>
                            <li><a href="#"> Register </a></li>
                            <li><a href="#"> Forgot Password </a></li>
                            <li><a href="#"> OTP </a></li>
                            <li><a href="#"> Lock Screen </a></li>
                        </ul>
                    </li>
                @endif --}}

            </ul>
        </div>
    </div>
</div>
