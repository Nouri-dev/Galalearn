<!-- resources/views/partials/navbar.blade.php -->

<div class="main-nav">
    <ul>
        <li><a href="{{ route('home') }}">GALALEARN</a></li>

       
       @foreach($categories as $parentCategory)
        <li>
        <a href="{{ route('categories.show', $parentCategory->name) }}">{{ $parentCategory->name }}</a>
        </li>
    @endforeach 

        
        @auth
            <li>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li><a href="{{ route('mySpace') }}">My Space</a></li>
        @else
            <li><a href="{{ route('login') }}">Se connecter</a></li>  
            <li><a href="{{ route('register') }}">S'inscrire</a></li>
        @endauth
    </ul>
</div>
