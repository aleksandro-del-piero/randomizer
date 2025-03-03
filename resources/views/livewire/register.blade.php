<main class="form-signin w-100 m-auto">
    @if($error)<div class="alert alert-danger">{{ $error }}</div>@endif
    <form>
        <h1 class="h3 mb-3 fw-normal mb-2" >Please sign in</h1>
        <div class="form-floating mb-2">
            <input wire:model="name" class="form-control" id="userName" placeholder="User name">
            <label for="userName">User name</label>
            <div>@error('name') {{ $message }} @enderror</div>
        </div>
        <div class="form-floating mb-2">
            <input wire:model="phone" class="form-control" id="phoneNumber" placeholder="Phone number">
            <label for="phoneNumber">Phone number</label>
            <div>@error('phone') {{ $message }} @enderror</div>
        </div>
        <button class="btn btn-primary w-100 py-2" type="button" wire:click="register">Register</button>
    </form>
</main>
