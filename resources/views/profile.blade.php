@extends('layout')

@section('title')
    My Profile
@endsection

@section('content')
    <h2>My Profile</h2>
    <form method="POST" action="/profile">
        {{ csrf_field() }}

        <!-- if there are login errors, show them here -->
        <div class="form-group">
            <label for="title">Profile Title</label>
            <span class="errors">{{ $errors->first('title') }}</span>
            <br />
            <input type="text" class="form-control" id="title" name="title" value="{{ $profile->title ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">Profile Description</label>
            <span class="errors">{{ $errors->first('description') }}</span>
            <br />
            <textarea id="description" name="description">{{ $profile->description ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="skills">Skills</label>
            <input type="hidden" name="skills" id="skills" value="{{ $profile->skills ?? '[]' }}" />
            <div id="skills-div"></div>
        </div>


        <div class="form-group">
            <input class="form-control" type="text" id="skills-new" />
            <br />
            <input id="add-button" type="button" value="Add" />
        </div>

        <div class="form-group">
            <br />
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <script>
        let skills = [];

        function renderSkills() {
            let skillsHtml = '';
            skills.forEach(function(skill) {
                skillsHtml += '<span class="skill">' + skill + '</span>';
            });

            $('#skills-div').html(skillsHtml);

            $('.skill').click(function () {
                const index = skills.findIndex((a) => a === $(this).html());
                if (index >= 0) {
                    skills.splice(index, 1);
                    renderSkills();
                }
            });
        }

        $(function() {
            try {
                skills =  JSON.parse($('#skills').val());
            } catch (e) {
                // fail silently for now
                skills = [];
            }
            renderSkills();
        });

        $('#add-button').click(function() {
           const skill = $('#skills-new').val();
           // it's not an empty string and not already in the list
           if (skill && !skills.includes(skill)) {
               skills.push(skill);
               $('#skills-new').val('');
               $('#skills').val(JSON.stringify(skills));
           }
           renderSkills();
        });
    </script>
@endsection
