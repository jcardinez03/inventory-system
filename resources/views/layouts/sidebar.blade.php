<div class="sidebar bg-dark text-white" style="height: 100vh; overflow: auto">
    <div class="logo">
        <div class="row gx-0">
            <div class="col-2 align-middle mt-3">
                <i class="fa-solid fa-cube display-5 ms-3"></i> 
            </div>
            <div class="col-10">
                <h1 class="ms-5">{{ config('app.name') }}</h1>
                <p class="small ms-5">Management System</p>
            </div>
        </div>
     
    </div>

    <hr style="margin-top: 0">

    <ul class="menu navbar-nav" style="margin-left: 10%">
        <li class="nav-item h4">
            <a href="#" class="nav-link">
                <i class="far fa-house"></i> Dashboard
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="{{ route('product.index') }}" class="nav-link">
                <i class="fas fa-cube"></i> Products
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="{{ route('category.index') }}" class="nav-link">
                <i class="fa-regular fa-folder"></i> Categories
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="{{ route('stocklog.index', 'all') }}" class="nav-link">
                <i class="fa-solid fa-arrow-trend-up"></i> Stock Logs
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="" class="nav-link">
                <i class="fa-solid fa-dolly"></i> Sales
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="" class="nav-link">
                <i class="fa-solid fa-chart-simple"></i> Reports
            </a>
        </li>
        <li class="nav-item  h4">
            <a href="" class="nav-link">
                <i class="fa-regular fa-truck"></i> Suppliers
            </a>
        </li><li class="nav-item  h4">
            <a href="" class="nav-link">
                <i class="fa-solid fa-users"></i> Users
            </a>
        </li>

        
    </ul>
</div>