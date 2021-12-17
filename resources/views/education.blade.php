@extends('layout')

@section('title')
    My Education History
@endsection

@section('content')
    @if (empty($education))
        <h2>Add Education History</h2>
    @else
        <h2>Editing Education History</h2>
    @endif

    <form method="POST" action="/education">
        {{ csrf_field() }}

        @if (!empty($education))
            <input type="hidden" id="id" name="id" value="{{ $education->id ?? 0 }}" />
        @endif


        <div class="form-group">
            <label for="title">School</label>
            <span class="errors">{{ $errors->first('title') }}</span>
            <br />
            <input type="text" class="form-control" id="title" name="title" value="{{ $education->title ?? '' }}">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <span class="errors">{{ $errors->first('start_date') }}</span>
            <br />
            <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $education->start_date ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">End Date</label>
            <span class="errors">{{ $errors->first('end_date') }}</span>
            <br />
            <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $education->end_date ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">About School</label>
            <span class="errors">{{ $errors->first('description') }}</span>
            <br />
            <textarea id="description" name="description">{{ $education->description ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <br />
            @if (empty($education))
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Create</button>
            @else
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
            @endif
        </div>
    </form>
    <br />
    <h2>My Education History</h2>

    @forelse ($educationHistories as $history)
        <div class="education-history">
            <div class="form-group">
                <b>{{ $history->title ?? ''  }}</b>
            </div>
            <div class="form-group">
                <b>Start Date</b>: {{ $history->start_date ?? 'N / A' }}<br />
                <b>End Date</b>: {{ $history->end_date ?? 'Currently working there' }}
            </div>
            <div class="form-group">
                <b>About</b>: <br />
                <textarea readonly="readonly" style="height: 10rem !important;">{{ $history->description  }}</textarea>
            </div>
            <div class="form-group right">
                <a class="button" href="/education?id={{ $history->id ?? 0 }}">Edit</a>
            </div>
        </div>
    @empty
        <p>You have no education history</p>
    @endforelse
@endsection
