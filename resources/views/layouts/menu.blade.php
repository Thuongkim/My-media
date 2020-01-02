<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('links*') ? 'active' : '' }}">
    <a href="{{ route('links.index') }}"><i class="fa fa-edit"></i><span>Links</span></a>
</li>

<li class="{{ Request::is('images*') ? 'active' : '' }}">
    <a href="{{ route('images.index') }}"><i class="fa fa-edit"></i><span>Images</span></a>
</li>

<li class="{{ Request::is('avatars*') ? 'active' : '' }}">
    <a href="{{ route('avatars.index') }}"><i class="fa fa-edit"></i><span>Avatars</span></a>
</li>

<li class="{{ Request::is('gitUsers*') ? 'active' : '' }}">
    <a href="{{ route('gitUsers.index') }}"><i class="fa fa-edit"></i><span>Git Users</span></a>
</li>

<li class="{{ Request::is('texts*') ? 'active' : '' }}">
    <a href="{{ route('texts.index') }}"><i class="fa fa-edit"></i><span>Texts</span></a>
</li>

