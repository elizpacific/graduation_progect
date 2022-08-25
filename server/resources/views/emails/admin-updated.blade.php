Admin {{ $admin->firstname }} {{ $admin->lastname }}
@if(!$admin->wasChanged('email'))
    wasn't updated!
@else
    was updated!
@endif
