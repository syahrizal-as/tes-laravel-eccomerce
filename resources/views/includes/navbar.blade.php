<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
     <div class="container-fluid">
       <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
         <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
           <i class="bx bx-menu bx-sm"></i>
         </a>
       </div>

       <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
         <!-- Search -->
         <div class="navbar-nav align-items-center">
           <div class="nav-item navbar-search-wrapper mb-0">
             <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
               {{-- <i class="bx bx-search-alt bx-sm"></i> --}}
               {{-- <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span> --}}
             </a>
           </div>
         </div>
         <!-- /Search -->

         <ul class="navbar-nav flex-row align-items-center ms-auto">
           <!-- Language -->
         

           <!-- Style Switcher -->
           <li class="nav-item me-2 me-xl-0">
             <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
               <i class="bx bx-sm"></i>
             </a>
           </li>
           <!--/ Style Switcher -->

          

      

           <!-- User -->
           <li class="nav-item navbar-dropdown dropdown-user dropdown">
             <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
               <div class="avatar avatar-online">
                 <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt class="rounded-circle" />
               </div>
             </a>
             <ul class="dropdown-menu dropdown-menu-end">
             
               <li>
                 <a class="dropdown-item"href="{{ __('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bx bx-power-off me-2"></i>
                   <span class="align-middle">Log Out</span>
                 </a>
                 @role('aqiqah')
                 <a class="dropdown-item"href="javascript:;void(0)" onclick="AqiqahChange()">
                  <i class="bx bx-power-on me-2"></i>
                  <span class="align-middle">Ganti Aqiqah</span>
                </a>
                 @endrole
                 <form method="POST" id="logout-form" action="{{ url('logout') }}">
                  <?php echo csrf_field(); ?>
                </form>
                <?php ?>
               </li>
             </ul>
           </li>
           <!--/ User -->
         </ul>
       </div>

       <!-- Search Small Screens -->
       <div class="navbar-search-wrapper search-input-wrapper d-none">
         <input
           type="text"
           class="form-control search-input container-fluid border-0"
           placeholder="Search..."
           aria-label="Search..." />
         <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
       </div>
     </div>
   </nav>
