<div class="form-group">
    <x-form.input label="title" name="title" :value="$properties->title"/>
</div>

<div class="form-group">
    <x-form.textarea label="Description "
                     name="description" :value="$properties->description"/>
</div>
<div class="form-group">
    <x-form.textarea label="Notes "
                     name="notes_for_things_to_do" :value="$properties->notes_for_things_to_do"/>
</div>
<div class="form-group">
    <x-form.input label="country" name="country" :value="$properties->country"/>
</div>
<div class="form-group">
    <x-form.input label="city" name="city" :value="$properties->city"/>
</div>
<div class="form-group">
    <x-form.input label="child_entry_price_from" name="child_entry_price_from" type="number"
                  :value="$properties->child_entry_price_from"/>
</div>
<div class="form-group">
    <x-form.input label="child entry price_to" name="child_entry_price_to" type="number"
                  :value="$properties->	child_entry_price_to"/>
</div>
<div class="form-group">
    <x-form.input label="adult_entry_price_from" name="adult_entry_price_from" type="number"
                  :value="$properties->adult_entry_price_from"/>
</div>
<div class="form-group">
    <x-form.input label="adult_entry_price_to" name="adult_entry_price_to" type="number" :value="$properties->adult_entry_price_to"/>
</div>
<div class="form-group">
    <x-form.input label="geo location" name="geo_location" :value="$properties->geo_location"/>
</div>
<div class="form-group">
    <x-form.input label="longitude" name="longitude" :value="$properties->longitude"/>
</div>
<div class="form-group">
    <x-form.input label="latitude" name="latitude" :value="$properties->latitude"/>
</div>
<div class="form-group">
    <x-form.input type="time" label="duration visit" name="duration_of_the_visit"
                  :value="$properties->duration_of_the_visit"/>
</div>
{{--<div class="form-group">--}}
{{--    <x-form.input label="owner" name="owner" :value="$properties->owner"/>--}}
{{--</div>--}}

<div class="form-group">
    <x-form.textarea label="ticket_url"
                     name="ticket_url" :value="$properties->ticket_url"/>
</div>

<div class="form-group">
    <x-form.input label=" featured_image  " name="featured_image" type="file" :value="$properties->featured_image"
                  accept="image/*"/>
    @if($properties->featured_image)
        <img src="{{asset($properties->featured_image)}}" alt="not" height="70">
    @endif
    <br>
</div>



<div class="form-group" id="image-container" >
    <x-form.input label="Background Image" name="gallery[]" type="file" accept="image/*" multiple id="image-input" />
    <div id="image-container">
        @if($properties->gallery)
            @php
                $images = is_array($properties->gallery) ? $properties->gallery : explode(',', $properties->gallery);
            @endphp
            @foreach($images as $image)
                <img src="{{ asset($image)}}" alt="not" height="70" onclick="addFields()">
            @endforeach
        @endif
    </div>
    <br>
</div>



<br><br>
<div>
    <button type="submit" class="btn btn-outline-primary">{{$button_label ??'Save'}}</button>
</div>




<script>
    // احصل على عنصر input الخاص بتحميل الصور
    var imageInput = document.getElementById('image-input');

    // استدعاء وظيفة عند النقر على الصورة
    function addFields() {
        // الحصول على عنصر الواجهة الأمامية الذي يحتوي على الصورة
        var imageContainer = document.getElementById('image-container');

        // إنشاء الحقول الإضافية
        var div1 = document.createElement('div');
        div1.className = 'form-group';
        var input1 = document.createElement('input');
        input1.type = 'text';
        input1.name = 'owner[]';
        input1.value = '';
        var label1 = document.createElement('label');
        label1.innerText = 'Owner';
        div1.appendChild(label1);
        div1.appendChild(input1);

        var div2 = document.createElement('div');
        div2.className = 'form-group';
        var input2 = document.createElement('input');
        input2.type = 'text';
        input2.name = 'source_link[]';
        input2.value = '';
        var label2 = document.createElement('label');
        label2.innerText = 'Source Link';
        div2.appendChild(label2);
        div2.appendChild(input2);

        // إضافة الحقول الإضافية تحت الصورة
        imageContainer.appendChild(div1);
        imageContainer.appendChild(div2);
    }
</script>

