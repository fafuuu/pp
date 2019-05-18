
<div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                    <span>Menü</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                      <span data-feather="plus-circle"></span>
                    </a>
                  </h6>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="/home">
                    <span data-feather="home"></span>
                    Aktivität <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/home/notifications">
                    <span data-feather="file"></span>
                    Benachrichtigungen 
                  <span class="badge badge-primary"> <i class="fas fa-bell"></i> {{count(Auth::user()->notifications()->get())}} </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/home/settings">
                    <span data-feather="shopping-cart"></span>
                    Einstellungen <i class="fas fa-cog"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/home/statistics">
                    <span data-feather="users"></span>
                    Statistik <i class="fas fa-chart-line"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/home/watchlist">
                    <span data-feather="bar-chart-2"></span>
                    Watchlist <i class="far fa-eye"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/messages">
                    <span data-feather="layers"></span>
                    Chats
                  </a>
                </li>
              </ul>
            </div>
          </nav>
