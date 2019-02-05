<form  method="POST" enctype="multipart/form-data" action="{{ $action }}"  class="form" role="form" autocomplete="off">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif

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
            <input type="password" class="form-control" placeholder="Password" name="password">
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
            <label>Role</label>
            <select class="form-control select2" style="width: 100%;" name="role">
                <option value="{{ App\Helpers\Constant::STUDENT }}" @if($user->role === App\Helpers\Constant::STUDENT) selected @endif>
                    {{ ucwords(App\Helpers\Constant::STUDENT) }}
                </option>
                <option value="{{ App\Helpers\Constant::ADMIN }}" @if($user->role === App\Helpers\Constant::ADMIN) selected @endif @if(!$user->role) disabled @endif>
                    {{ ucwords(App\Helpers\Constant::ADMIN) }}
                </option>
            </select>
            @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
        </div>

        @if ($method === 'POST')
            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label>Avatar</label>
                <input type="file" name="avatar" accept="image/*">
                @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
    </div>
</form>
