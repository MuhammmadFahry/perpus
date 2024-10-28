<!-- resources/views/components/sidebar.blade.php -->
<div class="overflow-x-hidden text-white bg-black sidebar" id="sidebar">
    <div class="py-4 sidebar-header">
        <h4>Menu</h4>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <img src="{{ auth()->user()->profile_picture ? asset('img/'. auth()->user()->profile_picture) : asset('img/default-profile.png') }}"
                        alt="Profile" class="rounded-circle" width="30" height="30">
                        <span style="margin-left: 5px">
                            {{ auth()->user()->name }}
                        </span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush">
                            <li>
                                <a class="list-group-item {{ request()->routeIs('profile') ? 'active' : '' }}"
                                    href="{{ route('profile') }}">
                                    <i class="fa-solid fa-user"></i> {{ auth()->user()->name }}
                                </a>
                            </li>
                            <li class="logout">
                                <a class="list-group-item logout">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fa-solid fa-door-open"></i>
                                            Log Out
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="px-3 nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('Home') ? 'active' : '' }}" href="{{ route('Home') }}">
                <i class="fas fa-home me-2"></i> Home
            </a>
        </li>
        @if (auth()->user()->isAdmin)
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.settingcategory') ? 'active' : '' }}" href="{{ route('admin.settingcategory') }}">
                <i class="fas fa-th-large me-2"></i> Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.books') ? 'active' : '' }}" href="{{ route('admin.books') }}">
                <i class="fas fa-book me-2"></i> Buku
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.superadmin') ? 'active' : '' }}" href="{{ route('admin.superadmin') }}">
                <i class="fas fa-user-shield me-2"></i> superadmin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.penalties') ? 'active' : '' }}" href="{{ route('admin.penalties') }}">
                <i class="fas fa-money-bill me-2"></i> Denda
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.borrowHistory') ? 'active' : '' }}" href="{{ route('admin.borrowHistory') }}">
                <i class="fas fa-history me-2"></i> History Peminjaman
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pengembalian') ? 'active' : '' }}" href="{{ route('pengembalian') }}">
                <i class="fas fa-undo-alt me-2"></i> Pengembalian
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('books.borrowed') ? 'active' : '' }}" href="{{ route('books.borrowed') }}">
                <i class="fas fa-book-reader me-2"></i> History Buku yang sedang dipinjam
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('books.history') ? 'active' : '' }}" href="{{ route('books.history') }}">
                <i class="fas fa-book me-2"></i> History Buku yang sudah dikembalikan
            </a>
        </li>
        @endif
    </ul>
</div>
