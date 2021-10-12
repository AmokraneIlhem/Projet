  {{-- {{ @if( request()->route()->getName()==='admin.habilitations.' ){
         $menu ="menu-open"}
          @else{ $menu ="" } }}
         --}}
   <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
        
         
          @can("manager")
              
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Vue globale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-swatchbook"></i>
                  <p>Locations</p>
                </a>
              </li>
            </ul>
        </li>
         @endcan
        
          
         @can("admin")
       
       <li class="nav-item  ">
            <a href="{{ route('dashboard') }}" class="nav-link  {{ setMenuActive('dashboard') }} ">
              <i class="nav-icon fas fa-home"></i>
              <p>
               Accueil 
              </p>
            </a>
          </li>
           <li class="nav-item  {{setMenuClass('admin.habilitations.', 'menu-open')}}">
            <a href="#" class="nav-link  {{ setMenuClass('admin.habilitations.', 'active') }}">
              <i class=" nav-icon fas fa-user-shield "></i>
              <p>
                Habilitations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a
                href="{{ route("admin.habilitations.users.index") }}"
                class="nav-link {{ setMenuActive('admin.habilitations.users.index')}}  "
                >
                  <i class=" nav-icon fas fa-users-cog "></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.gestion.profils') }}"
                class="nav-link  {{ setMenuActive('admin.gestion.profils') }}">
                  <i class="nav-icon fa fa-user-circle" ></i>
                  <p>Profils</p>
                </a>
              </li>
            </ul>
        </li>
        
         <li class="nav-item  ">
            <a href="{{ route('admin.gestion.structures') }}" class="nav-link  {{ setMenuActive('admin.gestion.structures') }}">
              <i class="nav-icon fa fa-sitemap" aria-hidden="true"></i>
              <p>
               Structures
              </p>
            </a>
          </li>
         
          <li class="nav-item  ">
            <a href="{{ route('admin.gestion.fournisseurs') }}" class="nav-link {{ setMenuActive('admin.gestion.fournisseurs') }}">
              <i class="nav-icon fa fa-truck" aria-hidden="true"></i>
              <p>
              Fournisseurs
              </p>
            </a>
          </li>
         
           <li class="nav-item  ">
            <a href="{{ route('admin.gestion.factures') }}" class="nav-link {{ setMenuActive('admin.gestion.factures') }}">
              
              <i class="nav-icon fa fa-file" aria-hidden="true"></i>
              <p>
              Factures
              </p>
            </a>
          </li>
          
        @endcan 
        @can("employe")
         <li class="nav-item  ">
            <a href="{{ route('home') }}" class="nav-link  {{ setMenuActive('home') }} ">
              <i class="nav-icon fas fa-home"></i>
              <p>
               Accueil 
              </p>
            </a>
          </li>
            
<li class="nav-header">Factures</li>
        <li class="nav-item">
            <a href="{{ route('employe.gestion.index')}}" class="nav-link {{ setMenuActive('employe.gestion.index') }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                Gestion factures
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            
        </li>
  
      
 
           <li class="nav-header">Fournisseurs</li>
        <li class="nav-item">
            <a href="" class="nav-link ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Gestion des fournisseurs
                </p>
            </a>
        </li>
        

        
        
        @endcan
        </ul>
      </nav>