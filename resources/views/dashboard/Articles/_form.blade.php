<div class="form-group">
    <x-form.input label="Title" name="title"  :value="$articles->title"/>
</div>
<div class="form-group">
    <x-form.input label="country" name="country"  :value="$articles->country"/>
</div>
<div class="form-group">
    <x-form.input label="source_link" name="source_link"  :value="$articles->source_link"/>
</div>
<div class="form-group">
    <x-form.input label="owner" name="owner"  :value="$articles->owner"/>
</div>
<div class="form-group">
    <x-form.input label="seo_title" name="seo_title"  :value="$articles->seo_title"/>
</div>

<div class="form-group">
    <x-form.textarea id="my-editor" label="content"
       name="content" rows="10" :value="$articles->content"/>
</div>

<div class="form-group">
    <x-form.input label="head_image"  name="head_image" type="file"  :value="$articles->head_image" accept="image/*"/>
    @if($articles->head_image)
        <img  src="{{asset($articles->head_image)}}" alt="not" height="70">
    @endif
    <br>
</div>
<div class="form-group">
    <x-form.input label="featured_image"  name="featured_image" type="file"  :value="$articles->featured_image" accept="image/*"/>
    @if($articles->featured_image)
        <img  src="{{asset($articles->featured_image)}}" alt="not" height="70">
    @endif
    <br>
</div>

<br><br>
<div>
    <button type="submit" class="btn btn-outline-primary">{{$button_label ??'Save'}}</button>
</div>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('my-editor', options);
</script>
