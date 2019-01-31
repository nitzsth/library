<form  method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}"  class="form" role="form" autocomplete="off">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Full Name</label>
            <input type="text" class="form-control" placeholder="Enter Full Name" value="{{ old('name') ?? $user->name }}" name="name" required>
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label>Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" value="{{ old('email') ?? $user->email }}" name="email" required>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label>Avatar</label>
            <input type="file" name="avatar" accept="image/*">
            @if ($errors->has('avatar'))
            <span class="help-block">
                <strong>{{ $errors->first('avatar') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>

    </div>
</form>