<form  method="POST" enctype="multipart/form-data" action="{{ $action }}"  class="form" role="form" autocomplete="off">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Full Name</label>
            <input type="text" class="form-control" placeholder="Enter Full Name" value="{{ old('name') ?? $author->name }}" name="name" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('birth') ? 'has-error' : '' }}">
            <label>Birth Date</label>
            <input type="integer" class="form-control" placeholder="Enter Author's DOB" value="{{ old('birth') ?? $author->birth }}" name="birth" required>
            @if ($errors->has('birth'))
                <span class="help-block">
                    <strong>{{ $errors->first('birth') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('death') ? 'has-error' : '' }}">
            <label>Date of Demise</label>
            <input type="integer" class="form-control" placeholder="Enter Author's DOD" value="{{ old('death') ?? $author->death }}" name="death" required>
            @if ($errors->has('death'))
                <span class="help-block">
                    <strong>{{ $errors->first('death') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Categories</label>
            <div>
                <select  name='category_id[]' multiple class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id, $author->categories->pluck('id')->toArray())) selected @endif >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
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

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label>Author Description</label>
            <textarea class="form-control" rows="9" placeholder="Enter Author's Description" name="description" required>{{ old('description') ?? $author->description }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
    </div>
</form>
