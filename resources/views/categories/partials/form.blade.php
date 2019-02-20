<form method="POST"
      action="{{ $action }}"
      class="form"
      role="form"
      autocomplete="off">
  @csrf
  @if($method === 'PUT')
    @method('PUT')
  @endif

  <div class="box-body">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
      <label>Category Name</label>
      <input type="text"
             class="form-control"
             placeholder="Enter Category Name"
             value="{{ old('name') ?? $category->name }}"
             name="name"
             required>
      @if ($errors->has('name'))
        <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
      @endif
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="submit">Submit
      </button>
    </div>
  </div>
</form>
