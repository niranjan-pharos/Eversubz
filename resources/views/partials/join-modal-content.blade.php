@if($joinedNgo)
    <p>You are already joined with another NGO. Do you want to leave and join {{ $ngo->ngo_name }} instead?</p>
@else
    <p>Do you want to join {{ $ngo->ngo_name }}?</p>
@endif

<form id="joinForm" action="{{ route('user.join') }}" method="POST">
    @csrf
    <input type="hidden" name="ngo_id" value="{{ $ngo->id }}">
    
    <div class="flex justify-center">
        @if($joinedNgo)
            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Switch NGO</button>
        @else
            <button type="submit" class="bg-primary text-white py-2 px-4 rounded">Join</button>
        @endif
    </div>
</form>