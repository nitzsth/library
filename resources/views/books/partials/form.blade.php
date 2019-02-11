<form  method="POST" enctype="multipart/form-data" action="{{ $action }}"  class="form" role="form" autocomplete="off">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Book Name</label>
            <input type="text" class="form-control" placeholder="Enter Book Name" value="{{ old('name') ?? $book->name }}" name="name" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('isbn') ? 'has-error' : '' }}">
            <label>Book ISBN</label>
            <input type="text" class="form-control" placeholder="Enter ISBN" value="{{ old('isbn') ?? $book->isbn }}" name="isbn" required>
            @if ($errors->has('isbn'))
                <span class="help-block">
                    <strong>{{ $errors->first('isbn') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>Book Author(s)</label>
            <div>
                <select  name='author_id[]' multiple class="form-control">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" @if(in_array($author->id, $book->authors->pluck('id')->toArray())) selected @endif >
                            {{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Categories</label>
            <div>
                <select  name='category_id[]' multiple class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id, $book->categories->pluck('id')->toArray())) selected @endif >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group {{ $errors->has('pages') ? 'has-error' : '' }}">
            <label>Number of Pages</label>
            <input type="integer" class="form-control" placeholder="Isbn" name="pages" value="{{ old('pages') ?? $book->pages }}" required>
            @if ($errors->has('pages'))
                <span class="help-block">
                    <strong>{{ $errors->first('pages') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('edition') ? 'has-error' : '' }}">
            <label>Edition</label>
            <input type="text" class="form-control" placeholder="Edition" name="edition" value="{{ old('edition') ?? $book->edition }}" required>
            @if ($errors->has('edition'))
                <span class="help-block">
                    <strong>{{ $errors->first('edition') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('publisher') ? 'has-error' : '' }}">
            <label>Publisher</label>
            <input type="text" class="form-control" placeholder="Publisher" name="publisher" value="{{ old('publisher') ?? $book->publisher }}" required>
            @if ($errors->has('publisher'))
                <span class="help-block">
                    <strong>{{ $errors->first('publisher') }}</strong>
                </span>
            @endif
        </div>

        @if ($method === 'POST')
            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label>Book Cover</label>
                <input type="file" name="avatar" accept="image/*">
                @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label>Book Description</label>
            <textarea class="form-control" rows="7" placeholder="Enter Book's nice description" name="description" required>{{ old('description') ?? $book->description }}</textarea>
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
