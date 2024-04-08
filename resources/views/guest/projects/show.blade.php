@extends('layouts.app')

@section('title', "Project's detail'")

@section('content')
    <section>
        <div class="container py-4">
            <div class="row justify-content-between align-items-center">
                <h1 class="mb-3 col-6">{{ $project->title }}</h1>
                <div class="col-2 text-end">
                    <a class="btn btn-primary" href="{{ route('projects.index')}}">Back to projects' list</a>
                </div>
            </div>
            <div class="mb-3">
                <span class="h5 ms-2"><b>Type:</b></span>
                @if ($project->type_id)
                    @guest
                        {!! $project->type->getBadge() !!}
                    @endguest
                    @auth
                        <a href="{{ route('admin.types.show', $project->type) }}">{!! $project->type->getBadge() !!}</a>
                    @endauth
                @else 
                    None
                @endif 
            </div>
            <h5><b>Description</b></h5>
            <p>{{ $project->description }}</p>                        

            <div class="row">

                <div class="col-6">
                    <p>
                        <b>Link: </b>
                        <a href="{{ $project->github_link }}"> {{ $project->github_link }}</a>
                    </p>
                </div>

                <div class="col-6">
                    <p><b>Repo: </b>{{ $project->repository }}</p>
                </div>
                
                <div class="col-6">
                    <p><b>Creation's date: </b>{{ $project->creation_date }}</p>
                </div>
                <div class="col-6">
                    <p><b>Last commit's date: </b>{{ $project->last_commit }}</p>
                </div>

                @auth
                <div class="col-12">
                    <a class="btn btn-primary ms-2" href="{{ route('admin.projects.edit', $project) }}">Modify this project</a>
                    <form class="d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" id='delete-btn'>Delete this project</button>
                    </form>
                </div>
                <div class="col-12">
                @endauth
                    
                </div>
                    
            </div>
        </div>
    </section>
@endsection

@section('css')
    <style>
        img {
            width: 100%;
        }
    </style>
@endsection

@section('js')
    <script>
        const deleteBtn = document.querySelector('#delete-btn');
        if(deleteBtn) {
            deleteBtn.addEventListener('click', function (e) {
    
                if (!confirm(
`The delete action is not reversible.
Are you sure that you want to remove this project from the list?`
                )) {
                    e.preventDefault();
                } 
            });
        }
    </script>
@endsection