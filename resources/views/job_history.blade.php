@extends('layout')

@section('title')
    My Job History
@endsection

@section('content')
    @if (empty($job))
        <h2>Add New Job History</h2>
    @else
        <h2>Editing Job History</h2>
    @endif

    <form method="POST" action="/job_history">
        {{ csrf_field() }}

        @if (!empty($job))
            <input type="hidden" id="id" name="id" value="{{ $job->id ?? 0 }}" />
        @endif


        <div class="form-group">
            <label for="title">Job Title</label>
            <span class="errors">{{ $errors->first('title') }}</span>
            <br />
            <input type="text" class="form-control" id="title" name="title" value="{{ $job->title ?? '' }}">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <span class="errors">{{ $errors->first('start_date') }}</span>
            <br />
            <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $job->start_date ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">End Date</label>
            <span class="errors">{{ $errors->first('end_date') }}</span>
            <br />
            <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $job->end_date ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <span class="errors">{{ $errors->first('description') }}</span>
            <br />
            <textarea id="description" name="description">{{ $job->description ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <br />
            @if (empty($job))
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Create</button>
            @else
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
            @endif
        </div>
    </form>
    <br />
    <h2>My Job History</h2>

    @forelse ($jobHistories as $history)
        <div class="job-history">
            <div class="form-group">
                <b>{{ $history->title  }}</b>
            </div>
            <div class="form-group">
                Start Date: {{ $history->start_date ?? 'N / A' }}<br />
                End Date: {{ $history->end_date ?? 'Currently working there' }}
            </div>
            <div class="form-group">
                <textarea readonly="readonly" style="height: 10rem !important;">{{ $history->description  }}</textarea>
            </div>
            <div class="form-group right">
                <a class="button" href="/job_history?id={{ $history->id ?? 0 }}">Edit</a>
            </div>
        </div>
    @empty
        <p>You have no job history</p>
    @endforelse
@endsection
