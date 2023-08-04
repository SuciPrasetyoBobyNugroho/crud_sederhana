@extends('layout.template')

@section('content')
 

<form action='{{ url('rumahsakit') }}' method='post'>
    @csrf 
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url('rumahsakit')}}" class="btn btn-danger"> << BACK </a>
        <div class="mb-3 row">
            <label for="mother_name" class="col-sm-2 col-form-label">Mother name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='mother_name' value="{{Session::get('mother_name')}}" id="mother_name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="mother_age" class="col-sm-2 col-form-label">Mother age</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='mother_age' value="{{Session::get('mother_age')}}" id="mother_age">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Infant gender</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="infant_gender" id="male" value="Male" {{ Session::get('infant_gender') === 'Male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="infant_gender" id="female" value="Female" {{ Session::get('infant_gender') === 'Female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="infant_birth_datetime" class="col-sm-2 col-form-label">Infant birth date and time</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" name='infant_birth_datetime' value="{{Session::get('infant_birth_datetime')}}" id="infant_birth_datetime">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="gestational_age_weeks" class="col-sm-2 col-form-label">Gestational Age (in weeks)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='gestational_age_weeks' value="{{Session::get('gestational_age_weeks')}}" id="gestational_age_weeks">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="height_cm" class="col-sm-2 col-form-label">Height (cm)</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='height_cm' value="{{Session::get('height_cm')}}" id="height_cm">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="weight_kg" class="col-sm-2 col-form-label">Weight (kg)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='weight_kg' value="{{ Session::get('weight_kg') ? number_format(floatval(Session::get('weight_kg')), 1, ',', '') : '' }}" id="weight_kg">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control" name='description' id="description" rows="5"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
        </div>
</form>
</div>
@endsection
