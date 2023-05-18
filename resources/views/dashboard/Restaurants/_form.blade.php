<div class="form-group">
    <x-form.input label="title" name="title" :value="$restaurants->title"/>
</div>

<div class="form-group">
    <x-form.textarea label="Description "
                     name="description" :value="$restaurants->description"/>
</div>

<div class="form-group">
    <x-form.input label="country" name="country" :value="$restaurants->country"/>
</div>

<div class="form-group">
    <x-form.input label="city" name="city" :value="$restaurants->city"/>
</div>


<div>
    <label for="">Halal</label>
    <div>
        <div class="form-check">
            <input    style="background-color: #a1a1a1" @class([
        'form-check-input',
        'is-invalid'=> $errors->has('halal')
])  type="radio" name="halal"  value="Yes"
                   @if(old('halal', $restaurants->halal) == 'Yes') checked @endif >
            <label class="form-check-label" for="exampleRadios1">
                Yes
            </label>
        </div>
        <div class="form-check">
            <input   style="background-color: #a1a1a1"  @class([
        'form-check-input',
        'is-invalid'=> $errors->has('halal')
]) type="radio" name="halal"  value="No"
                    @if(old('halal', $restaurants->halal) == 'No') checked @endif>
            <label class="form-check-label" for="exampleRadios2">
                No
            </label>

        </div>
        @error('halal')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>


<div class="form-group">
    <x-form.input label="geo_location" name="geo_location" :value="$restaurants->geo_location"/>
</div>
<div class="form-group">
    <x-form.input label="longitude" name="longitude" :value="$restaurants->longitude"/>
</div>
<div class="form-group">
    <x-form.input label="latitude" name="latitude" :value="$restaurants->latitude"/>
</div>

<div class="form-group">
    <x-form.input label="owner" name="owner" :value="$restaurants->owner"/>
</div>
<div class="form-group">
    <x-form.textarea label="source link URL "
                     name="owner_source_link" :value="$restaurants->owner_source_link"/>
</div>


<div class="form-group">
    <x-form.input label=" featured_image  " name="featured_image" type="file" :value="$restaurants->featured_image"
                  accept="image/*"/>
    @if($restaurants->featured_image)
        <img src="{{asset($restaurants->featured_image)}}" alt="not" height="70">
    @endif
    <br>
</div>

<div class="form-group">
    <x-form.input label="Background Image" name="gallery[]" type="file" accept="image/*" multiple/>
    @if($restaurants->gallery)
        @php
            $images = is_array($restaurants->gallery) ? $restaurants->gallery : explode(',', $restaurants->gallery);
        @endphp
        @foreach($images as $image)
            <img src="{{ asset($image) }}" alt="not" height="70">
        @endforeach
    @endif
    <br>
</div>


<br><br>
<div>
    <button type="submit" class="btn btn-outline-primary">{{$button_label ??'Save'}}</button>
</div>
