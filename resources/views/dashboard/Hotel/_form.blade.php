<div class="form-group">
    <x-form.input label="Name" name="name"  :value="$Hotels->name"/>
</div>

<div class="form-group">
    <x-form.input label="Location"
       name="location" :value="$Hotels->location"/>
</div>
<div class="form-group">
    <x-form.input label="Url" type="url"
       name="url" :value="$Hotels->url"/>
</div>
<br>
<div class="form-group">
    <select     style="background-color: #dcdcdc;color:black"
                class="form-control" id="stars" name="stars" required>
        <option value="">Select stars</option>
        <option value="1" <?php if($Hotels->stars === '1') echo 'selected'; ?>>1 star</option>
        <option value="2" <?php if($Hotels->stars === '2') echo 'selected'; ?>>2 stars</option>
        <option value="3" <?php if($Hotels->stars === '3') echo 'selected'; ?>>3 stars</option>
        <option value="4" <?php if($Hotels->stars === '4') echo 'selected'; ?>>4 stars</option>
        <option value="5" <?php if($Hotels->stars === '5') echo 'selected'; ?>>5 stars</option>
    </select>
</div>

<br>
<div class="form-group">
    <select     style="background-color: #dcdcdc;color:black"
                class="form-control" id="suitable_for" name="suitable_for" required>
        <option value="">Suitable for</option>
        <option value="Suitable for couples only" <?php if($Hotels->suitable_for == 'Suitable for couples only') echo 'selected'; ?>>Suitable for couples only</option>
        <option value="Suitable for couples and families" <?php if($Hotels->suitable_for == 'Suitable for couples and families') echo 'selected'; ?>>Suitable for couples and families</option>
    </select>
</div>

<br>

<div class="form-group">
    <x-form.input label="Owner"
                     name="owner" :value="$Hotels->owner"/>
</div>
<div class="form-group">
    <x-form.input label="Source Link " type="url"
                     name="source_link" :value="$Hotels->source_link"/>
</div>

<div class="form-group">
    <x-form.input label="Image" name="image" type="file" :value="$Hotels->image" accept="image/*"/>
    @if($Hotels->image)
        <img src="{{asset($Hotels->image)}}" alt="not" height="70">
    @endif
    <br>
    <img id="previewImage" src="" alt="" height="70">
</div>

<br><br>
<div>
    <button type="submit" class="btn btn-outline-primary">{{$button_label ??'Save'}}</button>
</div>


<script>
    const fileInput = document.querySelector('input[type="file"]');
    const previewImage = document.getElementById('previewImage');

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            previewImage.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
</script>







