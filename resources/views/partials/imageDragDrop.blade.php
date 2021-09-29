<div class="drop-zone">
    <span class="drop-zone__prompt">{{isset($dropMessage) ? $dropMessage : 'Drop file here or click to upload'}}</span>
    <input type="file" name="{{$name}}" id="{{$name}}" class="drop-zone__input" />
</div>